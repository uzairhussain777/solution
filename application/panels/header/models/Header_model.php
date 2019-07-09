<?php

class Header_model extends MY_Model {
	public function __construct() {
		
		parent::__construct("");
	}

	public function get_site_seo($table,$slug){
		
		$params = array(
				"select" => "meta_keywords,meta_description,page_title",
				"from" => $table,
				"where" => "slug = '$slug'");
		
		$result = $this->find($params);
		
		return $result;
	}

}
?>
