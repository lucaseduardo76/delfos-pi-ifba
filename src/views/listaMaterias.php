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
        header("Location: ./login.php");
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
            <div class="categorias">
                <button class="category">Matemática &#128208;</button>
                <button class="category">Português &#128218;</button>
                <button class="category">Inglês &#127760;</button>
                <button class="category">Música &#127925;</button>
                <button class="category">Programação &#128187;</button>
                <button class="category">Reforço Escolar &#127891;</button>
                <button class="category">ENEM &#127891;</button>
                <button class="category">Figma &#127929;</button>
                <button class="category">Photoshop &#128196;</button>
                <button class="category">Illustrator &#128208;</button>
                <button class="category">Art digital &#128187;</button>
                <button class="category">Libras &#128070;</button>
            </div>
        </div>

    </main>

</body>

</html>