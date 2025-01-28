<?php

require_once __DIR__ . "../../models/areas/Area.php";

class AreaDao implements AreaDaoImplementa{

    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll() {
        $array = [];
        $sql = $this->pdo->query('SELECT * FROM areas');
    
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
    
            foreach ($data as $item) {
                // Cria um objeto Area
                $area = new Area();
                $area->setId($item['id']);
                $area->setArea($item['nome']);  // Ajuste aqui caso o nome da coluna seja diferente
    
                // Adiciona a área ao array
                $array[] = $area;
            }
        }
    
        return $array;
    }
    
    
    

    public function findById($id) {
        // Prepara a query para buscar a área pelo ID
        $sql = $this->pdo->prepare("SELECT * FROM areas WHERE id = :id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();

        // Verifica se algum registro foi encontrado
        if ($sql->rowCount() > 0) {
            // Busca os dados da área
            $item = $sql->fetch();

            // Cria um objeto da classe Area e popula com os dados
            $area = new Area();
            $area->setId($item['id']);
            $area->setArea($item['nome']);  // Considerando que o campo 'nome' seja o nome da área

            return $area;
        }

        return false;  // Caso não encontre a área
    }

	public function insert(Area $area) {
        // Prepara a query para inserir uma nova área
        $sql = $this->pdo->prepare("
            INSERT INTO areas (nome) 
            VALUES (:nome)
        "); 
    
        // Faz o binding dos parâmetros
        $sql->bindValue(':nome', $area->getNome());
        
        // Executa a query
        $sql->execute();
        
        // Opcional: Retorna o ID gerado para a nova área
        return $this->pdo->lastInsertId();
    }
    

    
}


