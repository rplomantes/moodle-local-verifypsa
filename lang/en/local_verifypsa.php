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

$string['pluginname'] = 'Verification PSA';
$string['enable'] = 'Enable Verification Check';
$string['enable_desc'] = 'If enabled, users with is_verified = 0 will see a verification popup after login.';

$string['dbhost'] = 'External DB Host';
$string['dbname'] = 'Database Name';
$string['dbuser'] = 'Database User';
$string['dbpass'] = 'Database Password';
$string['dbtable'] = 'External Table';
$string['colverified'] = 'Verified Column';
$string['colemail'] = 'Email Column';
$string['verifyurl'] = 'Verification Portal URL';

$string['custommsg'] = 'Custom Verification Message';
$string['custommsg_desc'] = 'This message will be displayed in the popup when a user is not verified.';
