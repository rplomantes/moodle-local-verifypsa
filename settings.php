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

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_verifypsa', get_string('pluginname', 'local_verifypsa'));

    // Enable/disable
    $settings->add(new admin_setting_configcheckbox(
        'local_verifypsa/enable',
        get_string('enable', 'local_verifypsa'),
        get_string('enable_desc', 'local_verifypsa'),
        1
    ));

    // External DB
    $settings->add(new admin_setting_configtext('local_verifypsa/dbhost', get_string('dbhost', 'local_verifypsa'), '', 'localhost'));
    $settings->add(new admin_setting_configtext('local_verifypsa/dbname', get_string('dbname', 'local_verifypsa'), '', ''));
    $settings->add(new admin_setting_configtext('local_verifypsa/dbuser', get_string('dbuser', 'local_verifypsa'), '', ''));
    $settings->add(new admin_setting_configpasswordunmask('local_verifypsa/dbpass', get_string('dbpass', 'local_verifypsa'), '', ''));
    $settings->add(new admin_setting_configtext('local_verifypsa/dbtable', get_string('dbtable', 'local_verifypsa'), '', 'external_user_table'));
    $settings->add(new admin_setting_configtext('local_verifypsa/colverified', get_string('colverified', 'local_verifypsa'), '', 'is_verified'));
    $settings->add(new admin_setting_configtext('local_verifypsa/colemail', get_string('colemail', 'local_verifypsa'), '', 'email'));

    // Verification Portal
    $settings->add(new admin_setting_configtext('local_verifypsa/verifyurl', get_string('verifyurl', 'local_verifypsa'), '', 'https://your-verify-portal.com'));

    // Custom Message
    $settings->add(new admin_setting_configtextarea(
        'local_verifypsa/custommsg',
        get_string('custommsg', 'local_verifypsa'),
        get_string('custommsg_desc', 'local_verifypsa'),
        'Please verify your account before proceeding.'
    ));

    $ADMIN->add('localplugins', $settings);
}
