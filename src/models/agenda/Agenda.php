<?php
class Agenda
{
    private $id;
    private $data;
    private $hora;
    private $alunoId;
    private $professorId;
    private $confirmada;
    private $dificuldadeAluno;
    private $linkAula;

    public function isHorarioPermitido()
    {
        $tz = new DateTimeZone('America/Sao_Paulo');
        $scheduled = new DateTime($this->data . ' ' . $this->hora, $tz);
        $now = new DateTime('now', $tz);
    
        $earliest = clone $scheduled;
        $earliest->modify('-30 minutes');
    
        $latest = clone $scheduled;
        $latest->modify('+2 hours');
    
        if ($now < $earliest || $now > $latest) {
            return false;
        }
        return true;
    }

    public function isHorarioPermitidoToFinalizar()
    {
        $tz = new DateTimeZone('America/Sao_Paulo');
        $scheduled = new DateTime($this->data . ' ' . $this->hora, $tz);
        $now = new DateTime('now', $tz);
        
        if ($now <  $scheduled) {
            return false;
        }
        return true;
    }
    

    public function getLinkAula()
    {
        return $this->linkAula;
    }

    public function setLinkAula($linkAula)
    {
        $this->linkAula = $linkAula;
    }
    public function getDificuldadeAluno()
    {
        return $this->dificuldadeAluno;
    }

    public function setDificuldadeAluno($dificuldadeAluno)
    {
        $this->dificuldadeAluno = $dificuldadeAluno;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
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

    public function getConfirmada()
    {
        return $this->confirmada;
    }

    public function setConfirmada($confirmada)
    {
        $this->confirmada = $confirmada;
    }
}

interface AgendaDaoImplementa
{
    public function insert(Agenda $a);
    public function findAllByProfessor($id);
    public function findAllByAluno($id);

    public function delete(Agenda $a);
    public function confirmaAula(int $a);
}