<?php

require_once __DIR__ . "../../models/professor/Professor.php";

class ProfesorDaoMySql implements ProfessorDao{

    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

	public function delete($id) {
        $sql = $this->pdo->prepare("DELETE FROM tb_professor WHERE `id` = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
	}
    public function findAll() {
        $array = [];
        $sql = $this->pdo->query('SELECT * FROM tb_professor');
    
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
    
            foreach ($data as $item) {
                $professor = new Professor();
                $professor->setId($item['id']);
                $professor->setPrecoAula($item['preco_aula']);
                $professor->setArea($item['area']);
                $professor->setQuantidadeAulasAplicadas($item['quantidade_aulas_aplicadas']);
                $professor->setDescricao($item['descricao']);
                $professor->setAlunosId($this->getAlunosIdByProfessor($item['id']));
                $professor->setUserId($item["user_id"]);  
                
                $rating = $this->handleRating($item["rating"], $item['quantidade_aulas_aplicadas']);

                $professor->setRating($rating);
    
                $array[] = $professor;
            }
        }
    
        return $array;
    }

    public function findAllByArea($id) {
        $array = [];
        $sql = $this->pdo->prepare('SELECT * FROM tb_professor WHERE area = :id');
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
    
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
    
            foreach ($data as $item) {
                $professor = new Professor();
                $professor->setId($item['id']);
                $professor->setPrecoAula($item['preco_aula']);
                $professor->setArea($item['area']);
                $professor->setQuantidadeAulasAplicadas($item['quantidade_aulas_aplicadas']);
                $professor->setDescricao($item['descricao']);
                $professor->setAlunosId($this->getAlunosIdByProfessor($item['id']));
                $professor->setUserId($item["user_id"]);  
                
                $rating = $this->handleRating($item["rating"], $item['quantidade_aulas_aplicadas']);

                $professor->setRating($rating);
    
                $array[] = $professor;
            }
        }
    
        return $array;
    }

    private function handleRating($rating, $quantidadeAula) {
        
        if($quantidadeAula == 0){
            return 0;
        }
        $total = $rating / $quantidadeAula;
        return $total > 5 ? 5 : $total;
    }
    
    private function getAlunosIdByProfessor($professorId) {
        $sql = $this->pdo->prepare('SELECT aluno_id FROM professor_aluno WHERE professor_id = :professor_id');
        $sql->bindValue(':professor_id', $professorId, PDO::PARAM_INT);
        $sql->execute();
    
        $result = $sql->fetchAll(PDO::FETCH_COLUMN);
    
        return $result ? $result : [];
    }
    

	public function findById($id) {
        $sql = $this->pdo->prepare("SELECT * FROM tb_professor WHERE id = :id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
    
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
    
            $professor = new Professor();
            $professor->setId($item['id']);
            $professor->setPrecoAula($item['preco_aula']);
            $professor->setArea($item['area']);
            $professor->setQuantidadeAulasAplicadas($item['quantidade_aulas_aplicadas']);
            $professor->setDescricao($item['descricao']);
            $professor->setUserId($item['user_id']);
            $professor->setAlunosId($this->getAlunosIdByProfessor($item['id']));
    
            return $professor;
        }
    
        return false;
    }

    
    public function findByUserId($userId) {
        $sql = $this->pdo->prepare("SELECT * FROM tb_professor WHERE user_id = :user_id");
        $sql->bindValue(":user_id", $userId, PDO::PARAM_INT);
        $sql->execute();
    
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
    
            $professor = new Professor();
            $professor->setId($item['id']);
            $professor->setPrecoAula($item['preco_aula']);
            $professor->setArea($item['area']);
            $professor->setQuantidadeAulasAplicadas($item['quantidade_aulas_aplicadas']);
            $professor->setDescricao($item['descricao']);
            $professor->setUserId($item['user_id']);
            $professor->setAlunosId($this->getAlunosIdByProfessor($item['id'])); 
    
            return $professor;
        }
    
        return false; 
    }

	public function insert(Professor $professor) {
        $sql = $this->pdo->prepare("
            INSERT INTO tb_professor (preco_aula, area, quantidade_aulas_aplicadas, descricao, user_id) 
            VALUES (:preco_aula, :area, :quantidade_aulas_aplicadas, :descricao, :user_id)
        "); 
        $sql->bindValue(':preco_aula', $professor->getPrecoAula());
        $sql->bindValue(':area', $professor->getArea());
        $sql->bindValue(':quantidade_aulas_aplicadas', $professor->getQuantidadeAulasAplicadas());
        $sql->bindValue(':descricao', $professor->getDescricao());
        $sql->bindValue(':user_id', $professor->getUserId());
        $sql->execute();
    
        // Opcional: Retorna o ID gerado para o professor
        return $this->pdo->lastInsertId();
    }
    

	public function update(Professor $professor) {
        $sql = $this->pdo->prepare("
            UPDATE tb_professor 
            SET preco_aula = :preco_aula, 
                area = :area, 
                quantidade_aulas_aplicadas = :quantidade_aulas_aplicadas, 
                descricao = :descricao, 
                user_id = :user_id 
            WHERE id = :id
        "); 
    
        $sql->bindValue(':preco_aula', $professor->getPrecoAula());
        $sql->bindValue(':area', $professor->getArea());
        $sql->bindValue(':quantidade_aulas_aplicadas', $professor->getQuantidadeAulasAplicadas());
        $sql->bindValue(':descricao', $professor->getDescricao());
        $sql->bindValue(':user_id', $professor->getUserId());
        $sql->bindValue(':id', $professor->getId());
        $sql->execute();
    }
    
}

