<?php

class SqlModel {

    private $dbh;
    private array $toDoListSample;
    
    public function __construct()
    {
        require_once ROOT_PATH . "/config/db.inc.php";
        require_once "data/data.php";
        $this->dbh = $dbh;
        $this->toDoListSample = getSampleData();
    }

    public function getDbhSql($sql) {
        return $this->dbh->query($sql);
    }

    public function getToDoList() {

        try {
            $sql = "SELECT id, tarea, responsable, estado, inicio, fin FROM Tareas";
            $query = $this->dbh->query($sql);
            $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            echo "Error al descargar tarea: " . $e->getMessage();
        }
    }

    public function getToDoListSample() {
        return $this->toDoListSample;
    }


    public function modificar($id, $tarea, $responsable, $estado, $inicio, $fin) {
        try {
            $sql = "SELECT id, tarea, responsable, estado, inicio, fin FROM Tareas WHERE id = '$id'";
            $query = $this->dbh->query($sql);
            $dato = $query->fetchAll(PDO::FETCH_ASSOC);
            $dato = $dato[0];

            $existe = true;

            $newTarea = ($tarea == "") ? $dato["tarea"] : $tarea;
            $newResponsable = ($responsable == "") ? $dato["responsable"] : $responsable;
            $newEstado = ($estado == "") ? $dato["estado"] : $estado;
            $newInicio = ($inicio == "") ? $dato["inicio"] : $inicio;
            $newFin = ($fin == "") ? $dato["fin"] : $fin;  
            $sql = "UPDATE Tareas SET tarea = '$newTarea', responsable = '$newResponsable', estado = '$newEstado', inicio = '$newInicio', fin = '$newFin'  WHERE id = '$id'";
            $query = $this->dbh->query($sql);

            } catch (PDOException $e) {
            echo "Estatara no se ha podido modificar " . $e->getMessage();
            $existe = false;
        }

        return $existe;  

    }      

}