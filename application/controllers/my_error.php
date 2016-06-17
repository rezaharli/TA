<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class My_error extends Private_Controller {
	function __construct() 
    {
        parent::__construct(); 
    } 

    function index() 
    { 
        $this->load_page('errors/404', null);
    } 
}