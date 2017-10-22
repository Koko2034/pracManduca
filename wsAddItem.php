<?php

ini_set('error_reporting', E_ALL ^ E_NOTICE ^ E_WARNING);
ini_set('display_errors', 'on');
ini_set('max_execution_time', 10);
header('Content-Type: text/html; charset=utf-8');
define(FICHEROJSON, __DIR__ . DIRECTORY_SEPARATOR . 'carta.json');

$id=$_REQUEST['txtId'];
$categoria = $_REQUEST['txtCat'];
$nombre=$_REQUEST['txtName'];
$tamaño = $_REQUEST['txtsel1'];
$intervalo = $_REQUEST['txtInterval'];
$precio =$_REQUEST['txtPrice'];
$url =$_REQUEST['txtUrl'];

function isExistsJSON($id,$categoria,$nombre,$tamaño,$intervalo,$precio,$url){
    if (!file_exists(FICHEROJSON)) {
        createJson($id,$categoria,$nombre,$tamaño,$intervalo,$precio,$url);
    } else {
       modifyJson($id,$categoria,$nombre,$tamaño,$intervalo,$precio,$url);
    }
    return json_encode(array("status"=>"OK","msg"=>"Inserccion realizada"));
}
function createJSON($id,$categoria,$nombre,$tamaño,$intervalo,$precio,$url){
    $json_carta[]=[
        $id=>array(
       "id"=>$id,
       "data"=>array(
           "cat"=>$categoria,
           "name"=>$nombre,
           "size"=>$tamaño,
           "price"=>$precio,
           "interval"=>$intervalo,
           "url"=>$url
       )
   )];
    $json_carta = json_encode($json_carta);
    file_put_contents(FICHEROJSON,$json_carta);  
}
function modifyJSON($id,$categoria,$nombre,$tamaño,$intervalo,$precio,$url){
    $json_carta = json_decode(file_get_contents(FICHEROJSON),true);
    $json_carta[]=[
         $id=>array(
        "id"=>$id,
        "data"=>array(
            "cat"=>$categoria,
            "name"=>$nombre,
            "size"=>$tamaño,
            "price"=>$precio,
            "interval"=>$intervalo,
            "url"=>$url
        )
    )];
    $json_carta = json_encode($json_carta);
    unlink(FICHEROJSON);
    file_put_contents(FICHEROJSON,$json_carta);
}
echo isExistsJSON($id,$categoria,$nombre,$tamaño,$intervalo,$precio,$url);
