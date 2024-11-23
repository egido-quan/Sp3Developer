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
        if ($_POST["inicio"] > $_POST["fin"]) {
            $this->view->mensaje = "La fecha final no puede ser anterior a la fecha inicial";
        } else {
            $nuevaToDoList = getData();
            $nuevoDato = ["id"=>$_POST["id"], 
                "tarea"=>$_POST["tarea"], 
                "responsable"=>$_POST["responsable"], 
                "estado"=>$_POST["estado"], 
                "inicio"=>$_POST["inicio"], 
                "fin"=>$_POST["fin"]];
                
            $nuevaToDoList [] = $nuevoDato;
            $data_json =  json_encode($nuevaToDoList, JSON_PRETTY_PRINT);
            $archivo = __DIR__ . "/../models/data/data.json";
            file_put_contents($archivo, $data_json);   
            $this->view->mensaje = "Tarea agregada!";
        }
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



