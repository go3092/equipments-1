<?php

function time_diff($date1, $date2=NULL, $full=FALSE)
{
    if(is_null($date2)) {
        $date2 = date('Y-m-d H:i:s');
    }

	$diff = abs(strtotime($date1) - strtotime($date2));

    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
    $minutes  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
    $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));

    if($full) {
    	return $years.' years, '.$months.' months, '.$days.' days, '.$hours.' hours, '.$minutes.' minutes, '.$seconds.' seconds';
    }

    if($years > 0) {
        return $years.' years';
    }
    if($months > 0) {
        return $months.' months';
    }
    if($days > 0) {
        return $days.' days';
    }
    if($hours > 0) {
        return $hours.' hours';
    }
    if($minutes > 0) {
        return $minutes.' minutes';
    }
    if($seconds > 0) {
        return $seconds.' seconds';
    }
}
