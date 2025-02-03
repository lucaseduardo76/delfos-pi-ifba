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
    <link rel="stylesheet" href="../../public/css/editarPerfilAluno.css">
    <title>Document</title>
</head>

<body>
    <?php

    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/ProfessorDaoMysql.php");
    require_once("../dao/UsuarioDaoMysql.php");
    require_once("../models/user/User.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./login.php");
        exit;
    }

    $uDao = new UsuarioDaoMySql($pdo);
    ?>

    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">`

                <a href="mensagem.php" class="perfil-button notif"><img src="../../public/images/email.svg" alt=""></a>
                <a href="editarPerfilProf.php" class="perfil-button prof"><img src="../../public/images/school-icon.png"
                        alt="">Perfil de professor</a>
                <a href="editarPerfilAluno.php" class="perfil-button">Perfil</a>
                <a class="perfil-button notif" href="../service/logout.php"><img
                        src="../../public/images/login-icon.png" alt=""></a>
            </div>

        </div>

    </header>

    <main>

        <div class="container">

            <div class="left-side">
                <div class="photo-area">
                    <img src="<?= $userInfo->getLinkFoto() ?>" alt="">
                    <h2>Perfil</h2>
                </div>

                <a href="agenda.php" class="button-prt">Minha agenda</a>

            </div>

            <div class="right-side">
                <h2>Últimos professores vistos:</h2>
                <div class="prof-photos">

                    <div class="photo">
                        <img src="../../public/images/inri-cristo.jpg" alt="">
                        <div class="info">
                            <p>Inri Cristo</p>
                            <p>Assunto: Matemática</p>
                        </div>
                    </div>

                    <div class="photo">
                        <img src="../../public/images/inri-cristo.jpg" alt="">
                        <div class="info">
                            <p>Inri Cristo</p>
                            <p>Assunto: Matemática</p>
                        </div>
                    </div>

                </div>

                <form>
                    <label>
                        <h2>Sobre você:</h2>
                        <textarea rows="5" , placeholder="Fale sobre você..."></textarea>
                    </label>
                </form>
            </div>

        </div>

    </main>

</body>

</html>