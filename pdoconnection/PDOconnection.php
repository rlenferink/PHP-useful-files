<?php
class Connection {
    public static function getPDOconn() {
        $dsn = "mysql:host=localhost;dbname=admin_stcaecilia;charset=utf8";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false
        );
        $pdo = new PDO($dsn,'user','pass', $opt);

        return $pdo;
    }
}
?>
