<?php
include 'Contrato.php';
class Cable{

    private $nombre;
    private $direccion;
    private $telefono;
    private $coleccionContratos = [];
    private $coleccionPlanes = [];

    public function __construct($nmbr, $drccn, $tlfn, $cc = [], $cp = []){
        $this->nombre = $nmbr;
        $this->direccion = $drccn;
        $this->telefono = $tlfn;
        $this->coleccionContratos = $cc;
        $this->coleccionPlanes = $cp;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getColeccionContratos(){
        return $this->coleccionContratos;
    }
    public function getColeccionPlanes(){
        return $this->coleccionPlanes;
    }

    public function setNombre($nmbr){
        $this->nombre = $nmbr;
    }
    public function setDireccion($drccn){
        $this->direccion = $drccn;
    }
    public function setTelefono($tlfn){
        $this->telefono = $tlfn;
    }
    public function setColeccionContratos($cc){
        $this->coleccionContratos = $cc;
    }
    public function setColeccionPlanes($cp){
        $this->coleccionPlanes = $cp;
    }

    public function incorporarPlan($objPlanNuevo){
        $confirmado = false;
        $colPlanes = $this->getColeccionPlanes();
        $colCanalesNuevo = $objPlanNuevo -> getColeccionCanales();
        $mgNuevo = $objPlanNuevo -> getMegabytes();
        $indice = count($colPlanes);
        $i = 0;

        while($i < $indice && !$confirmado){
            $objPlan = $colPlanes[$i];
            $colCanales = $objPlan->getColeccionCanales;
            if(count($colCanales) == count($colCanalesNuevo)){
                $mg = $objPlan -> getMegabytes();
                if($mg == $mgNuevo){
                    $confirmado = true;
                    $coleccionPlanes[] = $objPlanNuevo;
                    $this->setColeccionPlanes($coleccionPlanes);
                }
            }
            $i++;
        }
    }

    public function buscarContrato($tipoDocumento, $numDocumento){
        $confirmado = false;
        $i = 0;
        $colContratos = $this->getColeccionContratos();
        $indice = count($colContratos);
        $encontrado = -1;

        while($i < $indice && !$confirmado){
            $contrato = $colContratos[$i];
            $cliente = $contrato -> getReferenciaCliente();
            $td = $cliente -> getTipoDocumento();
            $numDni = $cliente -> getNumDni();
            if(($td == $tipoDocumento) && ($numDni == $numDocumento)){
                $confirmado = true;
                $encontrado = $contrato;
            }
            $i++;
        }
        return $encontrado;
    }
    
    public function incorporarContrato($objPlanNuevo, $objClienteNuevo, $fechaInicio, $fechaVencimiento, $objContratoNuevo){
        $tipoContrato = is_a($objContratoNuevo, 'ContratoWeb');
        $colContratos = $this->getColeccionContratos();
        $confirmado = false;
        $i = 0;
        $indice = count($colContratos);

        while($i < $indice && !$confirmado){
            $objContrato = $colContratos[$i];
            $objCliente = $objContrato->getReferenciCliente();
            $tipoContrato2 = is_a($objContrato, 'ContratoWeb');

            $numDni = $objCliente->getNumDni();
            $numDni2 = $objClienteNuevo->getNumDni();

            if(($numDni == $numDni2) && ($tipoContrato == $tipoContrato2)){
                $activo = $objContrato -> getEstado();
                if($activo == "al dia"){
                    $objContrato->setEstado("Finalizado");
                }
            }
        }
    }

    public function __toString(){
        $cadena = "Nombre: ".$this->getNombre()." - Direccion: ".$this->getDireccion()." - Telefono: ".$this->getTelefono()." - Contratos: \n";
        foreach($this->getColeccionContratos() as $contrato){
            $cadena .= "Contrato: ".$contrato." - ";
        }
        $cadena .= " Planes: \n";
        foreach($this->getColeccionPlanes() as $plan){
            $cadena .= "Plan: ".$plan." - ";
        }
        return $cadena;
    }
}  
?>