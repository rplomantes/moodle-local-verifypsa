<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin version and other meta-data are defined here.
 *
 * @package     local_verifypsa
 * @copyright   2024 Roy Ploamntes <rplomantes@nephilaweb.com.ph>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class local_verifypsa_observer {
    /**
     * Event handler: Check external database for user verification status.
     */
    public static function check_status(\core\event\user_loggedin $event) {
        global $USER, $PAGE;

        // Load plugin config.
        $config = get_config('local_verifypsa');

        // Skip if not enabled.
        if (empty($config->enabled)) {
            return true;
        }

        // Skip for admins (optional).
        if (is_siteadmin($USER)) {
            return true;
        }

        // External DB connection setup.
        try {
            $external = moodle_database::get_driver_instance('mysqli', 'native', true);
            $external->connect(
                $config->dbhost,
                $config->dbuser,
                $config->dbpass,
                $config->dbname,
                ''
            );

            // Build query to check status.
            $sql = "SELECT {$config->statuscol}
                      FROM {$config->dbtable}
                     WHERE {$config->usercol} = ?";
            $status = $external->get_field_sql($sql, [$USER->username]);

            if ($status !== false && (string)$status === '0') {
                // Use admin-configured message.
                $message = !empty($config->message)
                    ? $config->message
                    : get_string('defaultmessage', 'local_verifypsa');

                // Require popup JS.
                $PAGE->requires->js_call_amd('local_verifypsa/popup', 'init', [
                    $config->verifyurl,
                    $message
                ]);
            }

            $external->dispose();

        } catch (Exception $e) {
            debugging('local_verifypsa: Failed to query external database. Error: ' . $e->getMessage(), DEBUG_DEVELOPER);
            return true;
        }

        return true;
    }
}

