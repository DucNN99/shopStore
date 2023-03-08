<?php
    function dateFormat($date, $type = 'd-m-Y')
    {
    	if (isset($date)) {
    		return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date.' 00:00:00')->format($type);
    	} else {
    		return '';
    	}
    }
?>
