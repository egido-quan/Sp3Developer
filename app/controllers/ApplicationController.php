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

        $id = $_POST["id"];

        $nuevaToDoList = getData();
        $i = 0;
        $found = false;
        foreach ($nuevaToDoList as $dato) {
            if ($dato["id"] == $id) {
                array_splice($nuevaToDoList,$i,1);
                $found = true;
            }
            $i ++;
        }
        $data_json =  json_encode($nuevaToDoList, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/../models/data/data.json";
        file_put_contents($archivo, $data_json); 
    }


    public function modificarAction() {

    }


    public function confModificarAction() {

    }

    public function buscarAction() {

    }

    public function confBuscarAction() {

        $nuevaToDoList = getData();

        $busqueda = [
            "id"=>$_POST["id"],
            "tarea"=>$_POST["tarea"],
            "responsable"=>$_POST["responsable"],
            "estado"=>$_POST["estado"],
            "inicio"=>$_POST["inicio"],
            "fin"=>$_POST["fin"]
        ];

        $resultado = [];

        foreach ($nuevaToDoList as $dato) {
            $j = 0;
            if ($busqueda["id"] == "" || $busqueda["id"] == $dato["id"]) {
                $j ++;
            }
            if ($busqueda["tarea"] == "" || str_contains(strtolower($dato["tarea"]), strtolower($busqueda["tarea"]))) {
                $j ++;
            }
            if ($busqueda["responsable"] == "" ||
                str_contains(self::arreglar($dato["responsable"]), self::arreglar($busqueda["responsable"]))) {
                $j ++;
            }
            if ($busqueda["estado"] == "" || $busqueda["estado"] == $dato["estado"]) {
                $j ++;
            }
            if ($busqueda["inicio"] == "" || $busqueda["inicio"] == $dato["inicio"]) {
                $j ++;
            }
            if ($busqueda["fin"] == "" || $busqueda["fin"] == $dato["fin"]) {
                $j ++;
            }
         
            if ($j == 6) {
                $resultado [] = $dato;
            }        
        }
        $this->view->resultado = $resultado;
    }
    public function borrarListaAction() {

    }

    public function confBorrarListaAction() {
        $nuevaToDoList = [];
        $data_json =  json_encode($nuevaToDoList, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/../models/data/data.json";
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

    public function arreglar ($texto): string {
        $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
        $texto = preg_replace('/[^a-zA-Z0-9\s]/', '', $texto);
        return strtolower($texto);
    }

}



