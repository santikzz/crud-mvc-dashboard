<?php

function formatElapsedTime($seconds) {
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $remainingSeconds = $seconds % 60;
    $formattedTime = sprintf("%02dh %02dm %02ds", $hours, $minutes, $remainingSeconds);
    return $formattedTime;
}