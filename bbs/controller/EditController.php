<?php
require_once (CTRL_PATH . 'Controller.php');

class EditController extends Controller {

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
		if (empty($action)) {
			$action = $_GET['action'];
		}
		$contributeId = $_POST['contribute_id'];
		if (empty($contributeId)) {
			$contributeId = $_GET['contribute_id'];
		}
		$contributor = $_POST['contributor'];
		$contributeTitle = $_POST['contribute_title'];
		$contributeText = $_POST['contribute_text'];

		// 編集前
		if ($action == 'edit') {
			// 投稿取得
			$result = $this->_model->selectContribution($contributeId);
		} else if ($action == 'edit_end') {
		// 編集後
			// 入力チェック
			$errorMsg = '';
			if (empty($contributor)) {
				$errorMsg .= '名前が入力されていません。　';
			}
			if (empty($contributeTitle)) {
				$errorMsg .= 'タイトルが入力されていません。　';
			}
			if (empty($contributeText)) {
				$errorMsg .= '本文が入力されていません。　';
			}
			if (!empty($errorMsg)) {
				$this->_view->assign('error', $errorMsg);
				$result = $this->_model->selectContribution($contributeId);
				$action = 'edit';
			} else {
				$data = array(
					'contributor' => $contributor,
					'contribute_title' => $contributeTitle,
					'contribute_text' => $contributeText
				);

				$result = $this->_model->updateContribution($data, $contributeId);
				if ($result == false) {
					$errorMsg .= '編集に失敗しました。';
					$this->_view->assign('error', $errorMsg);
				} else {
					$result = $this->_model->selectContribution($contributeId);
				}
			}
		}

		$this->_model->closeDb();
		$viewName = $this->_baseName . '.tpl';
		$this->_view->assign('action', $action);
		$this->_view->assign('list', $result);
		$this->_view->display($viewName);
	}
}
?>