CREATE DATABASE cash_db;

USE cash_db;

CREATE TABLE conversation_flow (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chatId VARCHAR(255) NOT NULL,
    name VARCHAR(255) DEFAULT '',
    country VARCHAR(100) DEFAULT '',
    amount DECIMAL(10, 2) DEFAULT 0.0,
    phoneNumber VARCHAR(20) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);