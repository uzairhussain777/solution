<?php

class Login_content_model extends MY_Model {
	public function __construct() {
		
		parent::__construct("support_seo");
	}
	public function validate(){
		
		$email=$this->input->post("email");
		
		$login_data = $this->findOneBy(array(
		"email" => $email
		),'sign_up');
		
		if($login_data->status!="delete"){
			return $login_data;
		}
		else{
			return false;
		}
	}
	
	
	
	public function get_date_ip(){
            return $this->db->query('SELECT INET_ATON("'.$this->input->ip_address().'") AS ip,  UTC_TIMESTAMP() AS cur_date ')->row();
	}
	
	
	
	function insert_modified($values,$table='support_modified_log') //Mayank

	{

		$this->ip_date = $this->get_date_ip();

		$ModifiedBy = $this->session->userdata('userid')? $this->session->userdata('userid') : '';

		$ModifiedDate=$this->ip_date->cur_date;

		$ModifiedIp=$this->ip_date->ip;

		 //echo count($values);

		if (isset($values[0]) && is_array($values[0]))

		{
		
			$i=0;

			foreach($values as $val)

			{

				$values[$i]['ModifiedBy']=$ModifiedBy;

				$values[$i]['ModifiedDate']=$ModifiedDate;

				$values[$i]['ModifiedIp']=$ModifiedIp;

				$values[$i]['Type']='User';

				$i++;

			}

			foreach ($values as $key => $value) {
				$this->Insert($value,$table);
			}

		}

		else{

			$values['ModifiedBy']=$ModifiedBy;

			$values['ModifiedDate']=$ModifiedDate;

			$values['ModifiedIp']=$ModifiedIp;

			$values['Type']='User';

				$this->Insert($values,$table);
			
		}

		return TRUE;

	}
	
	
	function create_unique_slug($string,$table,$field='Slug',$key=NULL,$value=NULL)
	{
		$t =& get_instance();
		$slug = $this->sanitize($string);
		$i = 0;
		$params = array ();
		$params[$field] = $slug;
		
		if($key)$params["$key !="] = $value;
		
		while ($t->db->where($params)->get($table)->num_rows())
		{  
			if (!preg_match ('/-{1}[0-9]+$/', $slug ))
			$slug .= '-' . ++$i;
			else
			$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			
			$params [$field] = $slug;
		}  
		
		return $slug;    

	}
	
	function sanitize($string, $force_lowercase = true, $anal = false) {
		$strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
					   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
					   "â€", "â€", ",", "<", ".", ">", "/", "?");
		$clean = trim(str_replace($strip, "", strip_tags($string)));
		$clean = preg_replace('/\s+/', "-", $clean);
		$clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
		return ($force_lowercase) ?
			(function_exists('mb_strtolower')) ?
				mb_strtolower($clean, 'UTF-8') :
				strtolower($clean) :
			$clean;
	}
	
	public function create_pwd_salt(){
		$string = md5(uniqid(rand(), true));
		return substr($string, 0, 3);
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
	
	function replace($table,$value){ 
		$this->db->replace($table, $value);
		return $this->db->insert_id();
	}
	
	public function get_one_email($id){
		return $mail_data = $this->findOneBy(array(
		"Id" => $id
		),'support_mailsettings');
	}
	
	public function register($data){
		$userid = $this->Insert($data,"sign_up");
		return $userid;
	}
	
	public function validate_register_token($token){
		
		$this->db->select('su.Status,sc.Token,sc.UserId');
		$this->db->from('users su');
		$this->db->join('support_confirmation sc', 'sc.UserId = su.Id');
		$this->db->where(" sc.Token = '$token' ");
		$result = $this->db->get();
		$result = (array) $result->result();
		
		return $result[0];	
	}
	
	public function validate_forgot_token($token){
		
		$this->db->select('su.Id,su.Type,su.Status,sf.Token,sf.UserId,sf.CreatedDate');
		$this->db->from('users su');
		$this->db->join('support_forgot sf', 'sf.UserId = su.Id');
		$this->db->where(" sf.Token = '$token' ");
		$result = $this->db->get();
		$result = (array) $result->result();
		
		if(empty($result)){
			return array();	
		}else{
			return $result[0];	
		}
	}
	
	public function confirm_user($data,$userid){
		$result=$this->update($data,"Id = $userid","users");
		return $result;
	}
	
	public function check_forgot_email($email){
		$forgot_data = $this->findOneBy(array(
		"Email" => $email,
		),'users');
		
		if($forgot_data->Status!="Delete"){
			return $forgot_data;
		}
		else{
			return false;
		}
	}
	
	public function delete_forgot_code($userid){
		$where = "UserId = '$userid' ";
		$this->delete($where, "support_forgot");
		return true;
	}
	
	// public function insert_modified($values,$table='modified_log'){
		// $ip_date = $this->get_date_ip();
		// $ModifiedBy = $this->session->userdata('userid')? $this->session->userdata('userid') : '';
		// $ModifiedDate=$ip_date->cur_date;
		// $ModifiedIp=$ip_date->ip;
		// if (is_array($values[0])){
			// $i=0;
			// foreach($values as $val){
				// $values[$i]['ModifiedBy']=$ModifiedBy;
				// $values[$i]['ModifiedDate']=$ModifiedDate;
				// $values[$i]['ModifiedIp']=$ModifiedIp;
				// $values[$i]['Type']='User';
				// $i++;
			// }
			// $this->db->insert_batch($table,$values);
		// }
		// else{
			// $values['ModifiedBy']=$ModifiedBy;
			// $values['ModifiedDate']=$ModifiedDate;
			// $values['ModifiedIp']=$ModifiedIp;
			// $values['Type']='User';
			// $this->db->insert($table, $values);
		// }
		// return $this->db->insert_id();
	// }
	
	public function check_user_fb_exist($tbl,$fb_email){
		
		$params = array(
				"select" => "*",
				"from" => $tbl,
				"where" => "Status != 'Delete'
							and Email = '$fb_email'
							and Type in ('Facebook','Both')"
				
		);
	
	// echo "<pre>";
	// print_r($params);
	// exit;
		$result = $this->find($params);
		return $result;
	}
	
	public function check_record_exist($tbl,$email){
		
		
		$params = array(
				"select" => "Id,Status,Name,LastName,Email,FacebookId",
				"from" => $tbl,
				"where" => "Status != 'Delete'
							and Email = '$email'
							and Type = 'Web'"
				
		);
	
		$result = $this->find($params);
		return $result;
	}


	public function insert_user($values,$table='users'){
		
		return $this->insert($values,$table);
	}
	
	public function update_user($values,$where,$table='users'){
		
		return $this->update($values,$where,$table);
	}
	
	public function count_all($where,$table)
	{
		return $this->count($where,$table);
	}
	
	public function get_joins($table,$value,$joins,$where,$order_by,$order,$limit='',$offset=0,$distinct='',$likearray='',$where_in='',$wherincoumn='')
	{
		$this->db->select($value);
		if (is_array($joins) && count($joins) > 0)
		{
		   foreach($joins as $k => $v)
		   {
			$this->db->join($v['table'], $v['condition'], $v['jointype']);
		   }
		}
		$this->db->order_by($order_by,$order);
		$this->db->where($where);
		if($likearray!='')
			$this->db->where($likearray);
		if($distinct!=='')
			$this->db->distinct();
		if(strlen($limit))
			 $this->db->limit($limit,$offset);
		if(!empty($where_in))	 
			$this->db->where_in($wherincoumn, $where_in);
		return $this->db->get($table);
	}
	
	function where_in($table, $select, $where='', $where_in_key, $where_in_value,$limit='',$orderby='')
	{
		$this->db->select($select);
		if($where!=''){$this->db->where($where);}    // array 
		if($limit!='')
			$this->db->limit($limit);
		if(strlen($orderby)){$this->db->order_by($orderby);}
		$this->db->where_in($where_in_key, $where_in_value);
		return $this->db->get($table);
	}
	
	function clean_session()

	{

		$array_items =array('user_logged_in'=>false,'userid'=>'','Type'=>'','email'=>'','firstname'=>'','lastname'=>'','user_fbid'=>'');

		$this->session->unset_userdata($array_items);

	}
	
	function get_all_records($table, $select=' * ', $where='', $orderby='', $limit='',$offset=0,$likearray='',$order='',$groupby='')

	{

	
		$params = array(
				"select" => $select,
				"from" => $table,
		);
		if(!empty($where)){	$params['where'] = $where;}  // WHERE CONDITION r.g array('id'=>10, 'status !=' => 'Delete')  

		if($orderby!=''){ $params['order_by'] = $orderby; }
		
		if($limit!=''){ $params['limit'] = $limit; }
		if($groupby!=''){ $params['group_by'] = $groupby; }
		
		
		return $this->find($params);
	}
	function filterOutput($string){  //Mayank
	
		if(is_object($string)){ 
			foreach($string as $key => $val) { 
				$string->$key =trim(htmlspecialchars(stripslashes($val)));
			}
		} else {
			$string=trim(htmlspecialchars(stripslashes($string)));
		}
		return 	$string;
	}
	
	
	function send_mail($to_email,$from_email,$subject,$from_text,$message,$password,$replyto='',$html=''){
		$site_settings=$this->session->userdata['site_settings'];
		//echo $password;

			$config = array(

					  'useragent' => 'CodeIgniter',

					  'protocol' => 'smtp',

					  'mailpath' => '/usr/sbin/sendmail',

					  'smtp_host' => $site_settings['smtp_host'],

					  'smtp_user' => $from_email,	

					  'smtp_pass' => $password,

					  'smtp_port' => $site_settings['smtp_port'],

					  'smtp_timeout' =>15,

					  'wordwrap' => TRUE,

					  'mailtype' => 'html',

					  'charset' => 'utf-8',

					  'validate' =>FALSE,

					  'priority' => 3,

					  'newline' => "\r\n",

					  'bcc_batch_mode' => FALSE,

					  'bcc_batch_size' => 200,

					  //'smtp_crypto' => 'ssl',

				  );

			$this->load->library('email', $config);

			$this->email->set_newline("\r\n");

			$this->email->from($from_email,$from_text);

			if($replyto!='')

			$this->email->reply_to($replyto,'');					   

			$this->email->to($to_email);

			$this->email->subject($subject);   // should be subject as required and use admin message file to write subject so we can use multi language

			

			$this->email->message($message);

			

			if($html!=''){

				ini_set('memory_limit','32M');

		 

				$this->load->library('pdf');

				$pdf = $this->pdf->load();

				$pdf->WriteHTML($html); 

				$time = time();

				$pdf->Output('./uploads/pdf/order'.$time.'.pdf', 'F');

				$this->email->attach('./uploads/pdf/order'.$time.'.pdf');

				$this->email->send();

				unlink('./uploads/pdf/order'.$time.'.pdf');

				return;

			}

			else{

			return $this->res=$this->email->send();

			//$this->res=$this->email->send();

			//$this->email->print_debugger();

			//die();

			}

	}	
	public function custom_query($query)
	{
		return $this->db->query($query);
	}
	
}
?>
