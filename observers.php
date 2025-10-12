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
    public static function check_verification($event) {
        global $USER, $SESSION;

        // Check plugin is enabled
        if (!get_config('local_verifypsa', 'enable')) {
            return;
        }

        // Skip site admins
        if (is_siteadmin($USER->id)) {
            return;
        }

        // Load DB settings
        $dbhost     = get_config('local_verifypsa', 'dbhost');
        $dbname     = get_config('local_verifypsa', 'dbname');
        $dbuser     = get_config('local_verifypsa', 'dbuser');
        $dbpass     = get_config('local_verifypsa', 'dbpass');
        $dbtable    = get_config('local_verifypsa', 'dbtable');
        $colverified= get_config('local_verifypsa', 'colverified');
        $colemail   = get_config('local_verifypsa', 'colemail');

        try {
            $extdb = moodle_database::get_driver_instance('mysqli', 'native', true);
            $extdb->connect($dbhost, $dbuser, $dbpass, $dbname, 'utf8');

            $sql = "SELECT {$colverified} FROM {$dbtable} WHERE {$colemail} = ?";
            $record = $extdb->get_record_sql($sql, [$USER->email]);

            if ($record && $record->{$colverified} == 0) {
                $SESSION->local_verifypsa_showpopup = true;
            }
        } catch (Exception $e) {
            debugging("VerifyPSA DB error: " . $e->getMessage(), DEBUG_DEVELOPER);
        }
    }
}
