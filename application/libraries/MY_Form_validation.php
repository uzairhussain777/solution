<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');
class MY_Form_validation extends CI_Form_validation {

public function __construct() {
    parent::__construct();
  }
  
  public function check_unique_email($str){
      $CI =& get_instance();
      $userid=Null;
      
      $CI->load->model('users_content/users_content_model');
      $email=$CI->input->post('email');
      
      $count_email=$CI->users_content_model->check_unique_email($email);
      
      if ($count_email){ 
          $this->set_message('check_unique_email', 'Please use Unique Email Address. Entered email is already in use');
          return false;
      }
      return True;
      
  }
    public function donation_error_message(){
    	 $CI =& get_instance();
      
          $CI->set_message('donation_error_message', 'Payment Not Done');
          return false;
     }
  
  	public function check_unique_slug($str){
      $CI =& get_instance();
      $userid=Null;
      
      $CI->load->model('seo_content/seo_content_model');
      $slug=$CI->input->post('slug');
      
      $count_email=$CI->seo_content_model->checkuniqueslug($slug);
      
      if ($count_email){ 
          $this->set_message('check_unique_slug', 'Please use Unique Slug.');
          return false;
      }
      return True;
      
  }
	
		public function check_unique_slug_edit($str){
      $CI =& get_instance();
      $userid=Null;
      
      $CI->load->model('seo_content/seo_content_model');
      $slug=$CI->input->post('slug');
	  $seo_id=$CI->input->post('edit_seo_id');
	  
      
      $count_email=$CI->seo_content_model->checkuniqueslugforedit($slug,$seo_id);
      
      if ($count_email){ 
          $this->set_message('check_unique_slug_edit', 'Please use Unique Slug.');
          return false;
      }
      return True;
      
  }
  
	
  	public function check_unique_slug_page($str){
      $CI =& get_instance();
      $userid=Null;
      
      $CI->load->model('pages_content/pages_content_model');
      $slug=$CI->input->post('slug');
      
      $count_email=$CI->pages_content_model->checkuniqueslug($slug);
      
      if ($count_email){ 
          $this->set_message('check_unique_slug_page', 'Please use Unique Slug.');
          return false;
      }
      return True;
      
  }
	
	 public function check_unique_slug_page_edit($str){
      $CI =& get_instance();
      $userid=Null;
      
      $CI->load->model('pages_content/pages_content_model');
      $slug=$CI->input->post('slug');
      $page_id=$CI->input->post('edit_page_id');
    
      $count_email=$CI->pages_content_model->checkuniqueslugforedit($slug,$page_id);
      
      if ($count_email){ 
          $this->set_message('check_unique_slug_page_edit', 'Please use Unique Slug.');
          return false;
      }
      return True;
      
  }
  
	public function check_unique_group_name(){
      $CI =& get_instance();
      $userid=Null;
      
      $CI->load->model('permissions_content/permissions_content_model');
      $group_name=$CI->input->post('group_name');
      $count_groupname=$CI->permissions_content_model->check_unique_group_name($group_name);
      
      if ($count_groupname){ 
          $this->set_message('check_unique_group_name', 'Please use Unique Group name. Entered Name is already in use');
          return false;
      }
      return True;
      
  }
	
	public function check_unique_group_name_for_edit($str){
		$CI =& get_instance();
		$CI->load->model('permissions_content/permissions_content_model');
		$group_name=$CI->input->post('group_name');
		$group_id=$CI->input->post('edit_group_id');
		$count_result=$CI->permissions_content_model->checkuniquegroupnameforedit($group_name, $group_id);
		
		if ($count_result > 0){
  		$this->set_message('check_unique_group_name_for_edit', 'Please use Unique Group Name.');
  		return false;
	  	}
	  	return True;
	}
	
  public function check_unique_user_name($str){
  
  	$CI =& get_instance();
  	$userid=Null;
  
  	$CI->load->model('users_content/users_content_model');
  	$username=$CI->input->post('username');
  
  	$count_user_name=$CI->users_content_model->check_unique_user_name($username);
  
  	if ($count_user_name > 0){
  		$this->set_message('check_unique_user_name', 'Please use Unique User Name.');
  		return false;
  	}
  	return True;
  
  }
  
  public function check_unique_category_name($str){
      $CI =& get_instance();
	  
	  $CI->load->model('categories_content/categories_content_model');
	  
	  $categoryName=$CI->input->post('categoryname');
	  $count_category_name=$CI->categories_content_model->checkuniquecategoryname($categoryName);
	  
	  if ($count_category_name > 0){
  		$this->set_message('check_unique_category_name', 'Please use Unique Category Name.');
  		return false;
  	}
  	return True;
	  
  }

	public function check_unique_story_name($str){
		$CI =& get_instance();
	  
	  $CI->load->model('stories_content/stories_content_model');
	  
	  $storyName=$CI->input->post('storyname');
	  $count_story_name=$CI->stories_content_model->checkuniquestoryname($storyName);
	  
	  if ($count_story_name > 0){
  		$this->set_message('check_unique_story_name', 'Please use Unique Story Name.');
  		return false;
	  	}
	  	return True;
	}
	
	public function check_unique_category_name_for_edit($str){
		$CI =& get_instance();
		$CI->load->model('categories_content/categories_content_model');
		$categoryName=$CI->input->post('edit_categoryname');
		$category_id=$CI->input->post('edit_category_id');
		$count_result=$CI->categories_content_model->checkuniquecategorynameforedit($categoryName, $category_id);
		
		if ($count_result > 0){
  		$this->set_message('check_unique_category_name_for_edit', 'Please use Unique Category Name.');
  		return false;
	  	}
	  	return True;
	}
	
	public function check_unique_template_name_edit(){
		$CI =& get_instance();
		$CI->load->model('template_content/template_content_model');
		$templatename=$CI->input->post('edit_templatename');
		$templateid=$CI->input->post('edit_templateid');
		
		$count_result=$CI->template_content_model->checkuniquetemplatenameforedit($templatename,$templateid);
		if ($count_result > 0){
  		$this->set_message('check_unique_template_name_edit', 'Please use Unique Template Name.');
  		return false;
	  	}
	  	return True;
	}
	
	public function check_unique_template_name(){
		$CI =& get_instance();
		$CI->load->model('template_content/template_content_model');
		$templateName=$CI->input->post('templatename');
		$count_result=$CI->template_content_model->checkuniquetemplatename($templateName);
		if ($count_result > 0){
  		$this->set_message('check_unique_template_name', 'Please use Unique Template Name.');
  		return false;
	  	}
	  	return True;
	}
	
	public function check_unique_name(){
		$CI =& get_instance();
		$CI->load->model('newletter_content/newsletter_content_model');
		$newslettername=$CI->input->post('name');
		$count_result=$CI->newsletter_content_model->checkuniqueremindername($newslettername);
		if ($count_result > 0){
  		$this->set_message('check_unique_name', 'Please use Unique Name.');
  		return false;
	  	}
	  	return True;
	}
	
	public function check_unique_edit_story_name(){
		$CI =& get_instance();
		$CI->load->model('stories_content/stories_content_model');
		$storyname=$CI->input->post('edit_storyname');
		$storyid=$CI->input->post('edit_story_id');
		
		$count_result=$CI->stories_content_model->checkuniqueeditstoryname($storyname,$storyid);
		if ($count_result > 0){
  		$this->set_message('check_unique_edit_story_name', 'Please use Unique Name.');
  		return false;
	  	}
	  	return True;
	}

	public function check_unique_email_in_system(){
		$CI =& get_instance();
		$CI->load->model('login_content/login_content_model');
		$email=$CI->input->post('signup_email');		
		$count_result=$CI->login_content_model->checkuniqueemailinsystem($email);
		if ($count_result > 0){
  		$this->set_message('check_unique_email_in_system', 'Please use Unique Email Address.');
  		return false;
	  	}
	  	return True;
	}
	
	public function check_unique_name_for_edit_newsletter(){
		$CI =& get_instance();
		$CI->load->model('newletter_content/newsletter_content_model');
		$newslettername=$CI->input->post('name');
		$newsletterid=$CI->input->post('newletterid');
		
		$count_result=$CI->newsletter_content_model->checkuniquenewslettereditname($newslettername,$newsletterid);
		if ($count_result > 0){
  		$this->set_message('check_unique_name_for_edit_newsletter', 'Please use Unique Name.');
  		return false;
	  	}
	  	return True;
	}
  

    public function alpha_dash_space($str,$field){
    $CI =& get_instance();
    
    if (!preg_match("/^([-a-z_ ])+$/i", $str)){
      $this->set_message('alpha_dash_space', $field.' Can contain only alphabets and space.');
      return False;  
    }
    return True;
    }
    
    
   
	public function save_session($data){
	  $CI =& get_instance();
      $userid=Null;
      
      $CI->load->model('users_content/users_content_model');
      $CI->users_content_model->save_session($data);
      return True;
  }
  
}//class ends
?>
