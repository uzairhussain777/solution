<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/19/17
 * Time: 12:42 PM
 */
use \Stripe\Stripe;
use \Stripe\Charge;
use \Stripe\Token;
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Donation_content extends MY_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function donation(){
        $this->load->view('donation_view');
    }

    public function donate(){
        $CI =& get_instance();
        require_once('vendor/autoload.php');
        $this -> load -> helper('donation_content/donation_content');
        $this -> load -> model('donation_content/donation_content_model');
        $this -> load -> model('stories_content/stories_content_model');
		$cardnumber=$this->input->post('cardnumber');
        $story_id=$this->input->post('story_id');
        $date=$this->input->post('date');
        $sumdonation=$this->stories_content_model->totalsumdonations($story_id);
        $fundraisingtarget=$this->stories_content_model->getrecordstorysbyid($story_id);
	
		if(empty($sumdonation)){
			$total_donation = 0.00;
		}else{
			$total_donation = $sumdonation[0]->donation_amount;
        }
        $fundraising_target = $fundraisingtarget->fundraising_target;

        $validation=donationvalidation();
        if($validation){
            $date = explode('/', $date);
            $month = $date[0];
            $year  = $date[1];
            if($fundraising_target>$total_donation){
                if(isset($cardnumber)){
                    try{
                        Stripe::setApiKey(secret_key);
                        $token=Token::create(array(
                            "card" => array(
                                "number" => $this->input->post('cardnumber'),
                                "exp_month" => $month,
                                "exp_year" => $year,
                                "cvc" => $this->input->post('cvc')
                            )
                        ));
                        $token_id=$token->id;
                    } catch (Exception $e) {
							 $body = $e->getJsonBody();
					  		 $err  = $body['error'];
							 $message=$err['message'];
							 $validation=donationvalidationfail();
							 $CI->session->set_flashdata('card_error',$message);
							 $CI->session->set_flashdata('donation_validation_error','Validation Error');
                			header("Location:" . $_SERVER['HTTP_REFERER']);
						}
					
					
                    if(!empty($token_id)){
                        try{
                            $donation_amount=$this->input->post('amount');
                            $donation_amount_dollars=$donation_amount*100;
                            $charging=Charge::create(array(
                                "amount" => $donation_amount_dollars,
                                "currency" => "usd",
                                "source" => $token_id,
                                "description" => "Payment for story"
                            ));
                            $charging_id=$charging->id;
                            $response_donation_amount=$charging->amount/100;
                            if($this->session->userdata('is_logged_in')==1){
                                $user_id=$this->session->userdata('user_id');
                                $response_donation=array(
                                    'first_name'=>$this->input->post('firstname'),
                                    'last_name'=>$this->input->post('lastname'),
                                    'email'=>$this->input->post('donation_email'),
                                    'response_id'=>$charging->id,
                                    'balance_transaction'=>$charging->balance_transaction,
                                    'exp_month'=>$charging->source->exp_month,
                                    'exp_year'=>$charging->source->exp_year,
                                    'last_4'=>$charging->source->last4,
                                    'donation_amount'=>$response_donation_amount,
                                    'user_id'=>$user_id,
                                    'story_id'=>$story_id,
                                    'donation_date_created'=>date("Y-m-d H:i:s"),
                                );
                            }else{
                                $response_donation=array(
                                    'first_name'=>$this->input->post('firstname'),
                                    'last_name'=>$this->input->post('lastname'),
                                    'email'=>$this->input->post('donation_email'),
                                    'response_id'=>$charging->id,
                                    'balance_transaction'=>$charging->balance_transaction,
                                    'exp_month'=>$charging->source->exp_month,
                                    'exp_year'=>$charging->source->exp_year,
                                    'last_4'=>$charging->source->last4,
                                    'donation_amount'=>$response_donation_amount,
                                    'story_id'=>$story_id,
                                    'donation_date_created'=>date("Y-m-d H:i:s"),
                                );
                            }
                            $story_id=$this->input->post('story_id');
                            $result=$this->load->donation_content_model->insertindonation($response_donation);
							$sumdonation=$this->stories_content_model->totalsumdonations($story_id);
					        $fundraisingtarget=$this->stories_content_model->getrecordstorysbyid($story_id);
							if(empty($sumdonation)){
								$total_donation = 0.00;
							}else{
								$total_donation = $sumdonation[0]->donation_amount;
					        }
					        $fundraising_target = $fundraisingtarget->fundraising_target;
        					if($total_donation==$fundraising_target){
        						 $result=$this->load->donation_content_model->updatestoryfunraisingstatus($story_id);
        					}
                            $CI->session->set_flashdata('success_message','Donated Successfully');
                            header("Location:" . $_SERVER['HTTP_REFERER']);
                        }
                        catch(Exception $e) {
                            echo $e;
                        }
                    }
                }
            }else{
                $CI->session->set_flashdata('donation_error','Donation not successfull. Story funraising target achieved');
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }else{
            $CI->session->set_flashdata('donation_validation_error','Validation Error');
            header("Location:" . $_SERVER['HTTP_REFERER']);
        }
    }
    /*Rumman
    end of function donation this is used for payment on stories thorugh stripe 
    this is fort site function 
    */
    public function viewdonationhistory(){
        $CI =& get_instance();
        $this -> load -> model('donation_content/donation_content_model');
        $logged_in_user_id=$this->session->userdata('user_id');

        $this->load->library("pagination");
        $offset = ($this->uri->segment(3) != '' ? $this -> uri -> segment(3): 1);
        $per_page = 5;
        $url= $this -> config -> base_url() ."donation/index";
        $totaldonation=$this->donation_content_model->getalldonationcount($logged_in_user_id);

        $pagination_detail = $this->pagination->pagination($totaldonation, $per_page, $offset, $url);
        $data['paginglinks'] = $pagination_detail['paginationLinks'];
        $data['pagermessage'] = $pagination_detail ['paginationMessage'];

        //$result=$this->categories_content_model->getallcategories($offset,$per_page);


        $donation_history=$this->donation_content_model->getdonationhistorybyuserid($logged_in_user_id,$offset,$per_page);
        if(!empty($donation_history)){
            $data['result']=$donation_history;
        }
        $this->load->view('donation_history_home_page',$data);
    }
     /*Rumman
    end of function viewdonationhistory front site function  to see the donation histroy of the logged in registered user 
    */
}