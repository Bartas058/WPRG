USE cars;

CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    year INT NOT NULL,
    description TEXT
);

USE cars;

INSERT INTO cars (brand, model, price, year, description) VALUES
('Toyota', 'Camry', 24000.00, 2020, 'Reliable mid-size sedan with great fuel economy'),
('Honda', 'Civic', 22000.00, 2019, 'Compact car with sporty handling and efficient engine'),
('Ford', 'Mustang', 35000.00, 2021, 'Iconic American muscle car with powerful V8 engine'),
('Chevrolet', 'Tahoe', 50000.00, 2022, 'Full-size SUV with spacious interior and advanced technology'),
('Tesla', 'Model 3', 45000.00, 2023, 'Electric sedan with impressive range and autonomous driving features'),
('BMW', '3 Series', 41000.00, 2020, 'Luxury compact sedan with excellent performance and technology'),
('Audi', 'A4', 39000.00, 2021, 'Premium compact sedan with a refined interior and smooth ride'),
('Mercedes-Benz', 'C-Class', 42000.00, 2022, 'Elegant and stylish compact luxury sedan with advanced features'),
('Nissan', 'Altima', 25000.00, 2019, 'Affordable mid-size sedan with comfortable ride and modern features'),
('Hyundai', 'Elantra', 20000.00, 2023, 'Economical compact car with a stylish design and efficient engine');
