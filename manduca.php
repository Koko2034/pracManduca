<?php

//Establezco ver todos los errores
ini_set('error_reporting', E_ALL ^ E_NOTICE);
ini_set('display_errors', 'on');
date_default_timezone_set('Europe/Madrid');
define(RUTA, __DIR__ . DIRECTORY_SEPARATOR);

require_once RUTA . 'manduca.class.php';


$aux = json_decode($_POST['data'],true);
$accion = $aux['accion'];
$id = (int)$aux['id'];
$login = $aux['login'];
$movil =(int)$aux['movil'];
$pass = $aux['pass'];
$direccion =$aux['direccion'];
$lat =(float)$aux['lat'];
$lon =(float)$aux['lon'];
$type = $aux['type'];
$value = $aux['value'];

$m = new manduca();

$accion = $aux['accion'];
$id = (int)$aux['id'];
$login = $aux['login'];
$movil =(int)$aux['movil'];
$pass = $aux['pass'];
$direccion =$aux['direccion'];
$lat =(float)$aux['lat'];
$lon =(float)$aux['lon'];


if($accion === "calculateId"){
    echo $m->calcuId();
}
if($accion === "insertarCliente"){
    echo $m->insertarCliente($id,$login,$pass,$direccion,$movil,$lat,$lon);
}
if($accion ==="check"){
    echo $m ->comprobarParam($type,$value);
}

