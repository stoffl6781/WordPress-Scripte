<?php

/* 
* 
*/


$event = get_field('event'); // 'event' is your parent group
$eventLocation = $event['eventLocation']; // 'eventLocation' is your child group 
$location = $eventLocation['location']; // 'location' is you sub child group

$location = $location['address']; // 'address' is a field of your sub child group location 
