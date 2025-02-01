<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/perfilProf.css">
    <title>Document</title>
</head>

<body>
    <?php

    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/AreaDao.php");
    require_once("../dao/UsuarioDaoMysql.php");
    require_once("../dao/ProfessorDaoMysql.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./login.php");
        exit;
    }

    $pDao = new ProfesorDaoMySql($pdo);
    $uDao = new UsuarioDaoMySql($pdo);
    $aDao = new AreaDao($pdo);

    $usuario;
    $professor;
    if (!empty($_SESSION['idProfessor']) && $_SESSION['idProfessor']) {
        $usuario = $uDao->findById($_SESSION['idProfessor']);

        if($usuario->getId() == $userInfo->getId()){
            header('Location: ./editarPerfilProf.php');
            exit;
        }

        if ($usuario) {
            $professor = $pDao->findByUserId($usuario->getId());
        }else {
            header('Location: ./main.php');
            exit;
        }
    } else {
        header('Location: ./main.php');
        exit;
    }


    ?>


    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">
                <div class="perfil-button prof"><img src="../../public/images/school-icon.png" alt="">Perfil de
                    professor</div>
                <div class="perfil-button"><img src="../../public/images/login-icon.png" alt="">Perfil</div>
            </div>


        </div>

    </header>

    <main>

        <div class="container">
            <div class="left-panel">
                <div class="profile-card">

                    <div class="profile-sup">
                        <div class="profile-img">
                            <img src="<?= $usuario->getLinkFoto() ?>" alt="">
                        </div>

                        <div class="profile-info">
                            <h2><?= $usuario->getNome() ?></h2>
                            <h3><?= $aDao->findById($professor->getArea())->getArea() ?></h3>

                            <div class="stats">

                                <div class="stat">
                                    <p>Aulas Ministradas</p>
                                    <h3><?= $professor->getQuantidadeAulasAplicadas() ?></h3>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="sobre">
                        <h3>Sobre o professor</h3>
                        <p>
                            <?= $professor->getDescricao() ?>
                        </p>
                    </div>

                </div>
            </div>

            <div class="right-panel">
                <div class="botoes">
                    <button class="main-btn" id="linkBtn" disabled>Começar aula</button>
                    <button class="secondary-btn" id="agendarBtn">Agendar aula</button>
                    <button class="secondary-btn">Enviar mensagem</button>
                </div>
            </div>

        </div>

        <div class="modal-overlay" id="modalConfirmed">
            <div class="modal" id="modalCn">

                <div class="mod-header">
                    <button class="modal-close" id="closeModalCn">✕</button>
                </div>
                <div class="mod-body">
                    <h3>Aula agendada com sucesso!</h3>
                    <img src="../../public/images/confirmed-icon.png" alt="">
                </div>

            </div>
        </div>

        <div class="modal-overlay" id="modalLink">
            <div class="modal" id="modalLi">

                <div class="mod-header">
                    <button class="modal-close" id="closeModalLi">✕</button>
                </div>
                <div class="mod-body">
                    <h3>Direcionar para video chamada</h3>
                    <a href="">Link</a>
                </div>

            </div>
        </div>

        <div class="modal-overlay" id="modalRegister">
            <div class="modal" id="modal">
                <div class="mod-header">
                    <button class="modal-close" id="closeModalRg">✕</button>
                </div>
                <div class="mod-body">
                    <form action="../service/solicitaAgendamento.php" method="POST">
                        <input type="hidden" name="idProf" id="id" value="<?= $professor->getId() ?>">

                        <label class="mod-inputs">
                            <p>Qual sua dificuldade?</p>
                            <textarea name="dificuldade" rows="8" id="area-text"></textarea>
                        </label>

                        <p>Reservar horário das
                            <input id="hora" name="hora" type="time" step="3600">
                            no dia
                            <input id="data" name="data" type="date">
                        </p>
                        <p>Agendar horário ?</p>

                        <input type="submit" value="Confirmar">
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="../../public/js/perfilProf.js"></script>
</body>

<?php


if (!empty($_SESSION['verifyAgendamento']) && $_SESSION['verifyAgendamento'] == true) {
    echo '<script> document.getElementById("modalConfirmed").style.display = "flex"; </script>';
    echo '<script> document.getElementById("modalCn").style.opacity = 1; </script>';
    $_SESSION['verifyAgendamento'] = false;
}

if (!empty($_SESSION['avisoAgendamento']) && $_SESSION['avisoAgendamento']) {
    echo "<script>alert('" . $_SESSION['avisoAgendamento'] . "')</script>";
    $_SESSION['avisoAgendamento'] = '';
}

?>

</html>