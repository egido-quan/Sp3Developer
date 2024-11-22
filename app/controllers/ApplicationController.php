<?php
require_once __DIR__ . "/../models/data/data.php";

/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller 
{
	public function indexAction() {
        $tareas = new TareasModel();
        $this->view->lista = [];
        $this->view->lista = $tareas->getToDoList();
    }
    
    public function agregarAction() {     

    }

    public function confAgregarAction() {

    }

    public function eliminarAction() {

    }

    public function confEliminarAction() {

    }


    public function modificarAction() {

    }


    public function confModificarAction() {

    }

    public function buscarAction() {

    }

    public function confBuscarAction() {

    }
    public function borrarListaAction() {

    }

    public function confBorrarListaAction() {
        $nuevaToDoList = [];
        $data_json =  json_encode($nuevaToDoList, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/../models/data/data.json";;
        file_put_contents($archivo, $data_json);  
    }

    public function cargarListaAction() {

    }

    public function confCargarListaAction() {
        $sampleData = getSampleData();
        $data_json =  json_encode($sampleData, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/../models/data/data.json";
        file_put_contents($archivo, $data_json); 
    }

}



