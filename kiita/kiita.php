<?php
namespace Katc;

include_once dirname(__FILE__) . '/../vendor/php-markdown/php-markdown.php';
use \Michelf\MarkdownExstra;

include_once dirname(__FILE__) . '/PostProcessing/post-processor.php';

class Kiita extends PostProcessing {

	public $target_dir_path_prefix = "";

	public $hoge = "hoge";

	public function render($md_source_file_path){
		// TODO: ファイルの妥当性 & だめなら例外投げてメッセージ
		$md_source = file_get_contents($md_source_file_path);
		// $parser = new \Michelf\MarkdownExtra();
		// $parser->code_class_prefix = "cede-highlight";
		// return $parser->transform($md_source);
		return \Michelf\MarkdownExtra::defaultTransform($md_source);
	}

	function __construct(){

	}
}