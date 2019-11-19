<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 18/11/2019
 * Time: 18:59
 */
class Registro{
    private $pdo;
    private $log;
    public function __construct(){
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }

    public function registrar_usuario($model){
        try{
            $sql = "insert into usuarios (idPersona, cUsuario, cPassword, cEstado, dFecReg) values (?,?,?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->idPersona,
                $model->cUsuario,
                $model->cPassword,
                1,
                $model->dFecReg,
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function registrar_persona($model){
        try{
            $sql = "insert into persona (cNombres, cApellidos, cDNI, cDireccion, cTipo, cEmail, cTelefono, cSexo, nEstado, dFechaReg) values (?,?,?,?,?,?,?,?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->cNombres,
                $model->cApellidos,
                $model->cDNI,
                $model->cDireccion,
                $model->cTipo,
                $model->cEmail,
                $model->cTelefono,
                $model->cSexo,
                1,
                $model->dFechaReg
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function obtener_persona_registro($dFechaReg){
        try{
            $sql = "select * from persona where dFechaReg = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$dFechaReg]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
}