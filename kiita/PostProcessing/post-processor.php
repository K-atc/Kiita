<?php
namespace Katc;

class PostProcessing {

	// <title></title>
	// if no titles are given, "Kiita" will be assigned
	public $docment_title = "";

	// <link rel="stylesheet" href="">
	// array items should be href(path)
	public $link_stylesheets = array();

	function convertToHtml5Format($body){
		echo '<html><head>';
		echo '<title>Kiita - test</title>';
		echo '<link rel="stylesheet" href="./public/stylesheet/qiita-base.css">';
		echo '<link rel="stylesheet" href="./public/stylesheet/qiita-detail.css">';
		echo '</head>';
		echo '<body class="markdownContent" style="width:700px; margin: 50px auto;">';
		echo  $body;
		echo '</body></html>';
	}
}

