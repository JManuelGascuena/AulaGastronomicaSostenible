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


-- Inserciones en la tabla Usuario
INSERT INTO usuario (nombre, clave, email) VALUES 
('cocinero1', 'cocinero1CIFPcuenca2026', 'cocinero1@cifpcuenca.es'),
('cocinero2', 'cocinero2CIFPcuenca2026', 'cocinero2@cifpcuenca.es'),
('cocinero3', 'cocinero3CIFPcuenca2026', 'cocinero3@cifpcuenca.es');


-- Inserciones en la tabla Showcooking
-- INSERT INTO Showcooking (titulo, huellaYoutube, fechaCreacion, publicado) VALUES 
-- ('CataLaLata CIFPN1 Cuenca', 'DTC9xWtJ2Nk', '2026-04-12 10:30:00', 1),
-- ('Showcooking con Carlos Maldonado en la tienda Rufino Navarro.', '3ImAX49XiD0', '2026-04-12 10:05:00', 1),
-- ('Showcooking en directo...', '7oo02W0svtg', '2026-04-12 10:10:00', 1),
-- ('SHOWCOOKING DE FERMENTACIONES...', 'LRltGinb85A', '2026-04-12 10:15:00', 1),
-- ('Cómo hacer un Show Cooking en tu buffet.', 'ejzmheBwRmc', '2026-04-12 10:20:00', 1),
-- ('Showcooking con alma huertana.', '52LszJPBCFI', '2026-04-12 10:25:00', 1);