<?php
 /**
  * 振り分け処理実行クラス
  */
class Dispatcher {

	public function dispatch() {

		// コントローラファイル名
		$fileName = basename($_SERVER["REQUEST_URI"]);
		// DocumentRoot以降のパス取得
		$requestUri = $_SERVER["REQUEST_URI"];
		$dir = substr($requestUri, strlen(SERVICE_PATH), -strlen($fileName));
		// クラス名
		$baseName = ucfirst(substr($fileName, 0, strrpos($fileName, '.')));
		$className = $baseName . 'Controller';

		if (!require_once(CTRL_PATH . $dir . $className . '.php')) {
			// TODO:error code
			throw new Exception('コントローラが見つかりません。');
		}
		if (!$controller = new $className($baseName)) {
			// TODO:error code
			throw new Exception('コントローラ生成失敗');
		}
		$controller->prepare();
		$controller->execute();
	}
}
?>