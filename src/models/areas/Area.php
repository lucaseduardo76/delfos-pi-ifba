<?php
class Area{

    private $id;
    private $area;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getArea() {
        return $this->area;
    }

    public function setArea($area) {
        $this->area = $area;
    }
}

interface AreaDaoImplementa
{
    public function insert(Area $u);
    public function findAll();
    public function findById($id);
}