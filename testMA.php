<?php

ini_set('error_reporting', E_ALL ^ E_NOTICE);
ini_set('display_errors', 'on');
ini_set('max_execution_time', 10);

require_once __DIR__ . '/manduca.class.php';

$m = new manduca();

echo $m->testOC();
