<?php

class Cliente{

    private $nombre;
    private $apellido;
    private $tipoDocumento;
    private $numDni;
    private $direccion;
    private $mail;
    private $telefono;
    

    public function __construct($cnombre, $capellido, $td, $dn, $drccn, $ml, $tlfn){

        $this->nombre=$cnombre;
        $this->apellido=$capellido;
        $this->tipoDocumento = $td;
        $this->numDni = $dn;
        $this->direccion = $drccn;
        $this->mail = $ml;
        $this->telefono = $tlfn;

    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getTipoDocumento(){
        return $this->tipoDocumento;
    }
    public function getNumDni(){
        return $this->numDni;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getMail(){
        return $this->mail;
    }
    public function getTelefono(){
        return $this->telefono;
    }

    public function setNombre($cnombre){
        $this->nombre=$cnombre;
    }
    public function setApellido($capellido){
        $this->apellido=$capellido;
    }
    public function setTipoDocumento($td){
        $this->tipoDocumento = $td;
    }
    public function setNumDni($dn){
        $this->numDni = $dn;
    }
    public function setDireccion($drccn){
        $this->direccion = $drccn;
    }
    public function setMail($ml){
        $this->mail = $ml;
    }
    public function setTelefono($tlfn){
        $this->telefono = $tlfn;
    }
    
    public function __toString(){
        $texto="Nombre: ".$this->getNombre()." - Apellido: ".$this->getApellido()." - TipoDocumento:".$this->getTipoDocumento()." - NumDni: ".$this->getNumDni()." - Direccion: ".$this->getDireccion()." - Mail: ".$this->getMail()." - Telefono: ".$this->getTelefono()." - ImporteNeto:\n";
        return $texto;
    }
}
?>