<?php
require '../config/config.php';


$id = filter_input(INPUT_GET, 'idProf');

if ($id) {
    $_SESSION['idProfessor'] = $id;
}

header('Location: ../views/perfilProf.php');
exit;
