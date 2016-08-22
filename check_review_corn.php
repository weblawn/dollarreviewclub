<?php

/**
 * @author lolkittens
 * @copyright 2016
 */
//ini_set('default_socket_timeout','6000');
//ini_set('memory_limit','-1');
ini_set('MAX_EXECUTION_TIME','600');
//set_time_limit(0);
$data = file_get_contents('http://dollarreviewclub.com/cronjob/get_review_list_fn'); 
print_r($data);

?>