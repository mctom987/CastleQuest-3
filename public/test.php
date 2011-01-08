<?php
die();
ini_set('display_errors', 'On');
error_reporting(E_ALL|E_STRICT);

$to = 'thomas@crummett.us';
//$to = 'shivanfalcon@gmail.com';

$subject = 'testing';
$body = 'This is a test.';
$from = 'CastleQuest <castlequest@crummett.us>';
$headers = 'From: ' . $from . "\r\n" . 'Return-path: NULL' . "\r\n";

mail($to, $subject, $body, $headers);