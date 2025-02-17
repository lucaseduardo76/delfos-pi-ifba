<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/redefinirSenha.css">
    <link rel="stylesheet" href="../../public/css/navAgenda.css">
    <script src="../../public/js/navAgenda.js"></script>
    <title>Document</title>
</head>

<body>
    <?php

    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/AreaDao.php");
    require_once("../dao/ProfessorDaoMysql.php");
    require_once("../dao/ProfessorDaoMysql.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./telaLogin.php");
        exit;
    }

    $pDao = new ProfesorDaoMySql($pdo);
    $uDao = new UsuarioDaoMySql($pdo);

    $isUserProf = $pDao->findByUserId($userInfo->getId())
    ?>

    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">

                <div class="perfil-button notifAgenda" id="agendaButton"><img src="../../public/images/agenda-icon.png">
                </div>
                <nav id="dropdownMenu" class="hidden">
                    <ul>
                        <?php if ($isUserProf): ?>
                            <li><a href="agendaProfessor.php">Agenda de Professor</a></li>
                        <?php endif; ?>
                        <li><a href="agendaAluno.php">Agenda de Aluno</a></li>
                    </ul>
                </nav>

                <a href="mensagem.php" class="perfil-button notif"><img src="../../public/images/email.svg" alt=""></a>
                <?php if (!$isUserProf): ?>
                    <a class="perfil-button prof" href="./novoPerfilProf.php"><img src="../../public/images/school-icon.png"
                            alt="">Seja um professor
                    </a>
                <?php endif; ?>

                <?php if ($isUserProf): ?>
                    <a class="perfil-button prof" href="./editarPerfilProf.php"><img
                            src="../../public/images/school-icon.png" alt="">Perfil do professor
                    </a>
                <?php endif; ?>
                <a href="editarPerfilAluno.php" class="perfil-button">Perfil</a>
                <a class="perfil-button notif" href="../service/logout.php"><img
                        src="../../public/images/login-icon.png" alt=""></a>
            </div>


        </div>

    </header>

    <main>

        <div class="container">
            <form method="post" action="../service/mudarSenha.php">
                <div class="campo">
                    <h2>Redefinir Senha</h2>
                    <input type="password" name="antiga" placeholder="Senha antiga...">
                    <input type="password" name="nova" placeholder="Nova senha...">
                    <input type="submit" value="Trocar senha">
                </div>

            </form>
        </div>

    </main>
    <?php

    if (!empty($_SESSION['aviso']) && $_SESSION['aviso']) {
        echo "<script>alert('" . $_SESSION['aviso'] . "')</script>";
        $_SESSION['aviso'] = '';
    }

    ?>
</body>

</html>