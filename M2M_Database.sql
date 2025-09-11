CREATE DATABASE IF NOT EXISTS m2mdb;
USE m2mdb;

-- =============================
-- 1. Tabla de usuarios
-- =============================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'gestor', 'lector') DEFAULT 'gestor',
    active TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================
-- 2. Tabla de proyectos
-- =============================
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATE DEFAULT NULL,
    end_date DATE DEFAULT NULL,
    status ENUM('pendiente', 'en_progreso', 'completado', 'cancelado') DEFAULT 'pendiente',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    priority ENUM('baja', 'media', 'alta') DEFAULT 'baja',
    budget DECIMAL(15, 2) DEFAULT 0.00,
    actual_cost DECIMAL(15,2) DEFAULT 0.00,

    user_created INT,
    FOREIGN KEY (user_created) REFERENCES users(id) ON DELETE CASCADE
);

-- =============================
-- 3. Tabla de procesos / etapas / subprocesos (jerarquía)
-- =============================
CREATE TABLE processes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    parent_id INT DEFAULT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATE DEFAULT NULL,
    end_date DATE DEFAULT NULL,
    status ENUM('pendiente', 'en_progreso', 'completado', 'cancelado') DEFAULT 'pendiente',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    priority ENUM('baja', 'media', 'alta') DEFAULT 'baja',
    progress DECIMAL(5,2) DEFAULT 0.00,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES processes(id) ON DELETE CASCADE
);

-- =============================
-- 4. Documentos adjuntos a procesos
-- =============================
CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    process_id INT NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_name VARCHAR(255),
    uploaded_by INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (process_id) REFERENCES processes(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL
);

-- =============================
-- 5. Notas o comentarios en procesos (opcional)
-- =============================
CREATE TABLE process_notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    process_id INT NOT NULL,
    user_id INT NOT NULL,
    note TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (process_id) REFERENCES processes(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
