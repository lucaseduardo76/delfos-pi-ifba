<?php
class mensagem
{
    private $id;
    private $alunoId;
    private $professorId;

    private $tituloMensagem;
    private $mensagem;

    public function __construct($id, $alunoId, $professorId, $tituloMensagem, $mensagem)
    {
        $this->id = $id;
        $this->alunoId = $alunoId;
        $this->professorId = $professorId;
        $this->tituloMensagem = $tituloMensagem;
        $this->mensagem = $mensagem;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAlunoId()
    {
        return $this->alunoId;
    }

    public function setAlunoId($alunoId)
    {
        $this->alunoId = $alunoId;
    }

    public function getProfessorId()
    {
        return $this->professorId;
    }

    public function setProfessorId($professorId)
    {
        $this->professorId = $professorId;
    }

    public function getTituloMensagem()
    {
        return $this->tituloMensagem;
    }

    public function setTituloMensagem($tituloMensagem)
    {
        $this->tituloMensagem = $tituloMensagem;
    }

    public function getMensagem()
    {
        return $this->mensagem;
    }

    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

}