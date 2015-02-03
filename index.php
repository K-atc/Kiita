<?php
define('MD_FILE_PATH_PREFIX', './public/markdown/');

include './kiita/processor.php';
use \Katc\Kiita;

error_reporting(-1);

$md_ext = ['md'];

try{
	if(isset($_GET['file'])){
		$file_name = $_GET['file'];
	}
	else if(isset($argv[1])){
		$file_name = $argv[1];
	}
	else{
		$file_name = "Readme.md";
	}

	// check extension
	$extension = pathinfo($file_name, PATHINFO_EXTENSION);
	if(in_array($extension, $md_ext) === false){
		throw new \Exception(
			"Illigal file extention (" . $file_name . ")", 100);		
	}
	// Directory Traversal
	if(in_array('..', explode('/', $file_name)) === true){
		throw new \Exception(
			"You are trying Directory Traversal (" . $file_name . ")", 1);			
	}
	//disallow url_fopen (外部リソースの読込の制限)
	if(mb_strpos('//', $file_name) !== false){
		throw new \Exception(
			"url_fopen is disallowed (" . $file_name . ")", 1);		
	}
	// you have to obey file_path formats
	if(mb_ereg_match('^([\w]+\/)*([\w]+\.[\w]+)$', $file_name) === false){
		throw new \Exception(
			"file format fault (" . $file_name . ")", 1);		
	}

	$md_source_file_path = MD_FILE_PATH_PREFIX . $file_name;

	$processor = new Kiita();
	if(isset($_GET['view'])){
		if($_GET['view'] == 'raw'){
			$html = $processor->raw($md_source_file_path);
		}
	}
	else{
		$html_body = $processor->render($md_source_file_path);
		$html = $processor->convertToHtml5Format($html_body);
	}
	echo $html;
}
catch(Exception $e){
	header("HTTP/1.1 404 Not Found");
	echo "<h1>Out of Service</h1>";
	echo $e->getMessage();
}