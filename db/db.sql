-- Create database if not exists
CREATE DATABASE IF NOT EXISTS portfolio_db
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_general_ci;

-- Use the database
USE portfolio_db;

-- Drop users table if it exists
DROP TABLE IF EXISTS users;

-- Create users table
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(100) NOT NULL,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  dob DATE,
  gender ENUM('male', 'female') DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert a test user (Note: Use hashed password in real use)
INSERT INTO users (fullname, username, email, password, dob, gender)
VALUES (
  'Murtaza Rasheed',
  'murtaza',
  'mmrmuru3@gmail.com',
  'hashed_password_here',
  '2000-01-01',
  'male'
);

-- Drop contact_messages table if it exists
DROP TABLE IF EXISTS contact_messages;

-- Create contact_messages table
CREATE TABLE contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  message TEXT NOT NULL,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
