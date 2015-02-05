<?php
namespace Katc;

trait Index {

	// index file will be placed here (default kiita/Index/indexed)
	private $index_file_path = "";

	// // index file Markdown version will be placed here
	// private $index_markdown_file_path = MD_FILE_PATH_PREFIX . "kiita-posted-list.md";

	public $index_markdown_title = "Kiita - 投稿済み記事";

	public function getIndex(){
		$serialized = (string) file_get_contents($this->index_file_path);	
		if($serialized === ""){
			$index = array();
		}
		else{
			$index = unserialize($serialized);
		}
		return $index;		
	}

	public function addIndex($file_name, $title){
		$index = $this->getIndex();
		$index[$file_name] = $title;
		$serialized = serialize($index);
		file_put_contents($this->index_file_path, $serialized);
	}

	public function getIndexMarkdown(){
		$md_source = $this->index_markdown_title . "\n====\n";
		$index = $this->getIndex();
		$base_uri = "http://" . $_SERVER["HTTP_HOST"] . explode('?', $_SERVER["REQUEST_URI"])[0];
		foreach ($index as $key => $value) {
			$base_name = pathinfo($key, PATHINFO_BASENAME);
			$md_source .= "* [${value}](${base_uri}?file=${base_name})\n";
		}
		return $md_source;
	}
}