<?php
namespace Katc;

trait PostProcessing {

	// <title></title>
	// if no titles are given, "Kiita" will be assigned
	public $document_title = "Kiita";

	// <link rel="stylesheet" href="">
	// array items should be href(path)
	public $link_stylesheets = array();

	// <script></script>
	public $scripts = array();

	function convert($body){
		return <<<HERE
<!DOCTYPE html>		
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <title>$this->document_title</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/default.min.css">
  <link rel="stylesheet" href="./public/stylesheet/qiita-base.css">
  <link rel="stylesheet" href="./public/stylesheet/qiita-detail.css">
  <link rel="stylesheet" href="./public/stylesheet/markdown.css">
</head>
<body class="markdownContent" style="width:700px; margin: 50px auto;">
  $body
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
  <script src="./public/script/main.js"></script>
</body>
</html>
HERE;
	}

	function __contruct(){

	}
}