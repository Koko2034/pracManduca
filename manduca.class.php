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
        $html="";
        $id=0;
        $status="";
        if($stmt->execute()){
            $stmt->store_result();
            $stmt->bind_result($idManduca);
            if($stmt->fetch()){
                $id =$idManduca+1;
            }
            $status = "ok";
        }else{
            $html = $stmt->errno . " " . $stmt->error;
            $status = "KO";
            }
        $stmt->close();
       return json_encode(array("status"=>$status,"html"=>$html,"id"=>$id));
       
        
    }
    function insertarCliente($login,$pass,$direccion,$movil,$lat,$lon){
        $stmt = $this->oConni->prepare("INSERT INTO CLIENTES (LOGIN,CLAVE,DIRECCION,MOVIL,LAT,LON) 
                                        VALUES (?,?,?,?,?,?) ;");
        $status ="ko";
        $html = "Error al introducir datos";
        $stmt->bind_param('sssiii',$login,$pass,$direccion,$movil,$lat,$lon); 
        if($stmt->execute()){
            $stmt->store_result();
            $status ="ok";
            $html = "Los datos han sido introducidos correctamente";
        }
        $stmt->close();
        return json_encode(array("status"=>$status,"html"=>$html));
    }
    function comprobarParam($accion,$value){
        $stmt = $this->oConni->prepare("SELECT * FROM CLIENTES WHERE ? = ?;");
        $stmt->bind_param('ss',$accion,$value);
        $status = "ok";
        $color= "red";
        if($stmt->execute()){
            $stmt->store_result();
            $status ="ok";
            $color= "green";
        }
        $stmt->close();
        return json_encode(array("status"=>$status,"color"=>$color));

    }
}