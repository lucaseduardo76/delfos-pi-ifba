<?php
/*  
    <form method="POST" action="../service/enviarMensagem.php">
        <input type="hidden" name="idDestinatario" value="<?= $destinatario->getId() ?>">

        <label class="campo">
            <h2>Assunto da mensagem:</h2>
            <input type="text" name="titulo" placeholder="Título..." required>
        </label>

        <label class="campo">
            <h2>Destinatário:</h2>
            <input type="text" placeholder="Nome..."  value="<?= $destinatario->getNome()?>" disabled required>
        </label>

        <label class="campo">
            <h2>Corpo da mensagem:</h2>
            <textarea rows="15" name="mensagem" required></textarea>
        </label>

        <div class="campo">
            <input type="submit" value="Enviar" class="btn-enviar" >
        </div>

    </form>
*/

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