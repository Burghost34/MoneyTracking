<?php

class cuentasController extends AppController
{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$cuentas = $this->loadmodel("cuenta");
		$this->_view->cuentas = $cuentas->getCuentas();
		
		$this->_view->titulo = "Página principal";
		$this->_view->renderizar("index");
	}

	public function agregar(){
		
		if ($_POST) {
			$cuentas = $this->loadmodel("cuenta");
			$this->_view->cuentas = $cuentas->guardar($_POST);
			$this->redirect(array("controller"=>"cuentas"));
		}
		$categorias = $this->loadModel("categoria");
		$this->_view->categorias = $categorias->listarTodo();

		$this->_view->titulo = "Agregar cuenta";
		$this->_view->renderizar("agregar");
	}

	public function editar($id=null){
		if ($_POST) {
			$cuenta = $this->loadmodel("cuenta");

			if ($cuenta->actualizar($_POST)) {
				$this->_view->flashMessage = "Datos guardados correctamente";
				$this->redirect(array("controller"=>"cuentas"));	
			}else{
				$this->_view->flashMessage = "Error al guardar los datos";
				$this->redirect(array("controller"=>"cuentas",
										"action"=>"editar/".$id));	
			}
		}
		$cuenta = $this->loadmodel("cuenta");
		$this->_view->cuenta = $cuenta->buscarPorId($id);
		
		$categorias = $this->loadModel("categoria");
		$this->_view->categorias = $categorias->listarTodo();

		$this->_view->titulo = "Editar cuenta";
		$this->_view->renderizar("editar");
	}

	public function eliminar($id){
		$cuenta = $this->loadModel("cuenta");
		$registro = $cuenta->buscarPorId($id);

		if (!empty($registro)) {
			$cuenta->eliminarPorId($id);
			$this->redirect(array("controller"=>"cuentas"));
		}
	}

	public function cambiarEstado($id, $status){
		$tarea = $this->loadModel("tarea");

		if ($status=="on") {
			$status = 1;
		}elseif ($status=="off") {
			$status = 0;
		}

		$tarea->status($id, $status);
		$this->redirect(
			array("controller"=>"tareas"));
	}

}