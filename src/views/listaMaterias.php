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
    <link rel="stylesheet" href="../../public/css/listaMaterias.css">
    <title>Document</title>
</head>

<body>

    <?php

    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/AreaDao.php");
    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./telaLogin.php");
        exit;
    }


    $aDao = new AreaDao($pdo);
    $areas = $aDao->findAll()
        ?>

    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">
                
            <a href="mensagem.php" class="perfil-button notif"><img src="../../public/images/email.svg" alt=""></a>
                <a class="perfil-button prof" href="./editarPerfilProf.php"><img
                            src="../../public/images/school-icon.png" alt="">Perfil do professor
                </a>
                <a href="editarPerfilAluno.php">
                    <div class="perfil-button">Perfil</div>
                </a>
                <a class="perfil-button notif" href="../service/logout.php"><img src="../../public/images/login-icon.png" alt=""></a>
            </div>

        </div>

    </header>

    <main>

        <div class="container">
            <div class="categorias">
                <?php
                foreach ($areas as $area):
                    ?>
                    <a class="category" href="./professoresPorMateria.php?area=<?=$area->getId()?>" ><?= $area->getArea()?></a>
                <?php endforeach; ?>
            </div>
        </div>

    </main>

</body>

</html>