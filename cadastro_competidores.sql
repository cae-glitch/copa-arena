CREATE TABLE usuários (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nickname VARCHAR(50) NOT NULL,
    nome_completo VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone_whatsApp VARCHAR(20) NOT NULL,
    user_discord VARCHAR(50) NOT NULL,
    cidade VARCHAR(50) NOT NULL,
    plataforma VARCHAR(20) NOT NULL,
    jogo VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;