<?php

class Professor
{

    private $id;
    private $precoAula;
    private $area;
    private $quantidadeAulasAplicadas;
    private $alunosId;
    private $descricao;
    private $userId;
    private $rating;

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPrecoAula()
    {
        return $this->precoAula;
    }

    public function setPrecoAula($precoAula)
    {
        $this->precoAula = $precoAula;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setArea($area)
    {
        $this->area = $area;
    }

    public function getQuantidadeAulasAplicadas()
    {
        return $this->quantidadeAulasAplicadas;
    }

    public function setQuantidadeAulasAplicadas($quantidadeAulasAplicadas)
    {
        $this->quantidadeAulasAplicadas = $quantidadeAulasAplicadas;
    }

    public function getAlunosId()
    {
        return $this->alunosId;
    }

    public function setAlunosId($alunosId)
    {
        $this->alunosId = $alunosId;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }


}


interface ProfessorDao
{
    public function insert(Professor $u);
    public function findAll();
    public function findById($id);
    public function findByUserId($userId);
    public function update(Professor $u);
    public function delete($id);
}