<?php

//Establezco ver todos los errores
ini_set('error_reporting', E_ALL ^ E_NOTICE);
ini_set('display_errors', 'on');
date_default_timezone_set('Europe/Madrid');


require_once __DIR__ . '/oConexion.class.php';

class manduca{
    private $oConexcion,$oConni;

    function __construct(){
       // $this->oConexion = new oConexion('localhost', 'MANDUCA', 'aluR', '56_44_kKpo');
       $this->oConexion = new oConexion('localhost', 'MANDUCA', 'root', 'andujar34');
       $this->oConexion->abrir();
        $this->oConni = $this->oConexion->obtenerConexion();
    }
    public function __desctruct() {
        $this->oConexion->cerrar();
    }
    public function testOC() {
        ob_start();
        $oConsulta = $this->oConni->query("SHOW TABLES");
        while ($tablas = $oConsulta->fetch_assoc()) {
            var_dump($tablas);
        }
        $result = ob_get_clean();
        return $result;
    }
    function calcuId(){
        ob_start();
        $stmt = $this->oConni->prepare("SELECT max(ID) FROM CLIENTES");
        $stmt->execute();
        $debug = $stmt->errno . " " . $stmt->error; 
        $stmt->store_result();
        $stmt->bind_result($idManduca);
        $status="KO";
        if($stmt->fetch()){
            $id =$idManduca+1; 
            $status = "OK";
        }
        $stmt->close();
        return json_encode(array("status"=>$status,"id"=>$id));   
    }
    function insertarCliente($id,$login,$pass,$direccion,$movil,$lat,$lon){
        $punto = "$lat $lon";
         $stmt = $this->oConni->prepare("INSERT INTO CLIENTES (ID,LOGIN,CLAVE,DIRECCION,MOVIL,LAT,LON,PUNTO) 
                                        VALUES (?,?,?,?,?,?,?,GeomFromText('POINT($punto)')) ;");
        $status ="OK";
        $stmt->bind_param('isssidd',$id,$login,$pass,$direccion,$movil,$lat,$lon); 
        $stmt->execute();
        $html = "Introducido los datos correctamente";
        $debug = $stmt->errno . " " . $stmt->error; 
        if($stmt->affected_rows==0){
           $status = "KO";
        }
        $stmt->close();
        return json_encode(array("status"=>$status,"debug"=>$debug,"html"=>$html));
    }
    function comprobarParam($accion,$value){
        if($accion === "login"){
            $value = "'$value'";
        }
        $stmt = $this->oConni->prepare("SELECT LOGIN FROM CLIENTES WHERE ".$accion." = " .$value." ;");
        $status = "OK";
        $color= "green";
        $stmt->execute();
        $debug = $stmt->errno . " " . $stmt->error; 
        $stmt->store_result();
        $stmt->bind_result($login);
        if($stmt->fetch()){
            if($login!=null){
                $status ="KO";
                $color= "red";
            }
        }
        $stmt->close();
        return json_encode(array("status"=>$status,"color"=>$color,"debug"=>$debug));
    
    }
    
}