<?php
include 'Plan.php';
include 'Canal.php';
class Contrato{

    private $fechaInicio;
    private $fechaVencimiento;
    private $plan;
    private $estado;
    private $costo;
    private $renueva;
    private $referenciaCliente;

    public function __construct($fi, $fv, $pln, $status, $cst, $rnv, $rc){
        $this->fechaInicio = $fi;
        $this->fechaVencimiento = $fv;
        $this->plan = $pln;
        $this->estado = $status;
        $this->costo = $cst;
        $this->renueva = $rnv;
        $this->referenciaCliente = $rc;
    }

    public function getFechaInicio(){
        return $this->fechaInicio;
    }
    public function getFechaVencimiento(){
        return $this->fechaVencimiento;
    }
    public function getPlan(){
        return $this->plan;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function getCosto(){
        return $this->costo;
    }
    public function getRenueva(){
        return $this->renueva;
    }
    public function getReferenciaCliente(){
        return $this->referenciaCliente;
    }

    public function setFechaInicio($fi){
        $this->fechaInicio = $fi;
    }
    public function setFechaVencimiento($fv){
        $this->fechaVencimiento = $fv;
    }
    public function setPlan($pln){
        $this->plan = $pln;
    }
    public function setEstado($status){
        $this->estado = $status;
    }
    public function setCosto($cst){
        $this->costo = $cst;
    }
    public function setRenueva($rnv){
        $this->renueva = $rnv;
    }
    public function setReferenciaCliente($rc){
        $this->referenciaCliente = $rc;
    }

    public function calcularImporte() {
        $importePlan = $this->getPlan()->getImporte();
        $importeCanales = 0;
        $colCanales = $this->getPlan()->getColeccionCanales();

        foreach ($colCanales as $canal) {
            $importeCanales += $canal->getImporte();
        }

        $importeTotal = $importePlan + $importeCanales;
        $estado = $this->getEstado();
        $diasVencidos = $this->diasContratoVencido($this);

        if ($estado == "moroso" || $estado == "suspendido") {
            $multa = $this->calcularMulta($importeTotal, $diasVencidos);
            $importeTotal += $multa;
        }

        $this->setCosto($importeTotal);
        return $importeTotal;
    }

    public function calcularMulta($importe, $dias) {
        $multa = $importe * 0.10 * $dias;
        return $multa;
    }

    public function actualizarEstadoContrato() {
        $diasVencidos = $this->diasContratoVencido($this);

        if ($diasVencidos == 0) {
        $this->setEstado("al dia");
        } elseif ($diasVencidos <= 10) {
        $this->setEstado("moroso");
        } else {
        $this->setEstado("suspendido");
        }
    }

    public function diasContratoVencido($objContrato) {
        $fechaVencimiento = $objContrato->getFechaVencimiento();
        $fechaActual = date('Y-m-d');

        $tsVencimiento = strtotime($fechaVencimiento);
        $tsActual = strtotime($fechaActual);

        if ($tsActual > $tsVencimiento) {
            $diferenciaSegundos = $tsActual - $tsVencimiento;
            $diasVencidos = floor($diferenciaSegundos / 86400);
            } else {
                $diasVencidos = 0;
            }
        return $diasVencidos;
    }

    public function __toString(){
        $cadena = "FechaInicio: ".$this->getFechaInicio()." - FechaVencimiento: ".$this->getFechaVencimiento()." - Plan: ".$this->getPlan()." - Estado: ".$this->getEstado()." - Costo: ".$this->getCosto()." - Renueva: ".$this->getRenueva()." - ReferenciaCliente: ".$this->getReferenciaCliente();
        return $cadena;
    }
}
?>