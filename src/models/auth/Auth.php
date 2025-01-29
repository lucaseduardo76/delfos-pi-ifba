<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../dao/UsuarioDaoMysql.php';

class Auth {   

    //FUNÇÃO QUE CHECA SE O USUARIO ESTÁ LOGADO OU NÃO
    public function checkToken($pdo) {
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];
            // $token = $_SESSION['isADM'];
            $uDao = new UsuarioDaoMySql($pdo);
            $user = $uDao->findByToken($token);
            
            if($user){
                return $user;                
            }       

           
        }  
    }
    
}