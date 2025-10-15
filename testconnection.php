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


require('../../config.php');
require_login();
require_capability('moodle/site:config', \context_system::instance());

$PAGE->set_context(\context_system::instance());
$PAGE->set_url(new moodle_url('/local/verifypsa/testconnection.php'));
$PAGE->set_title(get_string('testconnection', 'local_verifypsa'));
$PAGE->set_heading(get_string('testconnection', 'local_verifypsa'));

echo $OUTPUT->header();

$config = get_config('local_verifypsa');

try {
    $external = moodle_database::get_driver_instance('mysqli', 'native', true);
    $external->connect($config->dbhost, $config->dbuser, $config->dbpass, $config->dbname, '');
    echo $OUTPUT->notification(get_string('testconnection_success', 'local_verifypsa'), 'notifysuccess');

    // Probe table/columns quickly.
    if (!empty($config->dbtable) && !empty($config->usercol) && !empty($config->statuscol)) {
        $sql = "SELECT {$config->statuscol} FROM {$config->dbtable} WHERE 1=0";
        $external->execute($sql, []);
        echo $OUTPUT->notification(get_string('testconnection_probeok', 'local_verifypsa'), 'notifysuccess');
    } else {
        echo $OUTPUT->notification(get_string('testconnection_probewarn', 'local_verifypsa'), 'notifywarning');
    }

    $external->dispose();

} catch (\Throwable $e) {
    echo $OUTPUT->notification(get_string('testconnection_fail', 'local_verifypsa', $e->getMessage()), 'notifyproblem');
}

echo $OUTPUT->footer();

 
