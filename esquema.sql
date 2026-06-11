-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS proyectoShowcooking;

-- Seleccionar la base de datos para trabajar en ella
USE proyectoShowcooking;

-- Eliminamos las tablas si existen para dejarlas limpias
DROP TABLE IF EXISTS Usuario;
DROP TABLE IF EXISTS Showcooking;

-- Crear la tabla usuario
CREATE TABLE Usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL,
    email VARCHAR(150) NOT NULL
);

-- Crear la tabla Showcooking
CREATE TABLE IF NOT EXISTS Showcooking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    huellaYoutube VARCHAR(11) NOT NULL UNIQUE,
    fechaCreacion DATETIME NOT NULL,
    publicado BOOLEAN DEFAULT FALSE
);