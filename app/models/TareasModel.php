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


}