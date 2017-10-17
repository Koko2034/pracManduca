<?php

ini_set('error_reporting', E_ALL ^ E_NOTICE);
ini_set('display_errors', 'on');
ini_set('max_execution_time', 10);

require_once __DIR__ . '/oConexion.class.php';

$oConexion = new oConexion('localhost', 'MANDUCA', 'aluR', '56_44_kKpo');

$oConexion->abrir();
$oConni = $oConexion->obtenerConexion();

$oConsulta=$oConni->query("SHOW TABLES");

while($tablas = $oConsulta->fetch_assoc()) {
    var_dump($tablas);
}
