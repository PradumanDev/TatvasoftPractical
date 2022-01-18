<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

	public function index(){
		$eventData = $this->my_model->selectData([
			'fields' => '*',
			'table' => 'events',
			'limit' => [
				'limit' => 2,
				'offset' => 0
			]
		]);

		
		$this->load->view('header' , ['pageTitle' => 'Event List']);
		$this->load->view('event_list' , ['eventData' => $eventData]);
		$this->load->view('footer');
	}

	public function add_new_event($eventId = ''){

		$eventData = [];
		if($eventId != ''){ //in case of edit event
			$eventData = $this->my_model->selectData([
				'table' => 'events',
				'where' => [
					'id' => $eventId
				],
				'limit' => 1
			]);

			if(!empty($eventData)){
				$eventData = $eventData[0];
			}else{
				redirect(base_url());
			}
		}
		
		$this->load->view('header' , ['pageTitle' => 'Add New Event']);
		$this->load->view('add_new_event' , ['eventData' => $eventData]);
		$this->load->view('footer');
	}

	public function view_event($eventId){

		$eventData = $this->my_model->selectData([
			'fields' => '*',
			'table' => 'events',
			'where' => [
				'id' => $eventId
			],
			'limit' => 1
		]);

		if(!empty($eventData)){
			$eventData = $eventData[0];
			$recurrenceData = json_decode($eventData['recurrence_data'] , true);

			$eventList = [];

			if($eventData['recurrence_type'] == 1){ 
				$onDay = 3600*24;
				$chkAry = [
					'd' => $onDay,
					'w' => $onDay*7,
					'm' => $onDay*30,
					'y' => $onDay*365,
				];

				$interval = $recurrenceData['duration']*$chkAry[$recurrenceData['type']];

				for($i = strtotime($eventData['start_date']); $i <= strtotime($eventData['end_date']); $i = $i+$interval){
					array_push($eventList , date('Y-m-d' , $i));
				}
			}
						
			$this->load->view('header' , ['pageTitle' => $eventData['title']]);
			$this->load->view('view_event' , ['eventList' => $eventList]);
			$this->load->view('footer');
		}else{
			redirect(base_url());
		}

		
	}

	
    
}
