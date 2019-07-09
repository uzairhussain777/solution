<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/19/17
 * Time: 12:26 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Donation extends MY_Controller {
    public function index(){
        $this->load->view('view_donation_history_home_page');
    }

    public function payment(){
    	
        $this->load->view('donation');
    }//end of the function payment for donation by stripe on selected story

}