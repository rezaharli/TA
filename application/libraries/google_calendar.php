<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Google_calendar {

	const DEVELOPER_KEY = 'AIzaSyCBE0Wy0OpxfSJbkcoYyVi9Y1teUyOtPDE';
	const CALENDAR_ID 	= 'kelompokg2012@gmail.com';

	private $cal;

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

		$calendar_datas = array();

		foreach ($events->getItems() as $event) {

			$eventDateStr = $event->start->dateTime;
	        if(empty($eventDateStr)) {
	          	// it's an all day event
	          	$eventDateStr = $event->start->date;
	        }

	        $eventdate = new DateTime($eventDateStr);

	        $result = new stdClass();
	 		$result->id			= $event->id;
	 		$result->nama		= $event->summary;
	 		$result->tanggal	= $eventdate->format("Y").'-'.$eventdate->format("m").'-'.$eventdate->format("j");
	 		$result->google_url	= $event->htmlLink;
	 		$result->url		= base_url('event?id='.$event->id);

 		 	array_push($calendar_datas, $result);

	    }
	    return $calendar_datas;
	}

}