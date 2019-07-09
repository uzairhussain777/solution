<?php

class Donation_content_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct("app_user");
    }

    public function insertindonation($response_donation){
        if(!empty($response_donation)){
            $result_inserted=$this->insert($response_donation,'donations');
            return $result_inserted;
        }
        else{
            echo "array is empty";
            exit;
        }
    }

    public function getdonationhistorybyuserid($user_id, $offset,$limit){
        $params=array(
            'select'=>"donations.donation_amount, donations.donation_date_created, donations.donation_amount, users.user_name, story.story_name",
            'from'=> "donations, users, story",
            'where'=>"donations.user_id='$user_id' AND users.user_id=donations.user_id AND donations.story_id=story.story_id",
            "page" => $offset,
        	"limit" => $limit
        );
        $result=$this->find($params);
        if($result !=null){
            return $result;
        }
        else{
            return false;
        }
    }

    public function getalldonationcount($user_id){
        $params=array(
            'Select'=>"donations.*",
            'from'=> "donations",
            'where'=>"donations.user_id='$user_id'"
        );
        $result=$this->find($params);
        return count($result);
    }
	
	public function updatestoryfunraisingstatus($story_id){
		$update_stories=array(
				'fundraising_status'=>'1',
			);
		$result=$this->update($update_stories,"story_id=$story_id","story");
	}
}