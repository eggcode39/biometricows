<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 18/11/2019
 * Time: 19:32
 */
require 'app/models/Registro.php';
class RegistroController{
    private $log;
    private $registro;
    public function __construct()
    {
        $this->log = new Log();
        $this->registro = new Registro();
    }

    public function registrar(){
        try{
            $model = new Registro();
            $model2 = new Registro();
            $fecha = date("Y-m-d H:i:s");
            //If All OK, the message does not change
            $message = "Code 1: Ok, Code 2: Error al crear Usuario";
            if(isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['direccion']) && isset($_POST['tipo']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['sexo']) && isset($_POST['user']) && isset($_POST['pass']) ){
                $model->cNombres = $_POST['nombres'];
                $model->cApellidos = $_POST['apellidos'];
                $model->cDNI = $_POST['dni'];
                $model->cDireccion = $_POST['direccion'];
                $model->cTipo = $_POST['tipo'];
                $model->cEmail = $_POST['email'];
                $model->cTelefono = $_POST['telefono'];
                $model->cSexo = $_POST['sexo'];
                $model->dFechaReg = $fecha;
                $nueva_persona = $this->registro->registrar_persona($model);
                if($nueva_persona == 1){
                    $persona = $this->registro->obtener_persona_registro($fecha);
                    $model2->idPersona = $persona->idPersona;
                    $model2->cUsuario = $_POST['user'];
                    $model2->cPassword = $_POST['pass'];
                    $model2->dFecReg = $fecha;
                    $result = $this->registro->registrar_usuario($model2);
                } else {
                    $result = 2;
                    $message = "Code 2: Persona No Creada";
                }
            } else {
                $user = [];
                $result = 6;
                $message = "Code 6: Datos No Recibidos";
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $user = [];
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result,"message" => $message);
        $data = array("result" => $response);
        echo json_encode($data);
    }
}