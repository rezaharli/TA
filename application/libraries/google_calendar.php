<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Google_calendar {

	const CALENDAR_ID 	= 'kelompokg2012@gmail.com';
	const TIMEZONE 		= 'Asia/Jakarta';

	private $cal;

    public function __construct() {
        require_once APPPATH.'third_party/Google/google.php';

    	$client_email = 'hmmmm-359@noted-fact-127906.iam.gserviceaccount.com';
        $private_key = file_get_contents(APPPATH.'libraries/hmmmm-e411eec713f8.p12');
        $scopes = array('https://www.googleapis.com/auth/calendar');

        $config = new Google_Config();
		$config->setClassConfig('Google_Cache_File', array('directory' => '../../tmp/google/cache'));

		$client = new Google_Client($config);

        $this->cal = new Google_Service_Calendar($client);

        $credentials = new Google_Auth_AssertionCredentials(
            $client_email,
            $scopes,
            $private_key
        );

        $client->setAssertionCredentials($credentials);
        if ($client->getAuth()->isAccessTokenExpired()) {
          $client->getAuth()->refreshTokenWithAssertion();
        }
    }

    function add($summary, $start, $end = ''){
    	$start_date = new DateTime($start);
    	if($end == ''){
    		$end = $start_date->modify('+1 day');
    		$end = $end->format('Y-m-d');
    	}
    	$data = new Google_Service_Calendar_Event(array(
		  'summary' => $summary,
		  'start' => array(
		    'date' => $start,
		    'timeZone' => self::TIMEZONE,
		  ),
		  'end' => array(
		    'date' => $end,
		    'timeZone' => self::TIMEZONE,
		  )
		));

		return $this->cal->events->insert(self::CALENDAR_ID, $data);
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