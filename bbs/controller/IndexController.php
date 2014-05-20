<?php
require_once (CTRL_PATH . 'Controller.php');

class IndexController extends Controller {

	/*
	 * construct
	 */
	public function __construct($baseName) {
		parent::__construct($baseName);
	}

	/*
	 * execute
	 */
	public function execute () {

		$action = '';
		$errorMsg = '';
		// パラメータを変数に格納
		$action = $_POST['action'];
		$contributeId = $_POST['contribute_id'];
		$contributor = $_POST['contributor'];
		$contributeTitle = $_POST['contribute_title'];
		$contributeText = $_POST['contribute_text'];

		// 新規投稿
		if ($action == 'register') {
			// 入力チェック
			if (empty($contributor)) {
				$errorMsg .= '名前が入力されていません。　';
			}
			if (empty($contributeTitle)) {
				$errorMsg .= 'タイトルが入力されていません。　';
			}
			if (empty($contributeText)) {
				$errorMsg .= '本文が入力されていません。　';
			}
			if (empty($errorMsg)) {
				$data = array(
					'contributor' => $contributor,
					'contribute_title' => $contributeTitle,
					'contribute_text' => $contributeText
				);
				$result = $this->_model->insertContribution($data);
				if ($result == false) {
					$errorMsg .= '登録に失敗しました。';
					$this->_view->assign('error', $errorMsg);
				}
			}
		} else if ($action == 'delete') {
		// 削除
			$result = $this->_model->deleteContribution($contributeId);
			if ($result == false) {
				$errorMsg .= '削除に失敗しました。';
				$this->_view->assign('error', $errorMsg);
			}
		}

		if (!empty($errorMsg)) {
			$this->_view->assign('error', $errorMsg);
		}

		// 投稿内容取得
		$result = $this->_model->selectContribution();

		$this->_model->closeDb();
		$viewName = $this->_baseName . '.tpl';
		$this->_view->assign('list', $result);
		$this->_view->display($viewName);
	}
}
?>