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


namespace local_verifypsa;

defined('MOODLE_INTERNAL') || die();

class observer {
    public static function user_loggedin(\core\event\user_loggedin $event): bool {
        global $USER, $SESSION;

        debugging('local_verifypsa observer triggered for user: ' . $USER->username, DEBUG_DEVELOPER);

        $config = get_config('local_verifypsa');
        if (empty($config->enabled)) {
            return true;
        }

        if (is_siteadmin($USER)) {
            return true;
        }

        try {
            $external = \moodle_database::get_driver_instance('mysqli', 'native', true);
            $external->connect(
                $config->dbhost,
                $config->dbuser,
                $config->dbpass,
                $config->dbname,
                ''
            );

            $sql = "SELECT {$config->statuscol}
                      FROM {$config->dbtable}
                     WHERE {$config->usercol} = ?";
            $status = $external->get_field_sql($sql, [$USER->username]);

            if ($status === false) {
                $SESSION->local_verifypsa_showpopup = 'notfound';
            } else if ((string)$status === '0') {
                $SESSION->local_verifypsa_showpopup = 'verify';
            }

            $external->dispose();
        } catch (\Throwable $e) {
            debugging('local_verifypsa: external DB error - ' . $e->getMessage(), DEBUG_DEVELOPER);
        }

        return true;
    }
}
