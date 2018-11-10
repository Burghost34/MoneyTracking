<?php

class TransaccionModel extends AppModel
{

	
     public function getTransacciones()
    {
        $query = $this->_db->query("SELECT t.*, a.name AS account, c.name AS category FROM transactions AS t JOIN accounts a on t.account_id = a.id JOIN categories c on t.category_id = c.id");
        return $query->fetchAll();
    }
    
    public function guardar($datos = array()){
		$consulta = $this->_db->prepare("INSERT INTO transactions (account_id, category_id, description, date, amount) VALUES (:account_id, :category_id, :description, :date, :amount)");
        
		$consulta->bindParam(":account_id", $datos["account_id"]);
        $consulta->bindParam(":category_id", $datos["category_id"]);
        $consulta->bindParam(":description", $datos["description"]);
        $consulta->bindParam(":date", $datos["date"]);
        $consulta->bindParam(":amount", $datos["amount"]);
		
		if ($consulta->execute()) {
			return true;
		}else{
			return false;
		}
	}
    
    public function buscarPorId($id){
		$transaccion= $this->_db->prepare("SELECT * FROM transactions WHERE id=:id");
		$transaccion->bindParam(":id", $id);
		$transaccion->execute();
		$registro = $transaccion->fetch();
		
		if ($registro) {
			return $registro;
		}else{
			return false;
		}
	}

	public function actualizar($datos = array()){
		
		$consulta = $this->_db->prepare("UPDATE transactions SET account_id=:account_id, category_id=:category_id, description=:description, date=:date, amount=:amount WHERE id=:id");
        
		$consulta->bindParam(":id", $data['id']);
        $consulta->bindParam(":account_id", $datos["account_id"]);
        $consulta->bindParam(":category_id", $datos["category_id"]);
        $consulta->bindParam(":description", $datos["description"]);
        $consulta->bindParam(":date", $datos["date"]);
        $consulta->bindParam(":amount", $datos["amount"]);
		
		if ($consulta->execute()) {
			return true;
		}else{
			return false;
		}
	}


    public function eliminarPorId($id){
		$consulta = $this->_db->prepare("DELETE FROM transactions WHERE id=:id");
		$consulta->bindParam(":id", $id);
		if ($consulta->execute()) {
			return true;
		}else{
			return false;
		}
	}

    
}
