<?php

require_once "conexao.php";

// Inicializa as variáveis com valores vazios para o formulário não dar erro na primeira visita
$nickname = "";
$nome_completo = "";
$email = "";
$telefone_whatsApp = "";
$user_discord = "";
$cidade = "";
$plataforma = "";
$jogo = "";
$mensagem = "";

// Verifica se o formulário foi enviado (método POST)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebe os dados digitados pelo usuário
    $nickname = $_POST["nickname"];
    $nome_completo = $_POST["nome_completo"];
    $email = $_POST["email"];
    $telefone_whatsApp = $_POST["telefone_whatsApp"];
    $user_discord = $_POST["user_discord"];
    $cidade = $_POST["cidade"];
    $plataforma = $_POST["plataforma"];
    $jogo = $_POST["jogo"];
    
    // Validação simples: se algum campo estiver vazio, mostra mensagem de erro
    if ($nickname === "" || $nome_completo === "" || $email === "" || $telefone_whatsApp === "" || $user_discord === "" || $cidade === "" || $plataforma === "" || $jogo === "") {
        $mensagem = "Preencha todos os campos.";
    } else {
        // Prepara o comando SQL para inserir os dados de forma segura (evita SQL Injection)
        $sql = "INSERT INTO usuários (nickname, nome_completo, email, telefone_whatsApp, user_discord, cidade, plataforma, jogo) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conexao->prepare($sql);
        
        // O "ssssssss" indica que os 8 parâmetros são strings (textos)
        $stmt->bind_param("ssssssss", $nickname, $nome_completo, $email, $telefone_whatsApp, $user_discord, $cidade, $plataforma, $jogo);
        
        // Tenta executar o comando no banco
        if ($stmt->execute()) {
            $mensagem = "Cadastro realizado com sucesso!";
            
            // Limpa os campos do formulário após o sucesso
            $nickname = "";
            $nome_completo = "";
            $email = "";
            $telefone_whatsApp = "";
            $user_discord = "";
            $cidade = "";
            $plataforma = "";
            $jogo = "";
        } else {
            // Se der erro, mostra a mensagem de erro do MySQL
            $mensagem = "Erro ao cadastrar: " . $stmt->error;
        }
        
        // Fecha o statement para liberar recursos
        $stmt->close();
    }
}
// Fecha a conexão com o banco
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Copa Arena</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Rajdhani:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background-image: 
                linear-gradient(rgba(0, 229, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 229, 255, 0.03) 1px, transparent 1px);
            background-size: 20px 20px;    
            background-color: #0D1117; 
            color: #E6EDF3; 
            font-family: 'Rajdhani', sans-serif; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: #161B22; 
            padding: 40px;
            border-radius: 12px;
            border: 1px solid #30363D; 
            width: 100%;
            max-width: 600px;
            box-shadow: 0 0 20px rgba(0, 229, 255, 0.1); 
        }

        h1 {
            font-family: 'Orbitron', sans-serif; 
            text-align: center;
            margin-bottom: 30px;
            color: #00E5FF; 
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .mensagem {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 6px;
            background-color: rgba(0, 229, 255, 0.1);
            color: #00E5FF;
            border: 1px solid #00E5FF;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            background-color: #0D1117;
            border: 1px solid #30363D;
            border-radius: 8px;
            color: #E6EDF3;
            font-size: 16px;
            font-family: 'Rajdhani', sans-serif;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus, select:focus {
            border-color: #00E5FF;
            box-shadow: 0 0 8px rgba(0, 229, 255, 0.3);
        }

        ::placeholder { color: #8B949E; }

        button {
            width: 100%;
            padding: 14px;
            background-color: #00E5FF;
            color: #0D1117;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-family: 'Orbitron', sans-serif;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #00B8D4; 
            transform: scale(1.02);
        }

        .link-navegacao {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #8B949E;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .link-navegacao:hover {
            color:#00E5FF;
            text-decoration: underline;
        }

        select {
            cursor: pointer;
            appearance: none; 
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2300E5FF' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 15px;
        }

        select option {
            background-color: #161B22;
            color: #E6EDF3;
            padding: 10px;
        }

        select:invalid {
            color:#8B949E;
        }

        button:hover {
            background-color: #00B8D4; 
            transform: scale(1.02);
            box-shadow: 0 0 15px rgba(0, 229, 255, 0.5);
        }

        button:focus {
            outline: 2px solid #00E5FF;
            outline-offset: 2px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo a Copa Arena!!!</h1>

        <!-- Mostra a mensagem de sucesso ou erro, se houver -->
        <?php if ($mensagem !== "") { ?>
            <p class="mensagem"><?php echo $mensagem; ?></p>
        <?php } ?>
    
        <!-- Formulário de cadastro. O action aponta para o próprio index.php -->
        <form action="index.php" method="POST">
            <input type="text" name="nickname" placeholder="Digite seu Nickname" value="<?php echo $nickname; ?>">
            <input type="text" name="nome_completo" placeholder="Digite seu Nome Completo" value="<?php echo $nome_completo; ?>">
            <input type="email" name="email" placeholder="Digite seu E-mail" value="<?php echo $email; ?>">
            <input type="text" name="telefone_whatsApp" placeholder="Digite seu WhatsApp" value="<?php echo $telefone_whatsApp; ?>">
            <input type="text" name="user_discord" placeholder="Digite seu username do discord" value="<?php echo $user_discord; ?>">
            <input type="text" name="cidade" placeholder="Qual é a sua cidade" value="<?php echo $cidade; ?>">
        
            <!-- Select para escolher a plataforma -->
            <select name="plataforma">
                <option value="">Qual é a sua plataforma</option>
                <option value="PC">PC</option>
                <option value="console">Console</option>
                <option value="mobile">Mobile</option>
            </select>

            <!-- Select para escolher o jogo -->
            <select name="jogo">
                <option value="">Escolha seu jogo</option>
                <option value="valorant">Valorant</option>
                <option value="League of Legends">League of Legends</option>
                <option value="EA FC">EA FC</option>
            </select>
            <button type="submit">Cadastrar</button>
        
        </form>
        <a href="lista_competidores.php" class="link-navegacao">Veja a lista de competidores &rarr;</a>
    </div>      
</body>
</html>