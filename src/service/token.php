<?php

require_once __DIR__ . '/../models/user/User.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';

$uDao = new UsuarioDaoMySql($pdo);


function token($tamanho = 50)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $tamanho; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateToken($uDao){
    do {
        $token = token(); //CRIANDO TOKEN PARA O USUARIO
        $tokenNovaEmpresa = token(); // CRIANDO TOKEN PARA EMPRESA
        $verify = $uDao->findByToken($token) && $uDao->findByToken($tokenNovaEmpresa); //VERIFICANDO DE TOKENS 
    
    } while ($verify);

    return $token;
}




$listUser = $uDao->findAll();



foreach ($listUser as $user) {
    $user->setToken(generateToken($uDao));
    $uDao->updateToken($user);
}



