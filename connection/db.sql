CREATE DATABASE cash_db;

USE cash_db;



CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chat_id VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chat_id VARCHAR(50) NOT NULL,        -- Foreign key from the users table
    amount FLOAT NOT NULL,               -- Amount of the payment
    phone_number VARCHAR(15) NOT NULL,   -- Phone number linked to the payment
    target_account_number VARCHAR(15) NOT NULL,  -- Account number to send the payment to
    status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',  -- Payment status
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chat_id) REFERENCES users(chat_id)  -- Links payments to usersj
);


CREATE TABLE conversation_flow (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chatId VARCHAR(255) NOT NULL,
    name VARCHAR(255) DEFAULT '',
    country VARCHAR(100) DEFAULT '',
    amount DECIMAL(10, 2) DEFAULT 0.0,
    phoneNumber VARCHAR(20) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
