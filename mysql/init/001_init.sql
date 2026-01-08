CREATE TABLE IF NOT EXISTS test_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO test_items (nombre) VALUES
('Hola desde MySQL'),
('Docker Compose OK'),
('PHP conectado ✅');