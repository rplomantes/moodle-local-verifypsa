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
 * Plugin strings are defined here.
 *
 * @package     local_verifypsa
 * @category    string
 * @copyright   2024 Roy Ploamntes <rplomantes@nephilaweb.com.ph>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Verify PSA';
$string['enabled'] = 'Enable verification check';
$string['enabled_desc'] = 'If enabled, the system will check an external database on login to verify user status.';

$string['dbhost'] = 'Database host';
$string['dbhost_desc'] = 'Hostname or IP address of the external database server.';

$string['dbname'] = 'Database name';
$string['dbname_desc'] = 'The name of the external database to connect to.';

$string['dbuser'] = 'Database user';
$string['dbuser_desc'] = 'Username for connecting to the external database.';

$string['dbpass'] = 'Database password';
$string['dbpass_desc'] = 'Password for the database user.';

$string['dbtable'] = 'Table name';
$string['dbtable_desc'] = 'Name of the table in the external database where user data is stored.';

$string['usercol'] = 'Username column';
$string['usercol_desc'] = 'Column name in the external table that corresponds to Moodle username.';

$string['statuscol'] = 'Status column';
$string['statuscol_desc'] = 'Column name in the external table that contains the verification status (0 = unverified).';

$string['verifyurl'] = 'Verification URL';
$string['verifyurl_desc'] = 'The URL where users will be redirected if they click "Verify Now".';

$string['message'] = 'Popup message';
$string['message_desc'] = 'This message will be displayed to users whose status = 0 in the external database. You can include custom instructions here.';

$string['testconnection'] = 'Test external DB connection';
$string['testconnection_button'] = 'Click here to test connection';
$string['testconnection_success'] = 'Connection successful! External database is reachable.';
$string['testconnection_fail'] = 'Connection failed: {$a}';
