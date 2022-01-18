<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_ajax extends CI_Controller {

	public function __Contruct(){
		
        
	}

	public function add_event(){
        $this->load->library('form_validation');

        $sDate = strtotime($_POST['start_date']);
        $eDate = strtotime($_POST['end_date']);

        if($sDate > $eDate){
            $resp = [
                'status' => false,
                'message' => 'End date should be gretter than start date.'
            ];
        }else{

            if($_POST['recurrence'] == 1){
                $recData = [
                    'duration' => $_POST['repeat_duration'],
                    'type' => $_POST['repeat_type'],
                ];
            }else{
                $recData = [
                    'duration' => $_POST['repeat_duration1'],
                    'type' => $_POST['repeat_type1'],
                    'day' => $_POST['repeat_day'],
                ];
            }
            
            $eventData = [
                'title' => $_POST['title'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'recurrence_type' => $_POST['recurrence'],
                'recurrence_data' => json_encode($recData),
            ];

            $isEdit = false;

            if(isset($_POST['targetId']) && is_numeric($_POST['targetId'])){
                $isEdit = true;
                $checkAdd = $this->my_model->updateData([
                    'table' => 'events',
                    'data' => $eventData,
                    'where' => [
                        'id' => $_POST['targetId']
                    ],
                    'limit' => 1
                ]);
            }else{
                $checkAdd = $this->my_model->insertData([
                    'table' => 'events',
                    'data' => $eventData
                ]);
            }
            

            if($checkAdd){
                $resp = [
                    'status' => true,
                    'message' => 'Event '.($isEdit?'updated':'added').' successfully.'
                ];
            }else{
                $resp = [
                    'status' => false,
                    'message' => 'Something went wrong, please try again.'
                ];
            }
        }
        
        
		
        
        echo json_encode($resp);
	}

    public function remove_event(){
        if(isset($_GET['target'])){
            $checkAdd = $this->my_model->removeData([
                'table' => 'events',
                'where' => [
                    'id' => $_GET['target']
                ],
                'limit' => 1
            ]);
            $resp = [
                'status' => true,
                'message' => 'Event removed successfully.'
            ];
        }else{
            $resp = [
                'status' => false,
                'message' => 'Something went wrong, please try again.'
            ];
        }
        echo json_encode($resp);
    }
    
}
