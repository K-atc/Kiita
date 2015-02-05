<?php
namespace Katc;

trait Chache {
	// html file will be chached here
	public $chache_dir_path_prefix = 'chached';

	// if this is "true", enables chache files
	public $chache_control = true;

	public function getChachedHtmlContent($md_source_file_path){
		if($this->chache_control === false) return "";
		$file_name = pathinfo($md_source_file_path, PATHINFO_FILENAME);
		$file_name .= ".html";
		$target_dir = pathinfo($md_source_file_path, PATHINFO_DIRNAME);
		$target_dir = ($target_dir === "./") ? "" : $target_dir . "/";
		$chached_file_path = $target_dir . $this->chache_dir_path_prefix . '/' . $file_name;
		if(file_exists($chached_file_path) === false) return "";
		$chached_file_modified_date = (int) filemtime($chached_file_path); // (int) false = 0
		$original_file_modified_date = (int) filemtime($md_source_file_path); // (int) false = 0
		if($chached_file_modified_date >= $original_file_modified_date){
			return file_get_contents($chached_file_path);
		}
		else{
			return "";
		}
	}

	function chache($md_source_file_path, $html){		
		$chache_base_name = pathinfo($md_source_file_path, PATHINFO_FILENAME);
		$chache_base_name .= ".html";
		$dir_name = pathinfo($md_source_file_path, PATHINFO_DIRNAME);
		$chache_file_path = $dir_name . '/' . $this->chache_dir_path_prefix . '/' . $chache_base_name;
		file_put_contents($chache_file_path, $html);
	}	
}