<?php
class Sessions{

	protected $dbConnection;
	protected $dbTable;

	public function setDbDetails($dbHost, $dbUser, $dbPassword, $dbDatabase){
		$this->dbConnection = new mysqli($dbHost, $dbUser, $dbPassword, $dbDatabase);

		if (mysqli_connect_error()) {
			throw new Exception('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
		}
	}
	
	public function setDbConnection($dbConnection){
		$this->dbConnection = $dbConnection;
	}

	public function setDbTable($dbTable){
		$this->dbTable = $dbTable;
	}

	public function open() {
		//delete old session handlers
		$limit = time() - (3600 * 24);
		$sql = sprintf("DELETE FROM %s WHERE timestamp < %s", $this->dbTable, $limit);
		return $this->dbConnection->query($sql);
	}

	public function close() {
		return $this->dbConnection->close();
	}

	public function read($id) {
		$sql = sprintf("SELECT data FROM %s WHERE id = '%s'", $this->dbTable, $this->dbConnection->escape_string($id));
		if ($result = $this->dbConnection->query($sql)) {
			if ($result->num_rows && $result->num_rows > 0) {
				$record = $result->fetch_assoc();
				return $record['data'];
			} else {
				return false;
			}
		} else {
			return false;
		}
		return true;
	}

	public function write($id, $data) {
		$sql = sprintf("REPLACE INTO %s VALUES('%s', '%s', '%s', '%s')",
							$this->dbTable, 
							$this->dbConnection->escape_string($id),
							$this->dbConnection->escape_string($data),
							time(),
							$_SERVER['REMOTE_ADDR']);
		return $this->dbConnection->query($sql);
	}

	public function destroy($id) {
		$sql = sprintf("DELETE FROM %s WHERE `id` = '%s'", $this->dbTable, $this->dbConnection->escape_string($id));
		return $this->dbConnection->query($sql);
	}

	public function gc($max) {
		$sql = sprintf("DELETE FROM %s WHERE `timestamp` < '%s'", $this->dbTable, time() - intval($max));
		return $this->dbConnection->query($sql);
	}
}

?>