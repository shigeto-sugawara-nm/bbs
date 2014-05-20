<?php
require_once(MODEL_PATH . 'Model.php');

class EditModel extends Model{

	/*
	 * construct
	 */
	 public function __construct() {
	 	parent::__construct();
	 }

	/*
	 * select
	 */
	public function selectContribution($contributeId) {
		$where = '';
		$where .= 'and contribute_id = ?';
		$where .= 'and del_flg <>1';
		$data = array($contributeId);
		$sql = <<<SQL
select *
from contribution
where 1
{$where}
SQL;

		$result = $this->_db->query($sql, $data);
		$result = $result->fetchRow(DB_FETCHMODE_ASSOC);
		return $result;
	}

	 /*
	  * update
	  */
	public function updateContribution($dataList, $contributeId) {
		$column = '';
		$where = '';
		$data = array();
		foreach ($dataList as $key => $value) {
			$column .= $key . ' = ?,';
			$data[] = nl2br(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
		}
		$where = 'contribute_id = ?';
		$data[] = $contributeId;
		$column = rtrim($column, ',');
	 
		$sql = <<<SQL
update contribution
set
{$column}
where
{$where}
SQL;
	 	$result = $this->_db->query($sql, $data);
		if (PEAR::isError($result)) {
			$result = false;
		}
		return $result;
	 }
}
?>