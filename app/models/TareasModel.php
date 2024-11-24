<?php 

require_once "data/data.php";

class TareasModel {

    private array $toDoList;
    private array $toDoListSample;

    public function __construct() {
        $this->toDoList = getData();
        $this->toDoListSample = getSampleData();
    }

    public function getToDoList() {
        return $this->toDoList;
    }

    public function getToDoListSample() {
        return $this->toDoListSample;
    }



}