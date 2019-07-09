<?php /**
 * Description of uploader
 *
 * @author Rana
 */
class Appuploader {
    var $config;
    public function __construct() {
        $this->ci =& get_instance();
    }
	
	private function set_upload_options()
	{   
	    //upload an image options
	    $new_file_name= 'solution_new_'.time().rand(100,999);
	    $this->config = array(
			'upload_path'=>dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/",
			'upload_url'=>$this->ci->config->base_url()."uploads",
			'allowed_types'=>'gif|jpg|png|jpeg|mp4',
			'overwrite'=>FALSE,
			'file_name'=>$new_file_name,
		
		);
		
	    return $this->config;
	}
    
    public function do_upload($copy = NULL){
    	$this->ci->load->library('upload');
		$files = $_FILES;
    	$cpt = count($_FILES['userfile']['name']);
		$index=0;
		
	    for($i=0; $i<$cpt; $i++)
	    {
	    	       
	        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
	        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
	        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
	        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
	        $_FILES['userfile']['size']= $files['userfile']['size'][$i]; 
			
			$new_file_name= 'solution_new_'.time().rand(100,999);
			$file_name=$_FILES['userfile']['name'];
			$exploded=explode(".", $file_name);
			$fileExt = array_pop($exploded);
			$filewext=time()."-".$new_file_name;
			$new_convert_file_name = $filewext.".".$fileExt;
			
			$allowed_image_types=array(
				1=>'gif',
				2=>'jpg',
				3=>'png',
				4=>'jpeg'
			);
			
			if(in_array($fileExt, $allowed_image_types)){
				$this->config=array(
				 'upload_path'=>upload_file_path."/stories/images",
				 'upload_url'=>resource_path."/stories/images",
				 'allowed_types'=>'gif|jpg|png|jpeg',
				 'overwrite'=>FALSE,
				 'file_name'=>$new_convert_file_name,
				 'max_size'=> file_size,	
				);  
			}else{
				$this->config=array(
				 'upload_path'=>upload_file_path."/stories/videos",
				 'upload_url'=>resource_path."/stories/videos",
				 'allowed_types'=>'mp4',
				 'overwrite'=>FALSE,
				 'file_name'=>$new_convert_file_name,	
				 'max_size'=> file_size,
				);  	
			}			
			 $this->ci->upload->initialize($this->config);
	         //$this->ci->upload->do_upload();
			
			
			if($this->ci->upload->do_upload())
			{
					
				$result[$index]=new stdClass;
				$result[$index]->name=$this->config['file_name'];
				$result[$index]->path=$this->config['upload_path'];
				$index++;
			}else{
				$data['status'] = $this->ci->upload->display_errors();
				return $data;
			}	
			
			
	    }

		return $result;
    }

public function do_upload_new($copy = NULL){
    		
    	$this->ci->load->library('upload');
		
		$new_file_name= 'solution_new_'.time().rand(100,999);
		$file_name=$_FILES['userfile']['name'];
		$exploded=explode(".", $file_name);
		$fileExt = array_pop($exploded);
		$filewext=time()."-".$new_file_name;
		$new_convert_file_name = $filewext.".".$fileExt;
		
		
		$this->config = array(
			 'upload_path'=>upload_file_path."/categories/images",
			 'upload_url'=>resource_path."/categories/images",
			 'allowed_types'=>'gif|jpg|png|jpeg',
			 'overwrite'=>FALSE,
			 'file_name'=>$new_convert_file_name,	
			 'file_post_name'=>"userfile",	
		);  
			
			
		 $this->ci->upload->initialize($this->config);
	   
		if($this->ci->upload->do_upload($this->config['file_post_name']))
		{
			$this->ci->data['status'] = new stdClass;
				
			$this->ci->data['status']->message = "File Uploaded Successfully";
			$this->ci->data['status']->success = TRUE;
			$this->ci->data["uploaded_file"] = $this->ci->upload->data();
			$this->ci->upload->initialize($this->config);
		}else{
			$this->ci->data['status']->message = $this->ci->upload->display_errors();
			$this->ci->data['status']->success = FALSE;
		}	
			
		return $this->ci->data;
    }
}
?>