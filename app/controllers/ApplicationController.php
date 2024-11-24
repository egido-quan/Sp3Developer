<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller 
{
	public function indexAction() {
        $tareas = new SqlModel();
        $this->view->lista = $tareas->getToDoList();
    }

    
    public function agregarAction() {   
        
        $tareas = new SqlModel();

        $lista = [];
        $lista = $tareas->getToDoList();
        $last = $lista[count($lista) - 1];
        $this->view->newId = $last["id"] + 1;

    }


    public function confAgregarAction() {
        if ($_POST["inicio"] > $_POST["fin"]) {
            $this->view->mensaje = "La fecha final no puede ser anterior a la fecha inicial";
        } else {
            $tareas = new SqlModel();
            /*$nuevaToDoList = $tareas->getToDoList();
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
            $this->view->mensaje = "Tarea agregada!";*/

            $tarea = $_POST["tarea"];
            $responsable = $_POST["responsable"];
            $estado = $_POST["estado"];
            $inicio = $_POST["inicio"];
            $fin = $_POST["fin"];

            try {
                $sql = "INSERT INTO `Tareas` (`tarea`, `responsable`, `estado`, `inicio`, `fin`) 
                VALUES ('$tarea', '$responsable', '$estado', '$inicio', '$fin')";
                $query = $tareas->getDbhSql($sql);  
                $this->view->mensaje = "Tarea agregada!";
    
                } catch (PDOException $e) {
                    $this->view->mensaje = "Error al agregar tarea: " . $e->getMessage();
                }
            }
    }
    


    public function eliminarAction() {

    }


    public function confEliminarAction() {

        $id = $_POST["id"];
/*
        $tareas = new TareasModel();
        $nuevaToDoList = $tareas->getToDoList();
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
        file_put_contents($archivo, $data_json); */

        $tareas = new SqlModel();

        try {
            $sql = "DELETE FROM Tareas WHERE `Tareas`.`id` = '$id'";
            $query = $tareas->getDbhSql($sql); 
            $this->view->mensaje = "Tarea eliminada !";

        } catch (PDOException $e) {
            $$this->view->mensaje = "Error al eliminar la tarea" . $e->getMessage();
        }
    }

    public function modificarAction() {

        $tareas = new TareasModel();
        $nuevaToDoList = $tareas->getToDoList();
        $this->view->dato = $nuevaToDoList[$_POST["id"] - 1];

    }


    public function confModificarAction() {

        if ($_POST["inicio"] > $_POST["fin"]) {
            $this->view->mensaje = "La fecha final no puede ser anterior a la fecha inicial";
        } else {

            $tareas = new TareasModel();
            $nuevaToDoList = $tareas->getToDoList();

            $datoActual = ($nuevaToDoList[$_POST["id"] - 1]);

            $datoModificado = [];
            $datoModificado["id"] = $_POST["id"];
            $datoModificado["tarea"] = ($_POST["tarea"] == "") ? $datoActual["tarea"] : $_POST["tarea"];
            $datoModificado["responsable"] = ($_POST["responsable"] == "") ? $datoActual["responsable"] : $_POST["responsable"];
            $datoModificado["estado"] = ($_POST["estado"] == "") ? $datoActual["estado"] : $_POST["estado"];
            $datoModificado["inicio"] = ($_POST["inicio"] == "") ? $datoActual["inicio"] : $_POST["inicio"];
            $datoModificado["fin"] = ($_POST["fin"] == "") ? $datoActual["fin"] : $_POST["fin"];  

            $nuevaToDoList[$_POST["id"] - 1] = $datoModificado;       
            
            $data_json =  json_encode($nuevaToDoList, JSON_PRETTY_PRINT);
            $archivo = __DIR__ . "/../models/data/data.json";
            file_put_contents($archivo, $data_json); 
            $this->view->mensaje = "Tarea modificada !";
        }
    }


    public function buscarAction() {

    }


    public function confBuscarAction() {

        try {

            $tareas = new SqlModel();
            $listaTareas = $tareas->getToDoList();
            /*$busqueda = [
                "id"=>$_POST["id"],
                "tarea"=>$_POST["tarea"],
                "responsable"=>$_POST["responsable"],
                "estado"=>$_POST["estado"],
                "inicio"=>$_POST["inicio"],
                "fin"=>$_POST["fin"]
            ];*/
            $id = $_POST["id"];
            $tarea = $_POST["tarea"];
            $responsable = $_POST["responsable"];
            $estado = $_POST["estado"];
            $inicio = $_POST["inicio"];
            $fin = $_POST["fin"];
            $busqueda = ["id"=>$id, "tarea"=>$tarea, "responsable"=>$responsable, "estado"=>$estado, "inicio"=>$inicio, "fin"=>$fin];
            
            $resultado = [];

            foreach ($listaTareas as $dato) {
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
            $this->view->mensaje = "Este es el resultado de la búsqueda";

        } catch (PDOException $e) {
            $this->view->mensaje = "Error en la búsqueda: " . $e->getMessage();
        }
    }


    public function borrarListaAction() {

    }


    public function confBorrarListaAction() {
        /*$nuevaToDoList = [];
        $data_json =  json_encode($nuevaToDoList, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/../models/data/data.json";
        file_put_contents($archivo, $data_json);*/

        $tareas = new SqlModel();
        
        try {
            
            $sql = "TRUNCATE TABLE Tareas";
            $query = $tareas->getDbhSql($sql);   
            $this->view->mensaje = "Lista borrada !";

        } catch (PDOException $e) {
            $$this->view->mensaje = "Error al borrar la lista" . $e->getMessage();
        }

    }


    public function cargarListaAction() {

    }


    public function confCargarListaAction() {
        /*$tareas = new TareasModel();
        $sampleData = $tareas->getToDoListSample();
        $data_json =  json_encode($sampleData, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/../models/data/data.json";
        file_put_contents($archivo, $data_json); */

        //include "data/data.php";
        $tareas = new SqlModel();
        $sampleData = getSampleData();
        $sql = "TRUNCATE TABLE Tareas";
        $query = $tareas->getDbhSql($sql);
        
        foreach ($sampleData as $tarea)
        try { 
            $sql = "INSERT INTO `Tareas` (`tarea`, `responsable`, `estado`, `inicio`, `fin`) 
            VALUES ('$tarea[tarea]', '$tarea[responsable]', '$tarea[estado]', '$tarea[inicio]', '$tarea[fin]')";
            $query = $tareas->getDbhSql($sql); 
            $this->view->mensaje = "Lista de muestra cargada !";

        } catch (PDOException $e) {
            $this->view->mensaje =  "Error al agregar tarea: " . $e->getMessage();

        }   
    }


    public function arreglar ($texto): string {
        $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
        $texto = preg_replace('/[^a-zA-Z0-9\s]/', '', $texto);
        return strtolower($texto);
    }

}



