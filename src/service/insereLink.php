<?php

require '../models/user/User.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';
require '../dao/AgendaDaoMysql.php';
require '../dao/ProfessorDaoMysql.php';

$aDao = new AgendaDaoMysql($pdo);
$pDao = new ProfesorDaoMySql($pdo);
$uDao = new UsuarioDaoMySql($pdo);

$aulaId = filter_input(INPUT_POST, 'aulaId');
$linkAula = filter_input(INPUT_POST, 'linkAula');

if ($aulaId && $linkAula) {

    if (!validarLinkAula($linkAula)) {
        $_SESSION['avisoLinkAula'] = "Link inválido";
        header('Location: ../views/agendaProfessor.php');
        exit;
    }

    $aula = $aDao->findById($aulaId);
    $professor = $pDao->findById($aula->getProfessorId());
    $usuarioDoProfessor = $uDao->findById($professor->getUserId());
    $usuarioLogado = $uDao->findByToken($_SESSION['token']);

    if ($usuarioDoProfessor->getId() != $usuarioLogado->getId()) {
        $_SESSION['avisoLinkAula'] = "Usuario não tem permissão necessária";
        header('Location: ../views/agendaProfessor.php');
        exit;
    }

    $aDao->insertLinkAula($aula->getId(), $linkAula);
    $_SESSION['avisoLinkAula'] = "Link inserido com sucesso!";

} else {
    $_SESSION['avisoLinkAula'] = "Verifique o link e tente novamente.";
    header('Location: ../views/agendaProfessor.php');
    exit;
}


header('Location: ../views/agendaProfessor.php');
exit;



function validarLinkAula($link)
{
    if (!filter_var($link, FILTER_VALIDATE_URL)) {
        return false;
    }

    $validDomains = ['zoom.us', 'meet.google.com'];
    $parseUrl = parse_url($link);
    if (!isset($parseUrl['host'])) {
        return false;
    }
    $host = $parseUrl['host'];

    if (!in_array($host, $validDomains)) {
        return false;
    }

    $headers = @get_headers($link);
    if (!$headers) {
        return false;
    }

    // Extrai o código HTTP da primeira linha dos cabeçalhos
    if (preg_match('/HTTP\/\S+\s(\d{3})/', $headers[0], $matches)) {
        $code = (int) $matches[1];
        // Aceita códigos de status entre 200 e 399 (incluindo redirecionamentos)
        if ($code < 200 || $code >= 400) {
            return false;
        }
    } else {
        return false;
    }

    return true;
}

