<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/editarPerfilProf.css">
    <title>Document</title>
</head>
<body>

    <header>

        <div class="header">
            <div class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </div>
            <div class="buttons">
                <div class="perfil-button prof"><img src="../../public/images/school-icon.png" alt="">Perfil de professor</div>
                <div class="perfil-button"><img src="../../public/images/login-icon.png" alt="">Perfil</div> 
            </div>
            
        </div>

    </header>

    <main>
        <div class="container">
            <div class="left-side">
                <div class="perfil-foto">
                    <img src="../../public/images/fortune-tiger-logo.png" alt="">
                    <h2>Perfil</h2>
                </div>

                <button class="button-prt">Minha agenda</button>
            </div>

            <div class="right-side">
                <form>

                    <label>
                        <h3>Matérias que você mestra:</h3>
                        <select name="materia" id="materia" required>
                            <option value="" disabled selected>Selecione a sua tag de ensino</option>
                            <option value="matematica">Matemática</option>
                            <option value="portugues">Português</option>
                            <option value="economia">Economia</option>
                        </select>
                    </label>

                    <label>
                        <h3>Valor da aula:</h3>
                        <input type="number" placeholder="Insira o valor por hora" required
                        min="0" step="0.01">
                    </label>

                    <label>
                        <h3>Sobre você:</h3>
                        <textarea rows="5", placeholder="Fale sobre você..."></textarea>
                    </label>

                </form>
            </div>

            
        </div>

        <button class="button-prt">Pronto</button>

    </main>
    
</body>
</html>