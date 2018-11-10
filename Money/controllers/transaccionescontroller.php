<?php

class transaccionesController extends AppController
{
	
    
    
    public function __construct(){
		parent::__construct();
	}

	public function index(){
		$transacciones = $this->loadmodel("transaccion");
		
        $this->_view->transaccion = $transacciones->getTransacciones();
		
		$this->_view->titulo = "Página principal";
        
		$this->_view->renderizar("index");
	}
    
    public function agregar(){
		
		if ($_POST) {
			$transacciones = $this->loadmodel("transaccion");
			$this->_view->transaccion = $transacciones->guardar($_POST);
			$this->redirect(array("controller"=>"transacciones"));
		}
        
		$cuentas = $this->loadModel("cuenta");
		$this->_view->cuenta = $cuentas->listarCuenta();
        
        $categorias = $this->loadModel("categoria");
		$this->_view->categoria = $categorias->listarTodo();
        

		$this->_view->titulo = "Agregar transaccion";
		$this->_view->renderizar("agregar");
	}
    
    public function editar($id=null){
		if ($_POST) {
			$transaccion = $this->loadmodel("transaccion");

			if ($transaccion->actualizar($_POST)) {
				$this->_view->flashMessage = "Datos guardados correctamente";
				$this->redirect(array("controller"=>"transacciones"));	
			}else{
				$this->_view->flashMessage = "Error al guardar los datos";
				$this->redirect(array("controller"=>"transacciones",
										"action"=>"editar/".$id));	
			}
		}
		$transaccion = $this->loadmodel("transaccion");
		$this->_view->transacciones = $transaccion->buscarPorId($id);
		
		$cuentas = $this->loadModel("cuenta");
		$this->_view->cuenta = $cuentas->listarCuenta();
        
        $categorias = $this->loadModel("categoria");
		$this->_view->categoria = $categorias->listarTodo();

		$this->_view->titulo = "Editar transaccion";
		$this->_view->renderizar("editar");
	}


    public function eliminar($id){
		$transaccion = $this->loadModel("transaccion");
		$registro = $transaccion->buscarPorId($id);

		if (!empty($registro)) {
			$transaccion->eliminarPorId($id);
			$this->redirect(array("controller"=>"transacciones"));
		}
	}

}
