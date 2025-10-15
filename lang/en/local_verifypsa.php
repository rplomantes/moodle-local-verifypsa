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

$string['pluginname'] = 'Verify PSA';
$string['enabled'] = 'Enable Verify PSA';
$string['enabled_desc'] = 'If enabled, users will be checked against an external database after login.';

$string['dbhost'] = 'External DB host';
$string['dbhost_desc'] = 'Hostname or IP of the external database server (MySQL).';

$string['dbname'] = 'External DB name';
$string['dbname_desc'] = 'Database name containing the user table.';

$string['dbuser'] = 'External DB user';
$string['dbuser_desc'] = 'User with read access to the external database.';

$string['dbpass'] = 'External DB password';
$string['dbpass_desc'] = 'Password for the external DB user.';

$string['dbtable'] = 'External table name';
$string['dbtable_desc'] = 'Table to query for the user status.';

$string['usercol'] = 'Username column';
$string['usercol_desc'] = 'Column name that stores the username.';

$string['statuscol'] = 'Status column';
$string['statuscol_desc'] = 'Column name that stores the verification status. Use 0 for not verified.';

$string['verifyurl'] = 'Verification URL';
$string['verifyurl_desc'] = 'URL where users can complete verification (used for the "Verify Now" button).';

$string['message'] = 'Popup message (status = 0)';
$string['message_desc'] = 'Message shown when the user is found but has status = 0.';
$string['defaultmessage'] = 'Please verify your information before continuing.';

$string['notfoundmessage'] = '⚠️ Record not found for validation. Please contact your administrator.';

$string['testconnection'] = 'Test external DB connection';
$string['testconnection_button'] = 'Click here to test';
$string['testconnection_success'] = 'Connection successful! External DB is reachable.';
$string['testconnection_probeok'] = 'Table/column probe OK.';
string['testconnection_probewarn'] = 'Connection OK. Configure table and column settings to enable deeper checks.';
$string['testconnection_fail'] = 'Connection failed: {$a}';

$string['popupheading'] = 'Account Verification';
$string['verifynow'] = 'Verify Now';
$string['continue'] = 'Continue';
