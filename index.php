<?php
define('MD_FILE_PATH_PREFIX', './public/markdown/');

include './kiita/processor.php';
use \Katc\Kiita;

// error_reporting(-1);

$md_ext = ['md'];

try{
	$need_validation = true;
	if(isset($_GET['file'])){
		$file_name = $_GET['file'];
	}
	else if(isset($argv[1])){
		$file_name = $argv[1];
	}
	else{
		$file_name = "Readme.md";
	}
	if($file_name === "Readme.md"){	
		$md_source_file_path = "./Readme.md";
		$need_validation = false;
	}

	if($need_validation === true){
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
	}

	if(isset($md_source_file_path) === false){
		$md_source_file_path = MD_FILE_PATH_PREFIX . $file_name;
	}

	$processor = new Kiita();
	$processor->chache_control = false;
	// view raw
	if(isset($_GET['view'])){
		if($_GET['view'] == 'raw'){
			$html = $processor->raw($md_source_file_path);
		}
	}
	// 投稿記事一覧 (Posted Markdown List)
	else if(isset($_GET['list']) || (isset($argv[1]) && $argv[1] === "list")){
		$md_source = $processor->getIndexMarkdown();
		$rendered = $processor->renderText($md_source);
		$html = $processor->convert($rendered->output);
	}
	// 通常(Usual)
	else{
		$html = $processor->getChachedHtmlContent($md_source_file_path);
		if($html === ""){
			$rendered = $processor->render($md_source_file_path);
			$processor->addIndex($md_source_file_path, $rendered->title);
			$html = $processor->convert($rendered->output);
		}
		else{
			echo "<!-- this is chached file -->\n";
		}
		if($md_source_file_path !== "./Readme.md"){
			$processor->chache($md_source_file_path, $html);
		}
	}
	echo $html;
}
catch(Exception $e){
	if($e->getCode() === 404){
		header("HTTP/1.1 404 Not Found");
		header("Location: 404.html#" . $e->getMessage());
	}
	else {
		header("HTTP/1.1 404 Not Found");
		header("Location: 404.html#" . $e->getMessage());
	}
}