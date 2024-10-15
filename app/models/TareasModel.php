<?php 


class TareasModel {

    private array $toDoList;

    public function __construct() {
        require_once "data/data.php";
        $this->toDoList = getData();
    }

    public function getToDoList() {
        return $this->toDoList;
    }

    public function agregar($id, $tarea, $responsable, $estado, $inicio, $fin) {
        require_once "data/data.php";
        $nuevaToDoList = getData();
        $nuevoDato = ["id"=>$id, "tarea"=>$tarea, "responsable"=>$responsable, "estado"=>$estado, "inicio"=>$inicio, "fin"=>$fin];
        $nuevaToDoList [] = $nuevoDato;
        $data_json =  json_encode($nuevaToDoList, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/data/data.json";
        file_put_contents($archivo, $data_json);       
    }

    public function eliminar($id) {
        require_once "data/data.php";
        $nuevaToDoList = getData();
        $i=0;
        foreach ($nuevaToDoList as $dato) {
            if ($dato["id"] == $id) {
                array_splice($nuevaToDoList,$i,1);
            }
            $i++;
        }
        $data_json =  json_encode($nuevaToDoList, JSON_PRETTY_PRINT);
        $archivo = __DIR__ . "/data/data.json";
        file_put_contents($archivo, $data_json);       
    }

    public function modificar($id, $tarea, $responsable, $estado, $inicio, $fin) {
        require_once "data/data.php";
        $nuevaToDoList = getData();
        $i = 0;
        foreach ($nuevaToDoList as $dato) {
            if ($dato["id"] == $id) {
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

}

}