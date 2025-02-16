<?php

require_once __DIR__ . "../../models/user/User.php";

class UsuarioDaoMySql implements UserDaoMySql{

    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

	public function delete($id) {
        $sql = $this->pdo->prepare("DELETE FROM tb_user WHERE `id` = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
	}

	public function findAll() {
		$array = [];
        $sql = $this->pdo->query('SELECT * FROM tb_user');

        if($sql->rowCount() > 0){
           $data = $sql->fetchAll();

            foreach($data as $item){
                $u = new User();
				$u->setEmail($item['email']);
				$u->setNome($item['nome']);
				$u->setSenha($item['senha']);
				$u->setTelefone($item['telefone']);
				$u->setId($item['id']);
				$u->setLinkFoto($item['linkFoto']);

                $array[] = $u;
            }        
        }

        return $array;
	}

	public function findById($id) {
		$sql = $this->pdo->prepare("SELECT * FROM tb_user where id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $item = $sql->fetch();

           
			$u = new User();
			$u->setEmail($item['email']);
			$u->setNome($item['nome']);
			$u->setSenha($item['senha']);
			$u->setTelefone($item['telefone']);
			$u->setId($item['id']);
			$u->setLinkFoto($item['linkFoto']);

            return $u;
        }
        
        return false;
	}

	public function findByName($nome){
		$sql = $this->pdo->prepare("SELECT * FROM tb_user where nome LIKE :nome");
        $sql->bindValue(":nome", ($nome+"%"));
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $item = $sql->fetch();

           
			$u = new User();
			$u->setEmail($item['email']);
			$u->setNome($item['nome']);
			$u->setSenha($item['senha']);
			$u->setTelefone($item['telefone']);
			$u->setId($item['id']);
			$u->setLinkFoto($item['linkFoto']);

            return $u;
        }
        
        return false;
	}

    public function findByEmail($email){
		$sql = $this->pdo->prepare("SELECT * FROM tb_user where email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $item = $sql->fetch();

           
			$u = new User();
			$u->setEmail($item['email']);
			$u->setNome($item['nome']);
			$u->setSenha($item['senha']);
			$u->setTelefone($item['telefone']);
			$u->setId($item['id']);
			$u->setLinkFoto($item['linkFoto']);         
			$u->setToken($item['token']);

            return $u;
        }
        
        return false;
	}

    public function findByToken($token): User|bool{
		$sql = $this->pdo->prepare("SELECT * FROM tb_user where token = :token");
        $sql->bindValue(":token", $token);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $item = $sql->fetch();

           
			$u = new User();
			$u->setEmail($item['email']);
			$u->setNome($item['nome']);
			$u->setSenha($item['senha']);
			$u->setTelefone($item['telefone']);
			$u->setId($item['id']);
			$u->setLinkFoto($item['linkFoto']);

            return $u;
        }
        
        return false;
	}

	public function insert(User $u) {
		
        $sql = $this->pdo->prepare("INSERT INTO tb_user (nome, senha, email, telefone, token, linkFoto) VALUES (:nome, :senha, :email, :telefone, :token, :linkFoto)"); 
        $sql->bindValue(':nome', $u->getNome());
        $sql->bindValue(':email', $u->getEmail());		
        $sql->bindValue(':senha', $u->getSenha());		
        $sql->bindValue(':telefone', $u->getTelefone());
        $sql->bindValue(':token', $u->getToken());
        $sql->bindValue(':linkFoto', "../uploads/semPerfil.png");

        $sql->execute();
	}

	public function update(User $u) {
		$sql = $this->pdo->prepare("UPDATE tb_user SET nome = :nome, email = :email, senha = :senha, telefone = :telefone, linkFoto = :linkFoto WHERE id = :id"); 
        $sql->bindValue(':nome', $u->getNome());
        $sql->bindValue(':email', $u->getEmail());		
        $sql->bindValue(':senha', $u->getSenha());		
        $sql->bindValue(':telefone', $u->getTelefone());
        $sql->bindValue(':linkFoto', $u->getLinkFoto());
        $sql->bindValue(':id', $u->getId());
        $sql->execute();
	}

    public function updateToken(User $u) {
		$sql = $this->pdo->prepare("UPDATE tb_user SET token = :token WHERE id = :id"); 
      
        $sql->bindValue(':token', $u->getToken());
        $sql->bindValue(':id', $u->getId());
        $sql->execute();
	}
}