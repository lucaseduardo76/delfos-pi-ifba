<?php

class Professor
{

    private $id;
    private $precoHora;
    private $area;
    private $quantidadeAulasAplicadas;
    private $quantidadeAlunos;
    private $descricao;
    private $userId;

    public function __construct($precoHora, $area, $quantidadeAulasAplicadas, $quantidadeAlunos, $descricao, $userId)
    {
        $this->precoHora = $precoHora;
        $this->area = $area;
        $this->quantidadeAulasAplicadas = $quantidadeAulasAplicadas;
        $this->quantidadeAlunos = $quantidadeAlunos;
        $this->descricao = $descricao;
        $this->userId = $userId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPrecoHora()
    {
        return $this->precoHora;
    }

    public function setPrecoHora($precoHora)
    {
        $this->precoHora = $precoHora;
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

    public function getQuantidadeAlunos()
    {
        return $this->quantidadeAlunos;
    }

    public function setQuantidadeAlunos($quantidadeAlunos)
    {
        $this->quantidadeAlunos = $quantidadeAlunos;
    }

    public function adicionarAluno()
    {
        $this->quantidadeAlunos += 1;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }


}