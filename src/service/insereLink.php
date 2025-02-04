<?php

require '../models/user/User.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';

$uDao = new UsuarioDaoMySql($pdo);

$aulaId = filter_input((INPUT_POST, 'aulaid'));
$linkAula = filter_input((INPUT_POST, 'linkAula'));


if($aulaId && $linkAula) {
 
    
} else {
}



















function validarLinkAula($link)
{
    // Verifica se o link é uma URL válida
    if (!filter_var($link, FILTER_VALIDATE_URL)) {
        return false;
    }

    // Verifica se o link é de Zoom ou Google Meet
    $validDomains = ['zoom.us', 'meet.google.com'];
    $parseUrl = parse_url($link);

    if (!in_array($parseUrl['host'], $validDomains)) {
        return false;
    }

    // Verifica se a URL está acessível
    $headers = @get_headers($link);
    if (!$headers || strpos($headers[0], '200') === false) {
        return false;
    }

    return true;
}