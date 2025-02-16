<?php


require_once __DIR__ . '/../models/user/User.php';
require_once __DIR__ . '/../models/professor/Professor.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';
require '../dao/ProfessorDaoMysql.php';

$uDao = new UsuarioDaoMySql($pdo);
$pDao = new ProfesorDaoMySql($pdo);

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$telefone = filter_input(INPUT_POST, 'telefone');
$foto = $_FILES['file'];




if ($nome && $email && $telefone) {
    $caminhoArquivo;
    $usuario = $uDao->findByToken($_SESSION['token']);
    if (!$usuario) {
        header('Location: ./logout.php');
        exit;
    }

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $arquivo = explode('.', $foto['name']);
        if ($arquivo[sizeof($arquivo) - 1] == 'png') {
            if (move_uploaded_file($foto['tmp_name'], '../uploads/fotoPerfil' . $usuario->getId() . '.png')) {
                $caminhoArquivo = '../uploads/fotoPerfil' . $usuario->getId() . '.png';
                $usuario->setLinkFoto($caminhoArquivo);
                $uDao->update($usuario);
            }
        } else if ($arquivo[sizeof($arquivo) - 1] == 'jpg') {
            if (move_uploaded_file($foto['tmp_name'], '../uploads/fotoPerfil' . $usuario->getId() . '.jpg')) {
                $caminhoArquivo = '../uploads/fotoPerfil' . $usuario->getId() . '.jpg';
                $usuario->setLinkFoto($caminhoArquivo);
                $uDao->update($usuario);
            }
        } else if ($arquivo[sizeof($arquivo) - 1] == 'jpeg') {
            if (move_uploaded_file($foto['tmp_name'], '../uploads/fotoPerfil' . $usuario->getId() . '.jpeg')) {
                $caminhoArquivo = '../uploads/fotoPerfil' . $usuario->getId() . '.jpeg';
                $usuario->setLinkFoto($caminhoArquivo);
                $uDao->update($usuario);
            }
        } else {
            $_SESSION['aviso'] = "O arquivo precisa ser do tipo JPG ou PNG.";
            header('Location: ../views/novoPerfilProf.php');
            exit;
        }
    }

    $usuario->setNome($nome);
    $usuario->setTelefone(limparTelefone($telefone));
    $uDao->update($usuario);

    if (!$uDao->findByEmail($email)) {
        $usuario->setEmail($email);

        $uDao->update($usuario);
    } else {
        if ($email != $usuario->getEmail()) {
            $_SESSION["aviso"] = "Email já está em uso.";
            header('Location: ../views/editarPerfilAluno.php');
            exit;
        }
    }


    $_SESSION["aviso"] = "Informação alterada com sucesso!";
} else {

    $_SESSION["aviso"] = "Preencha todos os campos";
}

function limparTelefone($telefone)
{
    return preg_replace('/\D/', '', $telefone); // Remove tudo que não for número
}



header('Location: ../views/editarPerfilAluno.php');
exit;
