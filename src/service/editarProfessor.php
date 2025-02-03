<?php


require_once __DIR__ . '/../models/user/User.php';
require_once __DIR__ . '/../models/professor/Professor.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';
require '../dao/ProfessorDaoMysql.php';

$uDao = new UsuarioDaoMySql($pdo);
$pDao = new ProfesorDaoMySql($pdo);

$area = filter_input(INPUT_POST, 'materia');
$preco = filter_input(INPUT_POST, 'preco');
$sobre = ucwords(strtolower(filter_input(INPUT_POST, 'sobre')));
$foto = $_FILES['file'];




if ($area && $preco && $sobre) {
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
        }else {
            $_SESSION['aviso'] = "O arquivo precisa ser do tipo JPG ou PNG.";
            header('Location: ../views/novoPerfilProf.php');
            exit;
        }
    }

    $professor = $pDao->findByUserId($usuario->getId());

    if (!$professor) {
        $_SESSION = "Erro interno, contate o suporte";
        header('Location: ../views/editarPerfilProf.php');
        exit;
    }

    $professor->setArea($area);
    $professor->setPrecoAula(convertToFloat($preco));
    $professor->setQuantidadeAulasAplicadas(0);
    $professor->setDescricao($sobre);
    $professor->setUserId($usuario->getId());

    $pDao->update($professor);

} else {

    $_SESSION["aviso"] = "Preencha todos os campos";

}


function convertToFloat($valor)
{
    $precoLimpo = str_replace(['R$', ' ', '.'], '', $valor);
    $precoLimpo = str_replace(',', '.', $precoLimpo);


    $precoNumerico = floatval($precoLimpo);
    return $precoNumerico;
}

header('Location: ../views/editarPerfilProf.php');
exit;

