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

// This file is part of Moodle - http://moodle.org/
//
// Local plugin: Verify PSA
// Settings page for admin configuration.

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {

    $settings = new admin_settingpage('local_verifypsa', get_string('pluginname', 'local_verifypsa'));

    // Enable/disable the plugin.
    $settings->add(new admin_setting_configcheckbox(
        'local_verifypsa/enabled',
        get_string('enabled', 'local_verifypsa'),
        get_string('enabled_desc', 'local_verifypsa'),
        0
    ));

    // External DB host.
    $settings->add(new admin_setting_configtext(
        'local_verifypsa/dbhost',
        get_string('dbhost', 'local_verifypsa'),
        get_string('dbhost_desc', 'local_verifypsa'),
        'localhost',
        PARAM_RAW
    ));

    // External DB name.
    $settings->add(new admin_setting_configtext(
        'local_verifypsa/dbname',
        get_string('dbname', 'local_verifypsa'),
        get_string('dbname_desc', 'local_verifypsa'),
        '',
        PARAM_RAW
    ));

    // External DB user.
    $settings->add(new admin_setting_configtext(
        'local_verifypsa/dbuser',
        get_string('dbuser', 'local_verifypsa'),
        get_string('dbuser_desc', 'local_verifypsa'),
        '',
        PARAM_RAW
    ));

    // External DB password.
    $settings->add(new admin_setting_configpasswordunmask(
        'local_verifypsa/dbpass',
        get_string('dbpass', 'local_verifypsa'),
        get_string('dbpass_desc', 'local_verifypsa'),
        ''
    ));

    // External DB table.
    $settings->add(new admin_setting_configtext(
        'local_verifypsa/dbtable',
        get_string('dbtable', 'local_verifypsa'),
        get_string('dbtable_desc', 'local_verifypsa'),
        '',
        PARAM_RAW
    ));

    // Username column mapping.
    $settings->add(new admin_setting_configtext(
        'local_verifypsa/usercol',
        get_string('usercol', 'local_verifypsa'),
        get_string('usercol_desc', 'local_verifypsa'),
        'username',
        PARAM_RAW
    ));

    // Status column mapping.
    $settings->add(new admin_setting_configtext(
        'local_verifypsa/statuscol',
        get_string('statuscol', 'local_verifypsa'),
        get_string('statuscol_desc', 'local_verifypsa'),
        'status',
        PARAM_RAW
    ));

    // Verification URL.
    $settings->add(new admin_setting_configtext(
        'local_verifypsa/verifyurl',
        get_string('verifyurl', 'local_verifypsa'),
        get_string('verifyurl_desc', 'local_verifypsa'),
        '',
        PARAM_URL
    ));

    // Customizable popup message.
    $settings->add(new admin_setting_configtextarea(
        'local_verifypsa/message',
        get_string('message', 'local_verifypsa'),
        get_string('message_desc', 'local_verifypsa'),
        'Please verify your info with PSA before continuing.',
        PARAM_TEXT
    ));

     // Test connection link.
    $testurl = new moodle_url('/local/verifypsa/testconnection.php');
    $settings->add(new admin_setting_heading(
        'local_verifypsa/testconnection',
        get_string('testconnection', 'local_verifypsa'),
        html_writer::link($testurl, get_string('testconnection_button', 'local_verifypsa'),
            ['class' => 'btn btn-secondary', 'target' => '_blank'])
    ));

    // Add this settings page to the admin tree.
    $ADMIN->add('localplugins', $settings);
}

