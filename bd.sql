CREATE DATABASE kanban_app;

USE kanban_app;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, 
    notificaciones BOOLEAN DEFAULT TRUE
);

-- Tabla de materias
CREATE TABLE materias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    color VARCHAR(20),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla de estados 
CREATE TABLE estados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Tabla de tareas (Kanban)
CREATE TABLE tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_materia INT,
    id_estado INT,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_vencimiento DATE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_materia) REFERENCES materias(id) ON DELETE SET NULL,
    FOREIGN KEY (id_estado) REFERENCES estados(id) ON DELETE SET NULL
);

-- Tabla de notas rápidas
CREATE TABLE notas_rapidas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    contenido TEXT,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);


INSERT INTO estados (nombre) VALUES
('Pendiente'),
('En progreso'),
('Completada');

INSERT INTO materias (id_usuario, nombre, color) VALUES
(1, 'Matemáticas', '#22c55e'),          
(1, 'Español', '#3b82f6'),              
(1, 'Ciencias', '#f97316'),             
(1, 'Estudios Sociales', '#a855f7');  

INSERT INTO tareas (id_usuario, id_materia, id_estado, titulo, descripcion, fecha_vencimiento) VALUES
(1, 1, 1, 'Estudiar fracciones', 'Resolver ejercicios de fracciones del libro.', '2025-08-08'),
(1, 2, 1, 'Leer capítulo 3', 'Capítulo de comprensión lectora.', '2025-08-10'),
(1, 3, 2, 'Experimento de química', 'Preparar materiales para el experimento de laboratorio.', '2025-08-10'),
(1, 4, 1, 'Resumen histórico', 'Hacer resumen sobre la Revolución Francesa.', '2025-08-15');

