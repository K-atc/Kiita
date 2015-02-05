<?php
namespace Katc;

include_once dirname(__FILE__) . '/../vendor/php-markdown/php-markdown.php';
use \Michelf\MarkdownExstra;

include_once dirname(__FILE__) . '/PostProcessing/post-processor.php';
include_once dirname(__FILE__) . '/Chache/chache.php';
include_once dirname(__FILE__) . '/Index/indexer.php';

class Kiita  {

	use PostProcessing;
	use Chache;
	use Index;

	// Markdown File extentions here
	public $md_ext = ['md'];

	private function getFileContent($md_source_file_path){
		// local files (disallows Directory Traversal)
		if(mb_ereg_match('^(\./|\.\.)?([\w]+\/)*([\w]+\.[\w]+)$', $md_source_file_path) === false){
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
<!DOCTYPE html>		
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

	public function renderText($md_source){
		$html_body = \Michelf\MarkdownExtra::defaultTransform($md_source);
		$doc = new \DOMDocument();
		// NOTE: 一旦変換しないと文字化けしてしまう
		$doc->loadHTML(mb_convert_encoding($html_body, "HTML-ENTITIES", "auto"));
		$xpath = new \DOMXPath($doc);
		$title = $xpath->query('*/h1')->item(0)->textContent;
		$ret = new RenderResult();
		$ret->output = $html_body;
		$ret->title = $title;
		return $ret;	
	}

	public function render($md_source_file_path){
		$md_source = $this->getFileContent($md_source_file_path);
		return $this->renderText($md_source);
	}

	function __construct(){
		// for class Index
		if($this->index_file_path === ""){
			$this->index_file_path = 
			dirname(__FILE__) . DIRECTORY_SEPARATOR . "Index" . DIRECTORY_SEPARATOR . "indexed";
		}
	}
}

class RenderResult {
	public $output;
	public $title;
}