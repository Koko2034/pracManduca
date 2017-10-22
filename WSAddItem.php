<?php

ini_set('error_reporting', E_ALL ^ E_NOTICE ^ E_WARNING);
ini_set('display_errors', 'on');
ini_set('max_execution_time', 10);
header('Content-Type: text/html; charset=utf-8');

$id=$_REQUEST['txtId'];
$categoria = $_REQUEST['txtCat'];
$nombre=$_REQUEST['txtName'];
$tamaño = $_REQUEST['txtsel1'];
$intervalo = $_REQUEST['txtInterval'];
$precio =$_REQUEST['txtPrice'];
$url =$_REQUEST['txtUrl'];

function addItem($id,$categoria,$nombre,$tamaño,$intervalo,$precio,$url){

    return json_encode(array("status"=>"OK","msg"=>"Inserccion realizada"));
}

echo addItem($id,$categoria,$nombre,$tamaño,$intervalo,$precio,$url);
