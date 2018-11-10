<?php

class CuentaModel extends AppModel
{
	public function __construct(){
		parent::__construct();
	}

	public function listarCuenta(){
        $cuentas=$this->_db->query("SELECT * FROM accounts");

        return $cuentas->fetchall();
    }
public function listarTodo(){
        $cuentas=$this->_db->query("SELECT * FROM categories");

        return $cuentas->fetchall();
    }

    public function getCuentas(){
		$cuentas = $this->_db->query("SELECT * FROM accounts");
		foreach (range(0, $cuentas->columnCount()-1) as $column_index) {
			$meta[] = $cuentas->getColumnMeta($column_index);
		}

		$resultado = $cuentas->fetchall(PDO::FETCH_NUM);

		for ($i=0; $i < count($resultado); $i++) { 
			$j = 0;
			foreach ($meta as $value) {
				$rows[$i][$value["table"]][$value["name"]] = $resultado[$i][$j];
				$j++;
			}
		}
		return $rows;
		//array("tareas"=array(), "categorias"=>array())
		//return $tareas->fetchall();
	}

	public function guardar($datos = array()){
		$consulta = $this->_db->prepare(
			"INSERT INTO accounts
			(clave, name)
			VALUES
			(:clave, :name )"
		);
		$consulta->bindParam(":clave", $datos["clave"]);
        $consulta->bindParam(":name", $datos["name"]);
		
		if ($consulta->execute()) {
			return true;
		}else{
			return false;
		}
	}

	public function buscarPorId($id){
		$cuenta= $this->_db->prepare("SELECT * FROM accounts WHERE id=:id");
		$cuenta->bindParam(":id", $id);
		$cuenta->execute();
		$registro = $cuenta->fetch();
		
		if ($registro) {
			return $registro;
		}else{
			return false;
		}
	}

	public function actualizar($datos = array()){
		
		$consulta = $this->_db->prepare(
			"UPDATE accounts SET clave=:clave, name=:name WHERE id=:id");
		$consulta->bindParam(":id", $datos["id"]);
		$consulta->bindParam(":clave", $datos["clave"]);
		$consulta->bindParam(":name", $datos["name"]);
		

		if ($consulta->execute()) {
			return true;
		}else{
			return false;
		}
	}

	public function eliminarPorId($id){
		$consulta = $this->_db->prepare("DELETE FROM accounts WHERE id=:id");
		$consulta->bindParam(":id", $id);
		if ($consulta->execute()) {
			return true;
		}else{
			return false;
		}
	}

	public function status($id, $status){
	$consulta = $this->_db->prepare(
			"UPDATE tareas SET
			status=:status
			WHERE id=:id");
		$consulta->bindParam(":id", $id);
		$consulta->bindParam(":status", $status);

		if ($consulta->execute()) {
			return true;
		}else{
			return false;
		}
	}
}