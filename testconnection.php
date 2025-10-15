<?php
require('../../config.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/local/verifypsa/testconnection.php'));
$PAGE->set_title(get_string('testconnection', 'local_verifypsa'));
$PAGE->set_heading(get_string('testconnection', 'local_verifypsa'));

echo $OUTPUT->header();

$dbhost   = get_config('local_verifypsa', 'dbhost');
$dbname   = get_config('local_verifypsa', 'dbname');
$dbuser   = get_config('local_verifypsa', 'dbuser');
$dbpass   = get_config('local_verifypsa', 'dbpass');

try {
    $dsn = "mysql:host={$dbhost};dbname={$dbname}";
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $dbh = new PDO($dsn, $dbuser, $dbpass, $options);

    echo $OUTPUT->notification(get_string('testconnection_success', 'local_verifypsa'), 'notifysuccess');

} catch (Exception $e) {
    echo $OUTPUT->notification(get_string('testconnection_fail', 'local_verifypsa', $e->getMessage()), 'notifyproblem');
}

echo $OUTPUT->footer();
