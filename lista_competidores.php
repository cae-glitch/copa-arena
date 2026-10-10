<?php

require_once "conexao.php";

// Comando SQL para buscar todos os registros da tabela 'usuários'
$sql = "SELECT * FROM usuários"; 

// Executa a consulta
$resultado = $conexao->query($sql);

// Verifica se a consulta deu certo. Se não, mostra o erro.
if (!$resultado) {
    die("Erro na consulta: " . $conexao->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Cadastros</title>

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
            padding: 40px 20px;
        }

        h1 {
            font-family: 'Orbitron', sans-serif;
            text-align: center;
            margin-bottom: 30px;
            color: #00E5FF;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .tabela-container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #161B22;
            border-radius: 12px;
            border: 1px solid #30363D;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 229, 255, 0.1);
            overflow-x: auto; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #0D1117;
            color: #00E5FF;
            padding: 15px;
            text-align: left;
            font-size: 14px;
            text-transform: uppercase;
            border-bottom: 2px solid #00E5FF;
            font-family: 'Orbitron', sans-serif;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #30363D;
            font-size: 16px;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.02);
        }

        tr:hover {
            background-color: rgba(0, 229, 255, 0.05);
            transition: background-color 0.2s;
        }

        tr:first-child td {
            color: #00E5FF;
            font-weight: bold;
        }
        
        .link-voltar {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            color: #00E5FF;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            transition: color 0.3s, transform 0.2s;
        }

        .link-voltar:hover {
            color: #00b8d4;
            text-decoration: underline;
        }

        .tabela-container {
            overflow-x: auto;
            scrollbar-width: thin; 
            scrollbar-color: #00E5FF #161B22; 
        }

        .tabela-container::-webkit-scrollbar {
            height: 8px;
        }

        .tabela-container::-webkit-scrollbar-track {
            background: #161B22;
            border-radius: 10px;
        }
        
        .tabela-container::-webkit-scrollbar-thumb {
            background: #00E5FF;
            border-radius: 10px;
        }

    </style>
</head>
<body>
    <h1>Usuários Cadastrados</h1>

    <a href="index.php" class="link-voltar">&larr; Voltar para o Cadastro</a>
    
    <div class="tabela-container">
    <table>
        <!-- Cabeçalho da tabela -->
        <tr>
            <th>ID</th>
            <th>Nickname</th>
            <th>Nome Completo</th>
            <th>Email</th>
            <th>WhatsApp</th>
            <th>Discord</th>
            <th>Cidade</th>
            <th>Plataforma</th>
            <th>Jogo</th>
        </tr>
        
        <!-- Loop que percorre cada linha do resultado e cria uma linha na tabela HTML -->
        <?php while($linha = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $linha['id']; ?></td>
            <td><?php echo $linha['nickname']; ?></td>
            <td><?php echo $linha['nome_completo']; ?></td>
            <td><?php echo $linha['email']; ?></td>
            <td><?php echo $linha['telefone_whatsApp']; ?></td>
            <td><?php echo $linha['user_discord']; ?></td>
            <td><?php echo $linha['cidade']; ?></td>
            <td><?php echo $linha['plataforma']; ?></td>
            <td><?php echo $linha['jogo']; ?></td>
        </tr>
        <?php } ?>
    </table>
    </div>
</body>
</html>