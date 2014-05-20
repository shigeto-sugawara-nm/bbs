<?php
require_once ('Smarty.class.php');

class Controller {

	protected $_baseName = '';
	protected $_model = '';
	protected $_view = '';

	/*
	 * construct
	 */
	public function __construct($baseName) {
		$this->_baseName = $baseName;
	}

	/*
	 * prepare
	 */
	public function prepare () {

		// model
		$this->_model = $this->createModelObject($this->_baseName);
		if (isset($this->_model) == false) {
			// error
		}

		// view
		$this->_view = $this->createViewObject();
		if (isset($this->_view) == false) {
			// error
		}
	}

	/*
	 * execute
	 */
	public function execute () {

	}

	/*
	 * modelオブジェクト生成
	 */
	private function createModelObject($baseName) {
		$className = $baseName . 'Model';
		require_once(MODEL_PATH . $className . '.php');
		$model = new $className();
		return $model;
	}

	/*
	 * viewオブジェクト生成
	 */
	private function createViewObject() {
		$smarty = new Smarty();
		$smarty->template_dir = '/var/www/html/bbs/view/templates/';
		$smarty->compile_dir  = '/var/www/html/bbs/data/templates_c/';
		$smarty->config_dir   = '/var/www/html/bbs/data/configs/';
		$smarty->cache_dir    = '/var/www/html/bbs/data/cache/';
		return $smarty;
	}
}
?>