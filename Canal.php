<?php
class Canal{

    private $tipo;
    private $importe;
    private $HD;

    public function __construct($tp, $mprt, $hd){
        $this->tipo = $tp;
        $this->importe = $mprt;
        $this->HD = $hd;
    }

    public function getTipo(){
        return $this->tipo;
    }
    public function getImporte(){
        return $this->importe;
    }
    public function getHD(){
        return $this->HD;
    }

    public function setTipo($tp){
        $this->tipo = $tp;
    }
    public function setImporte($mprt){
        $this->importe = $mprt;
    }
    public function setHD($hd){
        $this->HD = $hd;
    }

    public function __toString(){
        $cadena = "Tipo: ".$this->getTipo()." - Importe: ".$this->getImporte()." - HD: ".$this->getHD()."\n";
        return $cadena;
    }
}
?>