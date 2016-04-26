<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->load_page('page/private/home');
	}

	function calendar() {

        $this->load->library('Google/google');

    	$client = new Google_Client();
		$client->setApplicationName("hmmmm");
		$client->setDeveloperKey('AIzaSyCBE0Wy0OpxfSJbkcoYyVi9Y1teUyOtPDE');
		$cal = new Google_Service_Calendar($client);
		$calendarId = 'kelompokg2012@gmail.com';

		$params = array(
    		'singleEvents' => true,
    		'orderBy' => 'startTime'
			);

		$events = $cal->events->listEvents($calendarId, $params); 
		$calTimeZone = $events->timeZone; //GET THE TZ OF THE CALENDAR
		date_default_timezone_set($calTimeZone);

		$calendar_datas = array();

		foreach ($events->getItems() as $event) {
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
     		} else { 
     			$timezone = new DateTimeZone($calTimeZone);
         	}
 
         	$eventdate = new DateTime($eventDateStr,$timezone);
 		 	$link = $event->htmlLink;

 		 	$calendar_data = array(
 		 		'title'		=> $event->summary,
 		 		'start'		=> $eventdate->format("Y").'-'.$eventdate->format("m").'-'.$eventdate->format("j"),
 		 		'url'		=> $link . "&ctz=" . $calTimeZone
 		 		);

 		 	array_push($calendar_datas, $calendar_data);
	    }
	    echo json_encode($calendar_datas);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */