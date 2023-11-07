<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.formatElapsedTime
 * Type:     modifier
 * Name:     eightball
 * Purpose:  formats seconds to 00h 00m 00s
 * -------------------------------------------------------------
 */
function smarty_modifier_formatElapsedTime($time, $show_hours = true, $show_minutes = true, $show_seconds = true)
{
    $hours = "";
    $minutes = "";
    $seconds = "";
    
    if($show_hours){
        $hours = floor($time / 3600);
        $hours = sprintf("%02dh", $hours);
    }
    
    if($show_minutes){
        $minutes = floor(($time % 3600) / 60);
        $minutes = sprintf(" %02dm", $minutes);
    }

    if($show_seconds){
        $seconds = $time % 60;
        $seconds = sprintf(" %02ds", $seconds);
    }
        
    $result = sprintf("%s%s%s", $hours, $minutes, $seconds);

    // $remainingSeconds = $time % 60;
    // $formattedTime = sprintf("%02dh %02dm %02ds", $hours, $minutes, $remainingSeconds);

    return $result;

}

?>