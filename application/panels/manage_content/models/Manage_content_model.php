<?php

class Manage_content_model extends MY_Model {
	public function __construct() {
		
		parent::__construct("");
	}
	
	public function validate($email,$password){
	$email=$this->input->post("email");
	//echo $email;
	//echo $password;exit;	
		$this->db->select('admin_login.email,admin_login.password,admin_login.first_name,admin_login.last_name,
		admin_login.status,admin_login.salt');
		$this->db->from('admin_login admin_login');
		$this->db->where(" admin_login.email = '$email'AND admin_login.password='$password' ");
		
		$result = $this->db->get();
		$result = (array) $result->result();
		//echo "<pre>";print_r($result);exit;
		if(empty($result)){
			return array();	
		}else{
			return $result[0];	
		}
}
/*
	public function check_forgot_emai($email){
		$forgot_data = $this->findOneBy(array(
		"Email" => $email,
		),'admin_login');
		return true;exit;
		if($forgot_data->Status!="Delete"){
			return $forgot_data;
		}
		else{
			return false;
		}
	}
 * *
 */
		public function create_pwd_salt(){
		$string = md5(uniqid(rand(), true));
		return substr($string, 0, 3);
    }
	
	public function get_one_email($id){
		return $mail_data = $this->findOneBy(array(
		"id" => $id
		),'support_mailsettings');
	}
	
function replace($table,$value){ 
	$data=	$this->db->replace($table, $value);
		return $this->db->insert_id();
	}
	
public function generateToken($length = 40) {
		
        $characters = '0123456789';
        $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
        $charactersLength = strlen($characters)-1;
        $password = '';
		
        //select some random characters
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[mt_rand(0, $charactersLength)];
        }

        return $password;
	}
	
	public function get_date_ip(){
            return $this->db->query('SELECT INET_ATON("'.$this->input->ip_address().'") AS ip,  UTC_TIMESTAMP() AS cur_date ')->row();
	}
	
	public function validat(){
		$email=$this->input->post("email");
		
		$login_data = $this->findOneBy(array(
		"email" => $email
		),'admin_login');
		if($login_data->status!="Delete"){
			return $login_data;
		}
		else{
			return false;
		}
	}
	
	function validate_email() {
		$email = $this -> input -> post('email');
		//echo $email;exit;
		$login_data = $this->findOneBy(array(
		"email" => $email,
		),'admin_login');
		//echo "<pre>"; print_r($login_data);exit;
		return $login_data;
	}
	
	
	
	
	public function check_forgot_email($email){
		$forgot_data = $this->findOneBy(array(
		"email" => $email,
		),'admin_login');
		//return true;exit;
		
		if(!empty($forgot_data) && $forgot_data->status!="Delete"){
			return $forgot_data;
		}
		else{
			return false;
		}
	}
	
	public function validate_forgot_token($token){
		
		$this->db->select('admin_login.status,admin_login.id,admin_forgotpassword.CreatedDate');
		$this->db->from('admin_login admin_login');
		$this->db->join('admin_forgotpassword admin_forgotpassword', 'admin_forgotpassword.UserId = admin_login.id');
		$this->db->where(" admin_forgotpassword.Token = '$token' ");
		
		$result = $this->db->get();
		$result = (array) $result->result();
		echo "<pre>";print_r($result);exit;
		if(empty($result)){
			return array();	
		}else{
			return $result[0];	
		}
	}
	
	public function confirm_user($data,$id){
		$this->db->set($data);
         $this->db->where('id', $id);
        $result=$this->db->update('admin_login');
			return $result;
	}
	public function get_token_status($forgot_token){
		$this->db->select('admin_forgotpassword.Token,admin_forgotpassword.status');
		$this->db->from('admin_forgotpassword admin_forgotpassword');
		$this->db->where(" admin_forgotpassword.Token = '$forgot_token' ");
		
		$result = $this->db->get();
		$result = (array) $result->result();
		if(empty($result)){
			return array();	
		}else{
			return $result[0];	
		}
	}
	public function modify_token_status($data,$token){
	$this->db->set($data);
         $this->db->where('Token', $token);
        $result=$this->db->update('admin_forgotpassword');	
		
		
	}
	public function delete_token_status($data,$forgot_token){
	$this->db->set($data);
         $this->db->where('Token', $forgot_token);
        $result=$this->db->update('admin_forgotpassword');	
	}
	
	public function delete_forgot_code($id){
		$where = "UserId = '$id' ";
		$result=$this->delete($where, "admin_forgotpassword");
		return true;
	}
	
	
	public function count_all($where,$table)
	{
		return $this->count($where,$table);
	}
	
	
	
	
	
	function clean_session()

	{

		$array_items =array('user_logged_in'=>false,'userid'=>'','Type'=>'','email'=>'','firstname'=>'','lastname'=>'','user_fbid'=>'');

		$this->session->unset_userdata($array_items);

	}
	
	
	
}
?>
