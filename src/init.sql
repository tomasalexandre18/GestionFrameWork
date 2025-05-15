DROP DATABASE IF EXISTS test;
CREATE DATABASE test;
USE test;

CREATE TABLE IF NOT EXISTS zone_stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    adresse varchar(100) NOT NULL,
    code_postal VARCHAR(10) NOT NULL
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    prix_ht DECIMAL(10, 2) NOT NULL,
    prix_ttc DECIMAL(10, 2) AS (prix_ht * (1 + taux_tva / 100)) VIRTUAL,
    taux_tva DECIMAL(5, 2) DEFAULT 20.00,
    id_zone_stock INT NOT NULL,
    image TEXT,
    FOREIGN KEY (id_zone_stock) REFERENCES zone_stock(id)
) ENGINE=InnoDB;

INSERT INTO zone_stock (libelle, ville, adresse, code_postal) VALUES
('Zone A', 'Paris', '10 rue de Paris', '75001'),
('Zone B', 'Lyon', '20 rue de Lyon', '69001'),
('Zone C', 'Marseille', '30 rue de Marseille', '13001');

INSERT INTO product (name, prix_ht, id_zone_stock, image) VALUES
('Product 1', 10.00, 1, 'product1.png'),
('Product 2', 20.00, 1, 'product1.png'),
('Product 3', 30.00, 1, 'product1.png'),
('Product 4', 40.00, 1, 'product1.png'),
('Product 5', 50.00, 1, 'product1.png'),
('Product 6', 60.00, 1, 'product1.png'),
('Product 7', 70.00, 1, 'product1.png'),
('Product 8', 80.00, 1, 'product1.png'),
('Product 9', 90.00, 1, 'product1.png'),
('Product 10', 100.00, 1, 'product1.png'),
('Product 11', 110.00, 2, 'product1.png'),
('Product 12', 120.00, 2, 'product1.png'),
('Product 13', 130.00, 2, 'product1.png'),
('Product 14', 140.00, 2, 'product1.png'),
('Product 15', 150.00, 2, 'product1.png'),
('Product 16', 160.00, 2, 'product1.png'),
('Product 17', 170.00, 2, 'product1.png'),
('Product 18', 180.00, 2, 'product1.png'),
('Product 19', 190.00, 2, 'product1.png'),
('Product 20', 200.00, 2, 'product1.png'),
('Product 21', 210.00, 3, 'product1.png'),
('Product 22', 220.00, 3, 'product1.png'),
('Product 23', 230.00, 3, 'product1.png'),
('Product 24', 240.00, 3, 'product1.png'),
('Product 25', 250.00, 3, 'product1.png'),
('Product 26', 260.00, 3, 'product1.png'),
('Product 27', 270.00, 3, 'product1.png'),
('Product 28', 280.00, 3, 'product1.png'),
('Product 29', 290.00, 3, 'product1.png'),
('Product 30', 300.00, 3, 'product1.png'),
('Product 31', 310.00, 1, 'product1.png'),
('Product 32', 320.00, 1, 'product1.png'),
('Product 33', 330.00, 1, 'product1.png'),
('Product 34', 340.00, 1, 'product1.png'),
('Product 35', 350.00, 1, 'product1.png'),
('Product 36', 360.00, 1, 'product1.png'),
('Product 37', 370.00, 1, 'product1.png'),
('Product 38', 380.00, 1, 'product1.png'),
('Product 39', 390.00, 1, 'product1.png'),
('Product 40',3900.00 ,1,'product1.png');

SELECT * FROM product;