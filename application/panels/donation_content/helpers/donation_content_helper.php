<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('donationvalidation'))
{
    function donationvalidation(){
        $CI =& get_instance();

        $CI->load->helper(array('form', 'url','file'));
        $CI->load->library('form_validation');

        $CI->form_validation->set_rules('firstname', 'First Name ', 'required');
        $CI->form_validation->set_rules('lastname', 'last Name ', 'required');
        $CI->form_validation->set_rules('cardnumber', 'Card Number ', 'required');
        $CI->form_validation->set_rules('cvc', 'Cvc Number ', 'required|max_length[3]');
        $CI->form_validation->set_rules('date', 'Date ', 'required');
		$CI->form_validation->set_rules('story_id', 'Story ID ', 'required');
		$CI->form_validation->set_rules('donation_email', 'Email', 'required');
        //$CI->form_validation->set_rules('exp_year', 'Exp Year', 'required');
        $CI->form_validation->set_rules('amount', 'Amount', 'required|is_natural_no_zero');

        if ($CI->form_validation->run() == FALSE){

            $data = array(
                'firstname' => set_value('firstname'),
                'lastname' => set_value('lastname'),
                'cardnumber' => set_value('cardnumber'),
                'cvc' => set_value('cvc'),
                'date' => set_value('date'),
                'amount' => set_value('amount'),
                'story_id'=>set_value('story_id'),
                'donation_email'=>set_value('donation_email'),
                'donation_error' => validation_errors(),
                'valid'=>0,

            );
            $CI->session->set_flashdata('donation_error','Form Validation Failed');
        }
        else
        {
            $data = array(
                'valid' => 1,
                'donation_error' => "no validation error"
            );
        }
        $CI->session->set_flashdata('user_add_data', $data);
        return $data['valid'];
    }

}

if ( ! function_exists('donationvalidationfail'))
{
    function donationvalidationfail(){
        $CI =& get_instance();

        $CI->load->helper(array('form', 'url','file'));
        $CI->load->library('form_validation');

        $CI->form_validation->set_rules('firstname', 'First Name ', 'required');
        $CI->form_validation->set_rules('lastname', 'last Name ', 'required');
        $CI->form_validation->set_rules('cardnumber', 'Card Number ', 'required');
        $CI->form_validation->set_rules('cvc', 'Cvc Number ', 'required|max_length[3]');
        $CI->form_validation->set_rules('date', 'Date ', 'required');
        $CI->form_validation->set_rules('exp_year', 'Card Correct Information is', 'required');
		$CI->form_validation->set_rules('story_id', 'Story ID ', 'required');
		$CI->form_validation->set_rules('donation_email', 'Email', 'required');
        $CI->form_validation->set_rules('amount', 'Amount', 'required|is_natural_no_zero');

        if ($CI->form_validation->run() == FALSE){

            $data = array(
                'firstname' => set_value('firstname'),
                'lastname' => set_value('lastname'),
                'cardnumber' => set_value('cardnumber'),
                'cvc' => set_value('cvc'),
                'date' => set_value('date'),
                'amount' => set_value('amount'),
                'story_id'=>set_value('story_id'),
                'donation_email'=>set_value('donation_email'),
                'donation_error' => validation_errors(),
                'valid'=>0,

            );
			
            $CI->session->set_flashdata('donation_error','Form Validation Failed');
        }
        else
        {
            $data = array(
                'valid' => 1,
                'donation_error' => "no validation error"
            );
        }
        $CI->session->set_flashdata('user_add_data', $data);
        return $data['valid'];
    }

}