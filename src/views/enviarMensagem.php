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
    <link rel="stylesheet" href="../../public/css/enviarMensagem.css">
    <title>Document</title>
</head>

<body>

    <?php
    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/ProfessorDaoMysql.php");
    require_once("../dao/UsuarioDaoMysql.php");
    require_once("../dao/AreaDao.php");
    require_once("../models/user/User.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./login.php");
        exit;
    }

    $uDao = new UsuarioDaoMySql($pdo);

    $destinatarioId = filter_input(INPUT_GET, "idDestinatario");
    $destinatario;

    if ($destinatarioId) {
        $destinatario = $uDao->findById($destinatarioId);
    } else {
        $_SESSION['avisoMensagem'] = 'Id de destinatário inválido';
        header('Location: ../views/telaLogin.php');
        exit;
    }

    if ($destinatario->getId() == $userInfo->getId()) {
        $_SESSION['avisoMensagem'] = 'Você não pode enviar mensagem pra você mesmo';
        header('Location: ../views/telaLogin.php');
        exit;
    }

    ?>

    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">
                <a href="mensagem.php">
                    <div class="perfil-button notif"><img src="../../public/images/sino-icon.png" alt=""></div>
                </a>
                <a class="perfil-button prof" href="./editarPerfilProf.php"><img
                        src="../../public/images/school-icon.png" alt="">Perfil do professor
                </a>
                <a href="editarPerfilAluno.php">
                    <div class="perfil-button">Perfil</div>
                </a>
                <a class="perfil-button notif" href="../service/logout.php"><img
                        src="../../public/images/login-icon.png" alt=""></a>
            </div>
        </div>

    </header>

    <main>

        <div class="container">
            <form method="POST" action="../service/enviarMensagem.php">
                <input type="hidden" name="idDestinatario" value="<?= $destinatario->getId() ?>">

                <label class="campo">
                    <h2>Assunto da mensagem:</h2>
                    <input type="text" name="titulo" placeholder="Título..." required>
                </label>

                <label class="campo">
                    <h2>Destinatário:</h2>
                    <input type="text" placeholder="Nome..." value="<?= $destinatario->getNome() ?>" disabled required>
                </label>

                <label class="campo">
                    <h2>Corpo da mensagem:</h2>
                    <textarea rows="15" name="mensagem" required></textarea>
                </label>

                <div class="campo">
                    <input type="submit" value="Enviar" class="btn-enviar">
                </div>

            </form>
        </div>

        <div class="modal-overlay" id="modalConfirmed">
            <div class="modal" id="modalCn">

                <div class="mod-header">
                    <button class="modal-close" id="closeModalCn">✕</button>
                </div>
                <div class="mod-body">
                    <h3>Mensagem enviada!</h3>
                    <img src="../../public/images/confirmed-icon.png" alt="">
                </div>

            </div>
        </div>
    </main>

    <script src="../../public/js/enviarMensagem.js"></script>


    <?php

    if (!empty($_SESSION['avisoEnviarMensagem']) && $_SESSION['avisoEnviarMensagem']) {
        echo "<script>alert('" . $_SESSION['avisoEnviarMensagem'] . "')</script>";
        $_SESSION['avisoEnviarMensagem'] = '';
    }

    ?>
</body>



</html>