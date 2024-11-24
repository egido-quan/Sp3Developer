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

}