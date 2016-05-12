<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Google_calendar {

	const DEVELOPER_KEY = 'AIzaSyCBE0Wy0OpxfSJbkcoYyVi9Y1teUyOtPDE';
	const CALENDAR_ID 	= 'kelompokg2012@gmail.com';

	private $cal;
	private $calTimeZone;

    public function __construct() {
        require_once APPPATH.'third_party/Google/google.php';

    	$this->client = new Google_Client();
		$this->client->setApplicationName(APP_NAME);
		$this->client->setDeveloperKey(self::DEVELOPER_KEY);
		$this->cal = new Google_Service_Calendar($this->client);
    }

	function get() {
		$params = array(
    		'singleEvents' => true,
    		'orderBy' => 'startTime'
			);

		$events = $this->cal->events->listEvents(self::CALENDAR_ID, $params); 
		$this->calTimeZone = $events->timeZone; //GET THE TZ OF THE CALENDAR
		date_default_timezone_set($this->calTimeZone);

		$calendar_datas = array();

		foreach ($events->getItems() as $event) {

 		 	array_push($calendar_datas, $this->event_to_array($event));

	    }
	    echo json_encode($calendar_datas);
	}

	function get_by_id($event_id){
		$event = $this->cal->events->get(self::CALENDAR_ID, $event_id);
		json_encode($this->event_to_array($event));
	}

	private function event_to_array($event){
			$eventDateStr = $event->start->dateTime;
         	if(empty($eventDateStr)) {
             	// it's an all day event
             	$eventDateStr = $event->start->date;
         	}
 
         	$temp_timezone = $event->start->timeZone;
 			//THIS OVERRIDES THE CALENDAR TIMEZONE IF THE EVENT HAS A SPECIAL TZ
         	if (!empty($temp_timezone)) {
         		$timezone = new DateTimeZone($temp_timezone); //GET THE TIME ZONE
                //Set your default timezone in case your events don't have one
     		} else if (!empty($this->calTimeZone)) {
     			$timezone = new DateTimeZone($this->calTimeZone);
         	}

         	$eventdate = new DateTime($eventDateStr);
 		 	$link = $event->htmlLink;


 		 	return array(
 		 		'id'		=> $event->id,
 		 		'title'		=> $event->summary,
 		 		'start'		=> $eventdate->format("Y").'-'.$eventdate->format("m").'-'.$eventdate->format("j"),
 		 		'url'		=> base_url('event/detail/'.$event->id)
 		 		);
	}

}