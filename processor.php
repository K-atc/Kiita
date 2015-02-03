<?php

include './kiita/kiita.php';
use Katc\Kiita;

$md_source = <<<HERE
h1
===
it works
HERE;

$html_body = Kiita::render($md_source);
$html = Kiita::convertToHtml5Format($html_body);
echo $html;
