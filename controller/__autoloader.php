<?php  
spl_autoload_register('_autoload');
function _autoload($classname){
	 $url =$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	//Where users is the current Folder we are in
	 //If we had more we use an if else
	if(strpos($url,'entry')!== false){
		$path ='../class/';
	}else if(strpos($url,'db')!== false){
		$path ='../class/';
	}

	else {
	$path = 'class/';
}
	$ext  = '.class.php';
	$fullPath = $path.$classname.$ext;

	//reducing Error Risk
if(!file_exists($fullPath)){
	return false;
}

	require_once($fullPath);
}



?>