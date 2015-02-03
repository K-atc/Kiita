<?php
namespace Katc;

include_once dirname(__FILE__) . '/../vendor/php-markdown/php-markdown.php';
use \Michelf\MarkdownExstra;

include_once dirname(__FILE__) . '/PostProcessing/post-processor.php';

class Kiita extends PostProcessing {

	// Markdown File extentions here
	public $md_ext = ['md'];
	
	public $target_dir_path_prefix = './rendered/';

	private function getFileContent($md_source_file_path){
		// local files (disallows Directory Traversal)
		if(mb_ereg_match('^(\./)?([\w]+\/)*([\w]+\.[\w]+)$', $md_source_file_path) === false){
			throw new \Exception(
				"[Kiita] file format fault (" . $md_source_file_path . ")", 1);
		}
		// file extension check
		$extension = pathinfo($md_source_file_path, PATHINFO_EXTENSION);
		if(in_array($extension, $this->md_ext) === false){
			throw new \Exception(
				"[Kiita] Illigal file extention (" . $md_source_file_path . ")", 100);
			return "";
		}
		$body = file_get_contents($md_source_file_path);
		return $body;		
	}

	public function raw($md_source_file_path){
		$body = $this->getFileContent($md_source_file_path);
		return <<<HERE
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title></title>
</head>
<body>
  <pre>$body</pre>
</body>
</html>
HERE;
	}

	public function render($md_source_file_path){
		$md_source = $this->getFileContent($md_source_file_path);
		// $parser = new \Michelf\MarkdownExtra();
		// $parser->code_class_prefix = "cede-highlight";
		// return $parser->transform($md_source);
		return \Michelf\MarkdownExtra::defaultTransform($md_source);
	}

	function __construct(){

	}
}