<?php

// Inicia a sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
include_once("conexao.php");

// Sanitiza e obtém os dados do formulário
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING); 
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING); 
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);

// Cria a consulta SQL para inserir um novo usuário no banco de dados
$create_user= "UPDATE funcionarios SET nome='$nome', telefone='$telefone', email='$email', cpf='$cpf', modified=NOW() WHERE id='$id'"; 
$created_user= mysqli_query($conn, $create_user);

// Verifica se o usuário foi inserido com sucesso
if (mysqli_affected_rows($conn)) {
    // Define uma mensagem de sucesso na sessão
    $_SESSION['msg'] = "<p style='color: green;margin-bottom: 30px;font-size: 28px;'>Usuário cadastrado com sucesso!</p>";
    // Redireciona para a página de cadastro
    header("Location: listar.php");
} else {
    // Define uma mensagem de erro na sessão
    $_SESSION['msg'] = "<p style='color: red;'>Usuário não cadastrado!</p>";
    // Redireciona para a página de cadastro
    header("Location: editar.php?id=$id");
}
?>