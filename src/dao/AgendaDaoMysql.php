<?php

require_once __DIR__ . "../../models/agenda/Agenda.php";

class AgendaDaoMysql implements AgendaDaoImplementa
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(Agenda $a)
    {
        $sql = $this->pdo->prepare("INSERT INTO agenda_aula (data, hora, aluno, professor, confirmada, dificuldade_aluno) VALUES (:data, :hora, :aluno, :professor, :confirmada, :dificuldade_aluno)");

        $sql->bindValue(":data", $a->getData());
        $sql->bindValue(":hora", $a->getHora());
        $sql->bindValue(":aluno", $a->getAlunoId());
        $sql->bindValue(":professor", $a->getProfessorId());
        $sql->bindValue(":confirmada", $a->getConfirmada());
        $sql->bindValue(":dificuldade_aluno", $a->getDificuldadeAluno());

        $sql->execute();
        return $this->pdo->lastInsertId();
    }
    public function insertLinkAula($id, $link)
    {
        $sql = $this->pdo->prepare("UPDATE agenda_aula SET link_aula = :link WHERE id = :id");
        $sql->bindValue(":link", $link, PDO::PARAM_STR);
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }



    public function findAllByProfessor($id)
    {
        $array = [];
        $sql = $this->pdo->prepare("SELECT * FROM agenda_aula WHERE professor = :id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $item) {
                $agenda = new Agenda();
                $agenda->setId($item['id']);
                $agenda->setData($item['data']);
                $agenda->setHora($item['hora']);
                $agenda->setAlunoId($item['aluno']);
                $agenda->setProfessorid($item['professor']);
                $agenda->setConfirmada($item['confirmada']);
                $agenda->setDificuldadeAluno($item['dificuldade_aluno']);
                $agenda->setLinkAula($item['link_aula']);  // Aqui você adiciona o novo atributo

                $array[] = $agenda;
            }
            return $array;
        }
        return false;
    }


    public function findById($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM agenda_aula WHERE id = :id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch(PDO::FETCH_ASSOC);

            $agenda = new Agenda();
            $agenda->setId($item['id']);
            $agenda->setData($item['data']);
            $agenda->setHora($item['hora']);
            $agenda->setAlunoId($item['aluno']);
            $agenda->setProfessorid($item['professor']);
            $agenda->setConfirmada($item['confirmada']);
            $agenda->setDificuldadeAluno($item['dificuldade_aluno']);
            $agenda->setLinkAula($item['link_aula']);  // Aqui você adiciona o novo atributo

            return $agenda;
        }
        return false;
    }


    public function findAllByAluno($id)
    {
        $array = [];
        $sql = $this->pdo->prepare("SELECT * FROM agenda_aula WHERE aluno = :id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $item) {
                $agenda = new Agenda();
                $agenda->setId($item['id']);
                $agenda->setData($item['data']);
                $agenda->setHora($item['hora']);
                $agenda->setAlunoId($item['aluno']);
                $agenda->setProfessorid($item['professor']);
                $agenda->setConfirmada($item['confirmada']);
                $agenda->setDificuldadeAluno($item['dificuldade_aluno']);
                $agenda->setLinkAula($item['link_aula']);  // Aqui você adiciona o novo atributo

                $array[] = $agenda;
            }
            return $array;
        }
        return false;
    }



    public function delete(Agenda $a)
    {
        $sql = $this->pdo->prepare("DELETE FROM agenda_aula WHERE id = :id");
        $sql->bindValue(":id", $a->getId(), PDO::PARAM_INT);
        $sql->execute();
    }

    public function confirmaAula(int $id)
    {
        $sql = $this->pdo->prepare("UPDATE agenda_aula SET confirmada = 2 WHERE id = :id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
    }

    public function finalizaAula(int $id)
    {
        $sql = $this->pdo->prepare("UPDATE agenda_aula SET confirmada = 0 WHERE id = :id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
    }

    public function rejeitaAula(int $id)
    {
        $sql = $this->pdo->prepare("UPDATE agenda_aula SET confirmada = -1 WHERE id = :id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
    }
}
