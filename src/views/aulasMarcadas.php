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
    <link rel="stylesheet" href="../../public/css/aulasMarcadas.css">
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
            <div class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </div>
            <div class="buttons">
                <a href="">
                    <div class="perfil-button notif"><img src="../../public/images/sino-icon.png" alt=""></div>
                </a>
                <a href="">
                    <div class="perfil-button"><img src="../../public/images/login-icon.png" alt="">Perfil</div>
                </a>
            </div>
        </div>

    </header>

    <main>

        <div class="tabela-container">
            <table class="tabela-aulas">
                <caption>Aulas marcadas</caption>
                <thead>
                    <tr>
                        <th>Dia</th>
                        <th>Mês</th>
                        <th>Nome Prof.</th>
                        <th>Horário</th>
                        <th>Semana</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>27</td>
                        <td>Jan</td>
                        <td>Felipe Amorim</td>
                        <td>15:00</td>
                        <td>Seg</td>
                        <td>
                            <div class="acoes">
                                <img src="../../public/images/eye-icon.png" alt="Visualizar" class="icone">
                                <img src="../../public/images/delete-icon.png" alt="Excluir" class="icone">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <span class="icone"></span>
                            <span class="icone"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <span class="icone"></span>
                            <span class="icone"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <span class="icone"></span>
                            <span class="icone"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <span class="icone"></span>
                            <span class="icone"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <span class="icone"></span>
                            <span class="icone"></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </main>


</body>

</html>