<?php 
class Core{

	public function run(){
		$url = '/'.((isset($_GET['q']))?$_GET['q']:'');

		$params = array();
		if(!empty($url) && $url != '/') {
			$url = explode('/', $url);
			array_shift($url);

			$currentController = $url[0].'Controller';
			array_shift($url);

			if(isset($url[0])) {
				$currentAction = $url[0];
				array_shift($url);
			}else{
				$currentAction = 'index';
			}

			if(count($url) > 0){
				$params = $url;
			}

		}else{
			$currentController = 'homeController';
			$currentAction = 'index';
		}
		require_once 'core/Controller.php';

		if(file_exists('controllers/'.$currentController.'.php')):
			$c = new $currentController();
		else:
			$c = new notFoundController();
		endif;

		call_user_func_array(array($c, $currentAction), $params);
	}
}
?>