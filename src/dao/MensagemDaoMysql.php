<?php

require_once __DIR__ . "../../models/mensagem/Mensagem.php";
require_once __DIR__ . "./UsuarioDaoMySql.php";


class MensagemDaoMySql
{
    private $pdo;
    private $uDao;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->uDao = new UsuarioDaoMySql($pdo);
    }

    public function insert(Mensagem $m)
    {
        $sql = $this->pdo->prepare("INSERT INTO mensagem_remetente (titulo, corpo, remetente, destinatario, data) VALUES (:titulo, :corpo, :remetente, :destinatario, :data)");
        $sql->bindValue(':titulo', $m->getTitulo());
        $sql->bindValue(':corpo', $m->getMensagem());
        $sql->bindValue(':remetente', $m->getRemetente()->getId());
        $sql->bindValue(':destinatario', $m->getDestinatario()->getId());
        $sql->bindValue(':data', $m->getData());
        $sql->execute();

        $sql1 = $this->pdo->prepare("INSERT INTO mensagem_destinatario (titulo, corpo, remetente, destinatario, data) VALUES (:titulo, :corpo, :remetente, :destinatario, :data)");
        $sql1->bindValue(':titulo', $m->getTitulo());
        $sql1->bindValue(':corpo', $m->getMensagem());
        $sql1->bindValue(':remetente', $m->getRemetente()->getId());
        $sql1->bindValue(':destinatario', $m->getDestinatario()->getId());
        $sql1->bindValue(':data', $m->getData());
        $sql1->execute();
    }

    public function deleteByRemetente($id)
    {
        $sql = $this->pdo->prepare("DELETE FROM mensagem_remetente WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function deleteByDestinatario($id)
    {
        $sql = $this->pdo->prepare("DELETE FROM mensagem_destinatario WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }


    public function findByIdRemetente($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM mensagem_remetente WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
            $m = new Mensagem();
            $m->setId($item['id']);
            $m->setTitulo($item['titulo']);
            $m->setMensagem($item['corpo']);
            $m->setRemetente($this->uDao->findById($item['remetente']));
            $m->setDestinatario($this->uDao->findById($item['destinatario']));
            $m->setData($item['data']);
            return $m;
        }
        return false;
    }

    public function findByIdDestinatario($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM mensagem_destinatario WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
            $m = new Mensagem();
            $m->setId($item['id']);
            $m->setTitulo($item['titulo']);
            $m->setMensagem($item['corpo']);
            $m->setRemetente($this->uDao->findById($item['remetente']));
            $m->setDestinatario($this->uDao->findById($item['destinatario']));
            $m->setData($item['data']);
            return $m;
        }
        return false;
    }


    public function findByRemetente($id)
    {
        $array = [];
        $sql = $this->pdo->prepare("SELECT * FROM mensagem_remetente WHERE remetente = :remetente");
        $sql->bindValue(":remetente", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            foreach ($data as $item) {
                $m = new Mensagem();
                $m->setId($item['id']);
                $m->setTitulo($item['titulo']);
                $m->setMensagem($item['corpo']);
                $m->setRemetente($this->uDao->findById($item['remetente']));
                $m->setDestinatario($this->uDao->findById($item['destinatario']));
                $m->setData($item['data']);
                $array[] = $m;
            }
        }
        return array_reverse($array);
    }

    public function findByDestinatario($id)
    {
        $array = [];
        $sql = $this->pdo->prepare("SELECT * FROM mensagem_destinatario WHERE destinatario = :destinatario");
        $sql->bindValue(":destinatario", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            foreach ($data as $item) {
                $m = new Mensagem();
                $m->setId($item['id']);
                $m->setTitulo($item['titulo']);
                $m->setMensagem($item['corpo']);
                $m->setRemetente($this->uDao->findById($item['remetente']));
                $m->setDestinatario($this->uDao->findById($item['destinatario']));
                $m->setData($item['data']);
                $array[] = $m;
            }
        }
        return array_reverse($array);
    }
}
