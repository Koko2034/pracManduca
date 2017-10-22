<?php 


ini_set('error_reporting', E_ALL ^ E_NOTICE ^ E_WARNING);
ini_set('display_errors', 'on');
ini_set('max_execution_time', 10);

define(RUTAWS, 'http://192.168.2.7/daw/dwes/pracFORMS/wsGeo.php');
define(RUTAWSP,'http://213.32.71.33/Servidor/pracMANDUCA/wsAddItem.php');



function PostToHost($host, $path, $referer, $data_to_send) {
    $fp = fsockopen($host, 80);
    fputs($fp, "POST $path HTTP/1.0\r\n");
    fputs($fp, "Host: $host\r\n");
    fputs($fp, "Referer: $referer\r\n");
    fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
    fputs($fp, "Content-length: " . strlen($data_to_send) . "\r\n");
    fputs($fp, "Accept-Encoding: gzip, deflate\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, "$data_to_send");
    while (!feof($fp)) {
        $res .= fgets($fp, 204800);
    }
    fclose($fp);
    if (preg_match("/Content-Encoding: gzip/", $res)) {
        $arrBuf = explode("\r\n\r\n", $res);
        $res = "$arrBuf[0]\r\n\r\n" . gzdecode($arrBuf[1]);
    }
    # quitamos cabeceras
    list($headers, $body) = explode("\r\n\r\n", $res, 2);
    return $body;
}

if($_POST['txtId']!=null && $_POST['txtCat']!=null && $_POST['txtPrice']){
    echo PostToHost('localhost', RUTAWSP, "", http_build_query($_POST));
}else{
    echo json_encode(array("status"=>"KO","msg"=>"Faltan Datos"));
}



