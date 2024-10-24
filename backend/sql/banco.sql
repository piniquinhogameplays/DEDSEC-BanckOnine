-- Criar banco de dados
CREATE DATABASE user_system;
USE user_system;

-- Tabela de Usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL, -- Senha armazenada com hash para segurança
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Carteiras de Bitcoin (Wallets)
CREATE TABLE carteiras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    endereco_carteira VARCHAR(255) NOT NULL UNIQUE, -- Endereço público da carteira
    chave_privada VARCHAR(255) NOT NULL, -- Idealmente armazenada de forma criptografada
    chave_publica VARCHAR(255) NOT NULL,
    saldo DECIMAL(16,8) DEFAULT 0.0, -- Saldo de Bitcoin da carteira (até 8 casas decimais)
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE -- Se o usuário for deletado, a carteira também será
);

-- Tabela de Transações de Bitcoin
CREATE TABLE transacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    carteira_envio_id INT NOT NULL, -- Carteira que envia Bitcoin
    endereco_recebimento VARCHAR(255) NOT NULL, -- Endereço que recebe Bitcoin
    valor DECIMAL(16,8) NOT NULL, -- Quantidade de Bitcoin transferida
    taxa_transacao DECIMAL(16,8) DEFAULT 0.0001, -- Taxa de rede
    data_transacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Data da transação
    status ENUM('pendente', 'confirmada', 'falhada') DEFAULT 'pendente', -- Status da transação
    hash_transacao VARCHAR(255) UNIQUE, -- Hash da transação no blockchain
    FOREIGN KEY (carteira_envio_id) REFERENCES carteiras(id) ON DELETE CASCADE -- Vinculado à carteira de envio
);
