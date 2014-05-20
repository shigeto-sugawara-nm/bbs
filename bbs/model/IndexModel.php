<?php
require_once (MODEL_PATH . 'Model.php');

class IndexModel extends Model {

	/*
	 * construct
	 */
	 public function __construct() {
	 	parent::__construct();
	 }

	/*
	 * select
	 */
	public function selectContribution($where=null) {

		$where .= 'and del_flg <>1';
		$sql = <<<SQL
select *
from contribution
where 1
{$where}
SQL;

		$result = $this->_db->getAll($sql);
		return $result;
	}

	/*
	 * insert
	 */
	public function insertContribution($dataList) {
		$column = '';
		$param = '';
		$data = array();
		foreach ($dataList as $key => $value) {
			$column .= $key . ',';
			$param .= '?,';
			$data[] = nl2br(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
		}
		$column = rtrim($column, ',');
		$param = rtrim($param, ',');

		$sql = <<<SQL
insert into contribution
({$column})
values
({$param})
SQL;
		$result = $this->_db->query($sql, $data);
		if (PEAR::isError($result)) {
			$result = false;
		}
		return $result;
	}

	/*
	 * delete
	 */
	public function deleteContribution($contributeId) {

		$sql = <<<SQL
update contribution
set
del_flg = 1
where
contribute_id = {$contributeId}
SQL;
		$result = $this->_db->query($sql);
		if (PEAR::isError($result)) {
			$result = false;
		}
		return $result;
	}
}
?>