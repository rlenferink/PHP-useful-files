<?php
require('session.class.php');
$session = new Sessions();
$session->setDbDetails('YOURHOST', 'YOURUSERNAME', 'YOURPASSWORD', 'YOURDBNAME'); // fill in your DB details
$session->setDbTable('sessions');
session_set_save_handler(array($session, 'open'),
                         array($session, 'close'),
                         array($session, 'read'),
                         array($session, 'write'),
                         array($session, 'destroy'),
                         array($session, 'gc'));
register_shutdown_function('session_write_close');

session_start();

// do your sessions shit here
//example:
$_SESSION['username'] = "github";
?> 