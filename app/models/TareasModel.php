<?php 

require_once "data/data.php";

class TareasModel {

    private array $toDoList;

    public function __construct() {
        $this->toDoList = getData();
    }

    public function getToDoList() {
        return $this->toDoList;
    }

    public function agregar($id, $tarea, $responsable, $estado, $inicio, $fin) {
        $nuevaToDoList = getData();
        $nuevoDato = ["id"=>$id, "tarea"=>$tarea, "responsable"=>$responsable, "estado"=>$estado, "inicio"=>$inicio, "fin"=>$fin];
        $nuevaToDoList [] = $nuevoDato;
        $data_json =  json_encode($nuevaToDoList, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/data/data.json";
        file_put_contents($archivo, $data_json);       
    }

    public function eliminar($id) {
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
        $archivo = __DIR__ . "/data/data.json";
        file_put_contents($archivo, $data_json); 
        return $found;     
    }

    public function modificar($id, $tarea, $responsable, $estado, $inicio, $fin) {
        $nuevaToDoList = getData();
        $found = false;
        $i = 0;
        foreach ($nuevaToDoList as $dato) {
            if ($dato["id"] == $id) {
                $found = true;
                $dato["tarea"] = ($tarea == "") ? $dato["tarea"] : $tarea;
                $dato["responsable"] = ($responsable == "") ? $dato["responsable"] : $responsable;
                $dato["estado"] = ($estado == "") ? $dato["estado"] : $estado;
                $dato["inicio"] = ($inicio == "") ? $dato["inicio"] : $inicio;
                $dato["fin"] = ($fin == "") ? $dato["fin"] : $fin;  
                $nuevaToDoList[$i] = $dato;
            } 
            $i ++;           
        } 
        $data_json =  json_encode($nuevaToDoList, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/data/data.json";
        file_put_contents($archivo, $data_json); 
        return $found;     

    }

    public function buscar($id, $tarea, $responsable, $estado, $inicio, $fin) {
        $nuevaToDoList = getData();
        $busco = ["id"=>$id, "tarea"=>$tarea, "responsable"=>$responsable, "estado"=>$estado, "inicio"=>$inicio, "fin"=>$fin];
        $resultado = [];
        foreach ($nuevaToDoList as $dato) {
            $j = 0;
            if ($busco["id"] == "" || $busco["id"] == $dato["id"]) {
                $j ++;
            }
            if ($busco["tarea"] == "" || $busco["tarea"] == $dato["tarea"]) {
                $j ++;
            }
            if ($busco["responsable"] == "" || $busco["responsable"] == $dato["responsable"]) {
                $j ++;
            }
            if ($busco["estado"] == "" || $busco["estado"] == $dato["estado"]) {
                $j ++;
            }
            if ($busco["inicio"] == "" || $busco["inicio"] == $dato["inicio"]) {
                $j ++;
            }
            if ($busco["fin"] == "" || $busco["fin"] == $dato["ifind"]) {
                $j ++;
            }
         
            if ($j == 6) {
                $resultado [] = $dato;
            }
        
        }
        
        return $resultado;

    }


    public function borrarLista() {
        $nuevaToDoList = [];
        $data_json =  json_encode($nuevaToDoList, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/data/data.json";
        file_put_contents($archivo, $data_json);    
    }

    public function cargarLista() {
        $sampleData = getSampleData();
        $data_json =  json_encode($sampleData, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/data/data.json";
        file_put_contents($archivo, $data_json); 

    }


}