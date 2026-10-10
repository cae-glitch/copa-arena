<?php

$servidor = "localhost";       // Onde o banco está rodando (local)
$usuario = "root";             // Usuário padrão do XAMPP
$senha = "";                   // Senha vazia (padrão do XAMPP)
$banco = "cadastro_competidores"; // Nome do banco que criamos

// Cria a conexão usando a classe mysqli
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica se houve erro na conexão. Se sim, para tudo e mostra o erro.
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Define o charset para utf8mb4 para evitar problemas com acentos e emojis
$conexao->set_charset("utf8mb4");

?>