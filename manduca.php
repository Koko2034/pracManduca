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
if($accion === "insertarCliente"){
    $id = (int)$aux['id'];
    $login = $aux['login'];
    $movil =(int)$aux['movil'];
    $pass = $aux['pass'];
    $direccion =$aux['direccion'];
    $lat =(float)$aux['lat'];
    $lon =(float)$aux['lon'];
    echo $m->insertarCliente($id,$login,$pass,$direccion,$movil,$lat,$lon);
}
if($accion ==="check"){
    $type = $aux['type'];
    $value = $aux['value'];
    echo $m ->comprobarParam($type,$value);
}


if($accion === "calculateIdTriggerVersion"){
    echo $m->calcuIDTrigguerVersion();
}

if($accion === "insertarClienteTrigguerVersion"){
    $id = $aux['id'];
    $login = $aux['login'];
    $movil =(int)$aux['movil'];
    $pass = $aux['pass'];
    $direccion =$aux['direccion'];
    $lat =(float)$aux['lat'];
    $lon =(float)$aux['lon'];
    echo $m->insertarClienteTrigerVersion($login,$pass,$direccion,$movil,$lat,$lon,$id);
}
