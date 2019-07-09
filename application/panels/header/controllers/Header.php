<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Header extends MX_Controller {

    public function index() {

        $this->load->view('login_header');
    }
	public function admin(){
		$this->load->view('admin_user_header');
		
	}
	public function home_header(){
		$this->load->view('home_header');
		
	}
	
	public function homepage(){
		
		// get 1st uri segment
		$uri_segmant = $this->uri->segment(1);
		$this -> load -> model('header/Header_model');
		$table = "";
		$slug = "";
		// check if its categories page
		if($uri_segmant == "categories"){
			if($this->uri->segment(3)){
				$table = "story";
				$slug = $this->uri->segment(3);
			}elseif($this->uri->segment(2)){
				$table = "category";
				$slug = $this->uri->segment(2);
			}else{
				$table = "site_seo";
				$slug = "categories";
			}
			
		}elseif($uri_segmant == "pages"){
			$table = "webpages";
			$slug = $this->input->get("content");
		
		}else{
			$table = "site_seo";
			$slug = $this->uri->segment(1);
			
		}
	
		
		
		$result = $this->Header_model->get_site_seo($table,$slug);
		if(empty($result)){
			$data['meta_keywords'] = "project";
			$data['meta_description'] = "project";
			$data['page_title'] = "project";
		}else{
			$data['meta_keywords'] = $result[0]->meta_keywords;
			$data['meta_description'] = $result[0]->meta_description;
			$data['page_title'] = $result[0]->page_title;
		}
		
		$this->load->view('home_page_header',$data);
	}	

	}
?>
