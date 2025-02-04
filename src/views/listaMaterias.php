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
    require_once("../dao/UsuarioDaoMysql.php");
    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./telaLogin.php");
        exit;
    }


    $aDao = new AreaDao($pdo);
    $pDao = new ProfesorDaoMySql($pdo);
    $uDao = new UsuarioDaoMySql($pdo);
    $areas = $aDao->findAll();

    // Exemplo de lista de professores
    $listaProfessores = [];
    foreach ($pDao->findAll() as $p) {
        $listaProfessores[] = $uDao->findById($p->getUserId())->getNome();
    }


    ?>


    <script>
        // Passando a lista de professores para o JavaScript
        var listaProfessores = <?php echo json_encode($listaProfessores); ?>;
    </script>

    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">

                <div class="perfil-button notifAgenda" id="agendaButton"><img src="../../public/images/agenda-icon.png"></div>
                <nav id="dropdownMenu" class="hidden">
                    <ul>
                        <li><a href="agendaProfessor.php">Agenda de Professor</a></li>
                        <li><a href="agendaAluno.php">Agenda de Aluno</a></li>
                    </ul>
                </nav>

                <a href="mensagem.php" class="perfil-button notif"><img src="../../public/images/email.svg" alt=""></a>
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
        <div class="input-busca">
            <form action="./pesquisaProf.php">
                <input type="text" name="nome" id="busca" onkeyup="filtrarProfessores()"
                    placeholder="Pesquise o professor pelo nome...">
                <div id="sugestoes" class="sugestoes"></div> <!-- Container para as sugestões -->

            </form>
        </div>
        <div class="container">
            <div class="categorias">
                <?php
                foreach ($areas as $area):
                ?>
                    <a class="category"
                        href="./professoresPorMateria.php?area=<?= $area->getId() ?>"><?= $area->getArea() ?></a>
                <?php endforeach; ?>
            </div>
        </div>

    </main>

</body>

<script>
    function filtrarProfessores() {
        var input = document.getElementById('busca').value.toLowerCase();
        var sugestoesDiv = document.getElementById('sugestoes');

        // Limpa as sugestões anteriores
        sugestoesDiv.innerHTML = '';

        // Se o campo de busca não estiver vazio
        if (input.length > 0) {
            // Filtra os professores com base no texto digitado
            var resultados = listaProfessores.filter(function(professor) {
                return professor.toLowerCase().includes(input);
            });

            // Exibe as sugestões
            resultados.forEach(function(nome) {
                var div = document.createElement('div');
                div.classList.add('sugestao');
                div.innerText = nome;
                div.onclick = function() {
                    document.getElementById('busca').value = nome; // Preenche o campo de busca com o nome selecionado
                    sugestoesDiv.innerHTML = ''; // Limpa as sugestões após a seleção
                };
                sugestoesDiv.appendChild(div);
            });
        }
    }
</script>
</script>

</html>