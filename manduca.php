<?php

//Establezco ver todos los errores
ini_set('error_reporting', E_ALL ^ E_NOTICE);
ini_set('display_errors', 'on');
date_default_timezone_set('Europe/Madrid');
define(RUTA, __DIR__ . DIRECTORY_SEPARATOR);

require_once RUTA . 'manduca.class.php';


$accion = ($_POST['data']);
$aux = json_decode($accion,true);
$accion = $aux['accion'];

$m = new manduca();

if($accion === "calculateId"){
    echo $m->calcuId();
}
//$accion = "insertarCliente";
if($accion === "insertarCliente"){
    $login = $aux['login'];
    $movil =(int)$aux['movil'];
    $pass = $aux['pass'];
    $direccion =$aux['direccion'];
    $lat =(float)$aux['lat'];
    $lon =(float)$aux['lon'];
   /* $id="17";
    $login="Raul";
    $pass="andujar34";
    $direccion ="Compositor";
    $movil=636414000;
    $lat=40;
    $lon=30;*/
    echo $m->insertarCliente($login,$pass,$direccion,$movil,$lat,$lon);
}
if($accion ==="check"){
    $type = $aux['type'];
    $value = $aux['value'];
    echo $m ->comprobarParam($type,$value);
}
