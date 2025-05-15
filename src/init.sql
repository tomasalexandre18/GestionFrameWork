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
('Product 1', 10.00, 1, 'image1.jpg'),
('Product 2', 20.00, 1, 'image2.jpg'),
('Product 3', 30.00, 1, 'image3.jpg'),
('Product 4', 40.00, 1, 'image4.jpg'),
('Product 5', 50.00, 1, 'image5.jpg'),
('Product 6', 60.00, 1, 'image6.jpg'),
('Product 7', 70.00, 1, 'image7.jpg'),
('Product 8', 80.00, 1, 'image8.jpg'),
('Product 9', 90.00, 1, 'image9.jpg'),
('Product 10', 100.00, 1, 'image10.jpg'),
('Product 11', 110.00, 2, 'image11.jpg'),
('Product 12', 120.00, 2, 'image12.jpg'),
('Product 13', 130.00, 2, 'image13.jpg'),
('Product 14', 140.00, 2, 'image14.jpg'),
('Product 15', 150.00, 2, 'image15.jpg'),
('Product 16', 160.00, 2, 'image16.jpg'),
('Product 17', 170.00, 2, 'image17.jpg'),
('Product 18', 180.00, 2, 'image18.jpg'),
('Product 19', 190.00, 2, 'image19.jpg'),
('Product 20', 200.00, 2, 'image20.jpg'),
('Product 21', 210.00, 3, 'image21.jpg'),
('Product 22', 220.00, 3, 'image22.jpg'),
('Product 23', 230.00, 3, 'image23.jpg'),
('Product 24', 240.00, 3, 'image24.jpg'),
('Product 25', 250.00, 3, 'image25.jpg'),
('Product 26', 260.00, 3, 'image26.jpg'),
('Product 27', 270.00, 3, 'image27.jpg'),
('Product 28', 280.00, 3, 'image28.jpg'),
('Product 29', 290.00, 3, 'image29.jpg'),
('Product 30', 300.00, 3, 'image30.jpg'),
('Product 31', 310.00, 1, 'image31.jpg'),
('Product 32', 320.00, 1, 'image32.jpg'),
('Product 33', 330.00, 1, 'image33.jpg'),
('Product 34', 340.00, 1, 'image34.jpg'),
('Product 35', 350.00, 1, 'image35.jpg'),
('Product 36', 360.00, 1, 'image36.jpg'),
('Product 37', 370.00, 1, 'image37.jpg'),
('Product 38', 380.00, 1, 'image38.jpg'),
('Product 39', 390.00, 1, 'image39.jpg'),
('Product 40',3900.00 ,1,'image40.jpg');

SELECT * FROM product;