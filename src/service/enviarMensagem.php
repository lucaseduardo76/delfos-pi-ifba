<?php

require_once __DIR__ . '/../models/user/User.php';
require_once __DIR__ . '/../models/mensagem/Mensagem.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';
require '../dao/MensagemDaoMysql.php';

$uDao = new UsuarioDaoMySql($pdo);
$mDao = new MensagemDaoMySql($pdo);

$idDestinatario = filter_input(INPUT_POST, 'idDestinatario');
$titulo = filter_input(INPUT_POST, 'titulo');
$mensagem = filter_input(INPUT_POST, var_name: 'mensagem');
$remetente = $uDao->findByToken($_SESSION['token']);

if ($idDestinatario && $titulo && $mensagem && $remetente) {

    $email = new Mensagem();
    $email->setTitulo($titulo);
    $email->setDestinatario($uDao->findById($idDestinatario));
    $email->setRemetente($remetente);
    $email->setData(date('Y-m-d'));
    $email->setMensagem($mensagem);

    $mDao->insert($email);
    $_SESSION['avisoEnviarMensagem'] = "Mensagem Enviada com sucesso!";

} else {
    $_SESSION['avisoEnviarMensagem'] = "Preencha todos os campos";
    header('Location: ../views/enviarMensagem.php?idDestinatario=' . $idDestinatario);
    exit;
}

header('Location: ../views/mensagem.php');
exit;