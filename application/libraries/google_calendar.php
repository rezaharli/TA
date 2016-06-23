<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Google_serviceendar {

	const CALENDAR_ID 	= APP_EMAIL;
	const TIMEZONE 		= 'Asia/Jakarta';

	private $service;

    public function __construct() {
        require_once APPPATH.'third_party/Google/google.php';

    	$client_email 	= 'hmmmm-359@noted-fact-127906.iam.gserviceaccount.com';
        $private_key 	= file_get_contents(APPPATH.'libraries/hmmmm-e411eec713f8.p12');
        $scopes 		= array('https://www.googleapis.com/auth/serviceendar');

        $config = new Google_Config();
		$config->setClassConfig('Google_Cache_File', array('directory' => '../../tmp/google/cache'));

		$client = new Google_Client($config);

        $this->service = new Google_Service_Calendar($client);

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

    function delete($id){
    	$this->service->events->delete(self::CALENDAR_ID, $id);
    }

    function insert($summary, $start, $end = null, $col_id){
    	$data = $this->make_data($summary, $start, $end, $col_id);
		return $this->service->events->insert(self::CALENDAR_ID, $data);
    }

	function get() {
		$params = array(
    		'singleEvents' => true,
    		'orderBy' => 'startTime'
			);

		$events = $this->service->events->listEvents(self::CALENDAR_ID, $params); 

		$serviceendar_datas = array();

		foreach ($events->getItems() as $event) {

			$event_date_start_str = $event->start->dateTime;
	        if(empty($event_date_start_str)) {
	          	$event_date_start_str = $event->start->date;
	        }
	        $event_date_start = new DateTime($event_date_start_str);

	        $event_date_end_str = $event->end->dateTime;
	        if(empty($event_date_end_str)) {
	          	$event_date_end_str = $event->end->date;
	        }
	        $event_date_end = new DateTime($event_date_end_str);
	        $event_date_end = $event_date_end->modify('-1 day');

	        $result = new stdClass();
	 		$result->id					= $event->id;
	 		$result->nama				= $event->summary;
	 		$result->tanggal_mulai		= $event_date_start->format("Y").'-'.$event_date_start->format("m").'-'.$event_date_start->format("j");
	 		$result->tanggal_selesai	= $event_date_end->format("Y").'-'.$event_date_end->format("m").'-'.$event_date_end->format("j");
	 		$result->google_url			= $event->htmlLink;
	 		$result->url				= base_url('event?id='.$event->id);

 		 	array_push($serviceendar_datas, $result);

	    }
	    return $serviceendar_datas;
	}

	function update($id, $summary, $start, $end = null, $col_id = null){
		$event = $this->service->events->get(self::CALENDAR_ID, $id);

    	$data = $this->make_data($summary, $start, $end);
		return $this->service->events->update(self::CALENDAR_ID, $event->getId(), $data);
	}

	private function make_data($summary, $start, $end = null, $col_id = null){
		$start_date = new DateTime($start);
    	
    	if($end){
			$end_date 	= new DateTime($end);
    		$end 		= $end_date->modify('+1 day');
    	} else {
    		$end = $start_date->modify('+1 day');
    	}
    	$end = $end->format('Y-m-d');

    	$data = array(
    		'summary' => $summary,
    		'start' => array(
    			'date' => $start,
    			'timeZone' => self::TIMEZONE,
    			),
    		'end' => array(
    			'date' => $end,
    			'timeZone' => self::TIMEZONE,
    			)
    		);

		if($col_id) $data['colorId'] = $col_id;

    	return new Google_Service_Calendar_Event($data);
	}

}