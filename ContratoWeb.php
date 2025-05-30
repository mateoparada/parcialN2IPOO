<?php
class ContratoWeb extends Contrato{

    private $descuento;

    public function __construct($fi, $fv, $pln, $status, $cst, $rnv, $rc, $dscnt){
        parent:: __construct($fi, $fv, $pln, $status, $cst, $rnv, $rc);
        $this->descuento = $dscnt;
    }

    public function getDescuento(){
        return $this->descuento;
    }

    public function setDescuento($dscnt){
        $this->descuento = $dscnt;
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

        $descuentoAplicado = $importeTotal * ($this->descuento / 100);
        $importeFinal = $importeTotal - $descuentoAplicado;

        $this->setCosto($importeFinal);
        return $importeFinal;
    }

    public function calcularMulta($importe, $dias) {
        $multa = $importe * 0.10 * $dias;
        return $multa;
    }

    public function actualizarEstadoContrato() {
        $diasVencidos = $this->diasContratoVencido($this);

        if ($diasVencidos == 0) {
        $this->setEstado("al día");
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
        $cadena = parent:: __toString();
        $cadena .= "Descuento: ".$this->getDescuento()."\n";
        return $cadena;
    }
}
?>