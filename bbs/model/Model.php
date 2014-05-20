<?php
require_once ('DB.php');

class Model {

	protected $_db = '';

	/*
	 * construct
	 */
	public function __construct() {
		$this->connectDb();
	}

	/*
	 * connect DB
	 */
	private function connectDb() {

		$dsn = array(
			'phptype'	=> 'mysqli',
			'username'	=> USER,
			'password'	=> PASS,
			'hostspec'	=> HOST,
			'database'	=> DATABASE_NAME
		);

		$this->_db = DB::connect($dsn);
		if (PEAR::isError($dsn)) {
    		die($this->_db->getMessage());
		}
		$this->_db->setFetchMode(DB_FETCHMODE_ASSOC);
	}

	/*
	 * close DB
	 */
	public function closeDb() {
		$this->_db->disconnect();
	}
}
?>