<?php
class mensagem{
    private $id;
    private $titulo;
    private $mensagem;
    private $remetente;
    private $destinatario;

    private $data;

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getMensagem()
    {
        return $this->mensagem;
    }

    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function getRemetente()
    {
        return $this->remetente;
    }

    public function setRemetente($remetente)
    {
        $this->remetente = $remetente;
    }

    public function getDestinatario()
    {
        return $this->destinatario;
    }

    public function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;
    }
}