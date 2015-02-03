<?php
namespace Katc;

class PostProcessing {

	// $link_stylesheets = array();
	public $link_stylesheets;

	function convertToHtml5Format($body){
		return "<html><head><title>Kiita - test</title></head>" . $body . "</html>";
	}
}

