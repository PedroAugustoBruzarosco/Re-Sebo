<?php
    session_start();
    include 'conexao.php';

    $email = $_POST['email'];
    $usuario = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $verificaEmail = pg_query_params($conn, "SELECT 1 FROM usuarios WHERE email = $1", array($email));
    $verificaUsuario = pg_query_params($conn, "SELECT 1 FROM usuarios WHERE nome = $1", array($usuario));
    $verificaCPF = pg_query_params($conn, "SELECT 1 FROM usuarios WHERE cpf = $1", array($cpf));

        if (pg_num_rows($verificaEmail) > 0) {
            $_SESSION['erro'] = "E-mail já cadastrado";
            header("location: cadastro.php");
            exit;
        }
        if (pg_num_rows($verificaUsuario) > 0) {
            $_SESSION['erro'] = "Usuário já cadastrado";
            header("location: cadastro.php");
            exit;
        }
        if (pg_num_rows($verificaCPF) > 0) {
            $_SESSION['erro'] = "CPF já cadastrado";
            header("location: cadastro.php");
            exit;
        }

        $sql = "INSERT INTO usuarios (email, nome, senha, cpf) VALUES ($1, $2, $3, $4)";
        $resultado = pg_query_params($conn, $sql, array($email, $usuario, $senha, $cpf));

        if(!$resultado) {
            $_SESSION['erro'] = "Erro ao cadastrar o usuário";
            header("location: cadastro.php");
            exit;
        }
        
        header("location: login.php");
        exit;
?>