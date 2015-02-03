<?php
namespace Katc;

include_once dirname(__FILE__) . '/../vendor/php-markdown/php-markdown.php';
use \Michelf\MarkdownExstra;

include_once dirname(__FILE__) . '/PostProcessing/post-processor.php';

class Kiita extends PostProcessing {

	private $target_dir_path_prefix = "";

	function render($md_source){
		return \Michelf\MarkdownExtra::defaultTransform($md_source);
	}

	function __construct(){

	}
}