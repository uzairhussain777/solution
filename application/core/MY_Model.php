<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {


    private $table_name;

    public function __construct($table_name = ""){
	parent::__construct();
	$this->table_name = $table_name;
	
	
    }
    

    public function getEmptyRecord($table=""){
	$record = $this->desc($table);
	foreach ($record as $key => $value){
	    $record[$key] = "";
	}
	return (object) $record;
    }

    /*
     * @params
     * - select = *
     * - from = self::$table_name
     * - where
     * - group_by
     * - order_by
     * - page
     * - limit = 10
     * - join
     *
     * @return An array of result or false if no result
     */
    public function find($params = array()){
    if (isset($params["distinct"]))
	    $this->db->distinct();
	if (isset($params["select"]))
	    $this->db->select($params["select"]);
	
	if (isset($params["from"]) && $params["from"])
	    $this->db->from($params["from"]);
	else
	    $this->db->from($this->table_name);
	
	if (isset($params["where"]))
	    $this->db->where($params["where"]);
	
	if (isset($params["group_by"]))
	    $this->db->group_by($params["group_by"]);
	
	if (isset($params["order_by"]))
	    $this->db->order_by($params["order_by"]);

	if (isset($params["join"])){
	    foreach($params["join"] as $join){
            foreach ($join as $table => $condition){
                $this->db->join($table,$condition);
            }
	    }
	}

	if (isset($params["page"]) || isset($params["limit"])){
	    $page = isset($params["page"]) ? $params["page"] : 1;
	    $limit = isset($params["limit"]) ? $params["limit"] : 10;

	    $this->db->limit($limit, ($page-1) * $limit);
	}
	
	$query = $this->db->get();
	return (array) $query->result();
    }

    public function findOneBy($field,$table=""){
	$result = $this->find(array("where"=>$field,"from"=>$table));

	if (isset($result[0]))
	    return $result[0];
	
	return false;
    }

    public function findBy($field,$table=""){
	$result = $this->find(array("where"=>$field,"from"=>$table));
	return $result;
    }

    /*
     * Insert records into database
     * @return entry database ID
     */
    public function insert($data,$table=""){
	$table = $table ? $table : $this->table_name;
	$attributes = $this->desc($table);
	$record = array();
	foreach ($data as $key => $value){
	    if (isset($attributes[$key])){
		$record[$key] = $value;
	    }
	}
        
	$this->db->insert($table,$record);
	//print_r($this->db->get_compiled_insert());
	return $this->get_last_insert_id();
    }

    public function update($data,$where,$table=""){
	$table = $table ? $table : $this->table_name;
	$attributes = $this->desc($table);
	$record = array();
	foreach ($data as $key => $value){
	    if (isset($attributes[$key])){
		$record[$key] = $value;
	    }
	}
	return $this->db->update($table,$record,$where);
    }

    public function delete($where,$table){
        if($where) $this->db->where($where);
	return $this->db->delete($table); 
    }
    
    public function count($where="",$table=""){
	if (!$table) $table = $this->table_name;
	$this->db->from($table);

	if($where) $this->db->where($where);

	return $this->db->count_all_results();
    }

    private function desc($table=""){
	$table = $table ? $table : $this->table_name;
	$query = $this->db->query("desc " . $table);
	$att = array(); $i=0;
	foreach ($query->result() as $row){
		$att[$row->Field] = $i++;
	}
	return $att;
    }

    private function get_last_insert_id(){
	$this->db->select("last_insert_id() as last_insert_id");
	$query = $this->db->get();
	foreach ($query->result() as $row){
		$last_insert = $row->last_insert_id;
	}
	return $last_insert;
    }

	public function create_basic_headers(){
		$header=array();
		$header['Key']=$this->session->userdata['auth_key'];
		$header['Authorization'] = $this->session->userdata('authorization');
		
		return $header;
		
	}
	public function start_api($type,$data)
	{
		//phpinfo();
		require_once 'r/magento_idroid/app/Mage.php';
		//	$client = new SoapClient('http://www.idroidcorp.com/api/soap/?wsdl');
		if($type=="add")
		{
			
		$client = new SoapClient(api_mode.'soap/?wsdl');
		$session = $client->login('idroidshipping', '123456');
		$newcustomerid = $client->call($session,'customer.create',$data);
		return $newcustomerid ;
		}
		else if($type=="update")
		{
			$client = new SoapClient(api_mode.'soap/?wsdl');
			$session = $client->login('idroidshipping', '123456');
			
			if(isset($data['customerData']['password'])){
				$data['customerData']["password_hash"]= md5($data['customerData']['password']);
			}
			
			$result = $client->call($session, 'customer.update',$data);
			return $result;
			
		}
		else if($type=="check")
		{
			$client = new SoapClient(api_mode.'v2_soap/?wsdl');
			//$client = new SoapClient('http://www.idroidcorp.com/api/v2_soap/?wsdl');
			$session = $client->login('idroidshipping', '123456');
			$result=$client->customerCustomerList($session, $data);
			return  $result;	
		}
		else if($type=="delete")
		{
         	$client = new SoapClient(api_mode.'soap/?wsdl');
			$session = $client->login('idroidshipping', '123456');
			$result = $client->call($session, 'customer.delete', $data);			
			return  $result;
		}
		
	}
	
	function send_email($message,$client_email,$email_subject,$subject_from="IDroid Care System"){
					
				// $this->load->library('email');
              	// $body = $this->email->full_html($email_subject,$message);
// 				
				// $result = $this->email
				        // ->from('support@idroidglobal.com',$subject_from)
				        // ->reply_to('support@idroidglobal.com',$subject_from)    // Optional, an account where a human being reads.
				        // ->to($client_email)
				        // ->cc("support@idroidglobal.com")
				        // ->subject($email_subject)
				        // ->message($body)
				        // ->send();
// 				
				// var_dump($result);
				// echo '<br />';
				// echo $this->email->print_debugger();
				
				// exit;
				
				
				$this->load->library('Cphpmailer');
                $oMail = new Cphpmailer();
				$oMail->IsSMTP();                                      // set mailer to use SMTP
				//$oMail->Host = "mail.honeymangos.com";
				$oMail->Host = gethostbyname("mail.honeymangos.com");
				$oMail->SMTPOptions = array('ssl' => array('verify_peer_name' => false));
				$oMail->SMTPAuth = true;     // turn on SMTP authentication
				$oMail->Username = "support@idroidglobal.com";  // SMTP username
				$oMail->Password = "786Sup@"; // SMTP password
				$oMail->Port = "587";
				
				$oMail -> SetFrom("support@idroidglobal.com", $subject_from);
                $oMail -> AddAddress($client_email);
                $oMail -> AddReplyTo("support@idroidglobal.com", "iDroid Inc");
                $oMail -> AddCC("support@idroidglobal.com");
                $oMail->isHTML(true);                                  // Set email format to HTML
				$oMail -> Subject = stripslashes($email_subject);
                $oMail->Body    = mb_convert_encoding($message, "HTML-ENTITIES", "UTF-8");
				$oMail -> Mailer = 'smtp';
 			    $oMail -> CharSet = "utf-8";
//                 
				if(!$oMail->Send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $oMail->ErrorInfo;
				} else {
				    echo 'Message has been sent';
				}
// 				
				// exit;
				
				
				// echo "<pre>";
				// print_r($email_status);
				//exit;
				
				
	
				return TRUE;
				
				//return $email_status;
	}
	
	
	 public function find_other($params = array()){
	 	$otherdb = $this->load->database('other', TRUE);
		//$this->db->reconnect();
		if (isset($params["distinct"]))
		    $otherdb->distinct();
		if (isset($params["select"]))
		    $otherdb->select($params["select"]);
		
		if (isset($params["from"]) && $params["from"])
		    $otherdb->from($params["from"]);
		else
		    $otherdb->from($this->table_name);
		
		if (isset($params["where"]))
		    $otherdb->where($params["where"]);
		
		if (isset($params["group_by"]))
		    $otherdb->group_by($params["group_by"]);
		
		if (isset($params["order_by"]))
		    $otherdb->order_by($params["order_by"]);
		
		if (isset($params["join"])){
		    foreach($params["join"] as $join){
			foreach ($join as $table => $condition){
			    $otherdb->join($table,$condition);
			}
		    }
		}
		
		if (isset($params["page"]) || isset($params["limit"])){
		    $page = isset($params["page"]) ? $params["page"] : 1;
		    $limit = isset($params["limit"]) ? $params["limit"] : 10;
		
		    $otherdb->limit($limit, ($page-1) * $limit);
		}
		
		$query = $otherdb->get();
		return (array) $query->result();
    }
	
	public function findOneBy_other($field,$table=""){
 		$result = $this->find_other(array("where"=>$field,"from"=>$table));
		if (isset($result[0]))
		    return $result[0];
	
		return false;
	}
	
    public function findBy_other($field,$table=""){
		$result = $this->find_other(array("where"=>$field,"from"=>$table));
		return $result;
    }
	
	
	 public function insert_other($data,$table=""){
		$otherdb = $this->load->database('other', TRUE);
		
		$table = $table ? $table : $this->table_name;
		$attributes = $this->desc_other($table);
		$record = array();
		foreach ($data as $key => $value){
		    if (isset($attributes[$key])){
			$record[$key] = $value;
		    }
		}
	        
		$otherdb->insert($table,$record);
		//print_r($this->db->get_compiled_insert());
		return $this->get_last_insert_id_other();
    }

    public function update_other($data,$where,$table=""){
    	$otherdb = $this->load->database('other', TRUE);
		$table = $table ? $table : $this->table_name;
		$attributes = $this->desc($table);
		$record = array();
		foreach ($data as $key => $value){
		    if (isset($attributes[$key])){
			$record[$key] = $value;
		    }
		}
		return $otherdb->update($table,$record,$where);
    }

    public function delete_other($where,$table){
		$otherdb = $this->load->database('other', TRUE);
        if($where) $otherdb->where($where);
		return $otherdb->delete($table); 
    }
    
    public function count_other($where="",$table=""){
		$otherdb = $this->load->database('other', TRUE);
		if (!$table) $table = $this->table_name;
		$otherdb->from($table);
	
		if($where) $otherdb->where($where);
	
		return $otherdb->count_all_results();
    }
	private function desc_other($table=""){
		$otherdb = $this->load->database('other', TRUE);
		$table = $table ? $table : $this->table_name;
		$query = $otherdb->query("desc " . $table);
		$att = array(); $i=0;
		foreach ($query->result() as $row){
			$att[$row->Field] = $i++;
		}
		return $att;
	}
	
	private function get_last_insert_id_other(){
		$otherdb = $this->load->database('other', TRUE);
		$otherdb->select("last_insert_id() as last_insert_id");
		$query = $otherdb->get();
		foreach ($query->result() as $row){
			$last_insert = $row->last_insert_id;
		}
		return $last_insert;
	}
	function revert_date_without_time_new($date)
	{
		if(strlen($date) && $date != "0000-00-00"){
			$to_date = $date;
	 	 	$to_date = explode("-", $to_date);
	 	 	$date = $to_date[1]."/".$to_date[2]."/".$to_date[0];	
			$myDateTime = DateTime::createFromFormat('m/d/Y', $date);
			$date = $myDateTime->format('m/d/Y');
			return  $date;	
		}else{
			return null;
		}	
	}
	function revert_date_new($date)
	{
		if(strlen($date)){
			$to_array = explode(" ", $date);
	 	 	$to_date = $to_array[0];
	 	 	$to_time = $to_array[1];
	 	 	$to_date = explode("-", $to_date);
	 	 	$date = $to_date[1]."/".$to_date[2]."/".$to_date[0]." ".$to_time;	
			
			$myDateTime = DateTime::createFromFormat('m/d/Y H:i:s', $date);
			$date = $myDateTime->format('m/d/Y H:i:s');
			return  $date;	
		}else{
			return null;
		}	
	}
	function convert_date_new($date)
	{
		if(strlen($date)){
			$to_array = explode(" ", $date);
	 	 	$to_date = $to_array[0];
	 	 	$to_time = $to_array[1];
	 	 	$to_date = explode("/", $to_date);
	 	 	$date = $to_date[2]."-".$to_date[0]."-".$to_date[1]." ".$to_time;	
				
			$date = date_create($date);
	 		$date = date_format($date, "Y-m-d H:i:s");
			return  $date;	
		}else{
			return null;
		}	
			
	}
	function convert_date_without_time($date)
	{
		if(strlen($date)){
			$to_array = explode(" ", $date);
	 	 	$to_date = $to_array[0];
	 	 	$to_date = explode("/", $to_date);
	 	 	$date = $to_date[2]."-".$to_date[0]."-".$to_date[1];	
			$date = date_create($date);
	 		$date = date_format($date, "Y-m-d");
			return  $date;	
		}else{
			return null;
		}	
			
	}
	function format_user_role($usertype)
	{
		switch ($usertype) {
			case 'csr':
				$user_role = "CSR";
				break;
			case 'country_manager':
				$user_role = "Country Manager";
				break;
			case 'warranty_registrar':
				$user_role = "Warranty Registrar";
				break;
			case 'store_manager':
				$user_role = "Store Manager";
				break;
			case 'store_operator':
				$user_role = "Store Operator";
				break;
		
			case 'technician':
				$user_role = "Technician";
				break;
		
		}
		return $user_role;
	}
	

}
