<?php
require('session_start.php');
session_start();
session_regenerate_id(true);
$_SESSION = array();
session_destroy();   

$deleteSession = $PDOconn->prepare("DELETE FROM sessions WHERE id = ?");
$deleteSession->execute(array(session_id));

header("Location: login");
?>