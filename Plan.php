<?php
include 'Canal.php';
class Plan{

    private $codigo;
    private $importe;
    private $incluyeMG;
    private $megabytes;
    private $coleccionCanales = [];

    public function __construct($cdg, $mprt, $MG = true, $mgbt = 100, $cc = []){
        $this->codigo = $cdg;
        $this->importe = $mprt;
        $this->incluyeMG = $MG;
        $this->megabytes = $mgbt;
        $this->coleccionCanales = $cc;
    }

    public function getCodigo(){
        return $this->codigo;
    }
    public function getImporte(){
        return $this->importe;
    }
    public function getIncluyeMG(){
        return $this->incluyeMG;
    }
    public function getMegabytes(){
        return $this->megabytes;
    }
    public function getColeccionCanales(){
        return $this->coleccionCanales;
    }

    public function setCodigo($cdg){
        $this->codigo = $cdg;
    }
    public function setImporte($mprt){
        $this->importe = $mprt;
    }
    public function setIncluyeMG($MG){
        $this->incluyeMG = $MG;
    }
    public function setMegabytes($mgbt){
        $this->megabytes = $mgbt;
    }
    public function setColeccionCanales($cc){
        $this->coleccionCanales = $cc;
    }

    public function __toString(){
        $cadena = "Codigo: ".$this->getCodigo()." - Importe: ".$this->getImporte()." - IncluyeMG: ".$this->getIncluyeMG()." - Megabytes: ".$this->getMegabytes()." - ColeccionCanales: \n";
        foreach($this->getColeccionCanales() as $canal){
            $cadena .= "Canal: ".$canal." - ";
        }
        return $cadena;
    }
}
?>