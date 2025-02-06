# Projeto Integrador - Conexão Aluno & Professor

Este projeto foi desenvolvido como parte do **Projeto Integrador** no curso de **Análise e Desenvolvimento de Sistemas** do **Instituto Federal da Bahia - Campus Eunápolis**.

## 📌 Sobre o Projeto

O sistema tem como objetivo conectar **professores** (que têm algo a ensinar) e **alunos** (que desejam aprender algo). A plataforma permite que os alunos encontrem professores que atendam às suas necessidades de aprendizado, promovendo uma conexão direta entre ensino e aprendizado.

## 🏗️ Estrutura do Sistema

O sistema possui as seguintes entidades principais:

- **Usuário**: Classe base para todos os usuários do sistema.
- **Professor**: Todo professor também é um usuário e pode oferecer aulas.
- **Aluno**: Todo aluno também é um usuário e pode buscar professores para aprender.

Além dessas, existem outras classes auxiliares que complementam o funcionamento do sistema.

## ✉️ Funcionalidades Principais

- **Busca de Professores**: Alunos podem procurar professores conforme suas necessidades.
- **Sistema de Mensagens**: Alunos podem enviar mensagens no formato de e-mail para os professores.
- **Sistema de Avaliação (Rating)**: Após cada aula, o aluno pode avaliar o professor com uma nota de 1 a 5 estrelas, influenciando seu rating geral. Esse rating é visível para outros usuários, ajudando na escolha do professor ideal.

## 🚀 Tecnologias Utilizadas

O projeto foi desenvolvido utilizando as seguintes tecnologias:

- **Back-end**: PHP
- **Banco de Dados**: MySQL
- **Front-end**: HTML, CSS, JavaScript

## 📌 Como Executar o Projeto

1. Clone o repositório:
   ```bash
   git clone https://github.com/lucaseduardo76/delfos-pi-ifba.git
   ```
2. Configure o banco de dados no arquivo de conexão do PHP.
3. Inicie um servidor local, como Apache (XAMPP, WAMP ou outro).
4. Acesse o sistema via navegador.

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.
