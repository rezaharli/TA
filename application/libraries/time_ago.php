<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
* 
*/
class Time_ago {
	
	function timeAgo($timestamp){
        $datetime1=new DateTime("now");
        $datetime2=date_create($timestamp);
        $diff=date_diff($datetime1, $datetime2);
        $timemsg='';
        if($diff->y > 0){
            $timemsg = $diff->y .' tahun';

        }
        else if($diff->m > 0){
         $timemsg = $diff->m . ' bulan';
        }
        else if($diff->d > 0){
         $timemsg = $diff->d .' hari';
        }
        else if($diff->h > 0){
         $timemsg = $diff->h .' jam';
        }
        else if($diff->i > 0){
         $timemsg = $diff->i .' menit';
        }
        else if($diff->s > 0){
         $timemsg = $diff->s .' detik';
        }

    $timemsg = $timemsg.' yang lalu';
    return $timemsg;
    }
}