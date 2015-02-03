<?php

error_reporting(-1);

include './kiita/kiita.php';
use \Katc\Kiita;

if(isset($_GET['file'])){
	$md_source_file_path = $_GET['file'];
}
else if(isset($argv[1])){
	$md_source_file_path = $argv[1];
}
else{
	$md_source_file_path = "Readme.md";
}



$processor = new Kiita();
$html_body = $processor->render('./public/markdown/' . $md_source_file_path);
$html = $processor->convertToHtml5Format($html_body);
echo $html;
