SET NAMES 'utf8mb4';
SET CHARACTER SET utf8mb4;

SET
    FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS classes;
DROP TABLE IF EXISTS enrollments;
DROP TABLE IF EXISTS staff;

SET
    FOREIGN_KEY_CHECKS = 1;

CREATE TABLE students
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255),
    email      VARCHAR(255) UNIQUE,
    password   VARCHAR(255),
    birth_date DATE,
    cpf        VARCHAR(14) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    INDEX (birth_date)
);

CREATE TABLE classes
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255),
    description TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE enrollments
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    class_id   INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes (id) ON DELETE CASCADE
);

CREATE TABLE staff
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255),
    email      VARCHAR(255) UNIQUE,
    password   VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO staff (name, email, password)
VALUES ('Admin', 'admin@admin.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2');

INSERT INTO students (name, email, password, birth_date, cpf)
VALUES ('Murilo Magalhães', 'murilo.magalhaes@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1989-03-23', '371.084.295-60'),
       ('Ludmilla Gonçalves', 'ludmilla.goncalves@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2004-01-13', '356.479.820-00'),
       ('Sr. Bruno da Conceição', 'sr.bruno.da.conceição@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '2001-09-12', '915.724.083-32'),
       ('Murilo Teixeira', 'murilo.teixeira@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1998-11-11', '567.923.810-12'),
       ('Alícia Barbosa', 'alícia.barbosa@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1986-04-24', '235.869.741-91'),
       ('Dr. Antônio Monteiro', 'dr.antônio.monteiro@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1991-05-22', '840.139.725-14'),
       ('Sra. Alícia Martins', 'sra.alícia.martins@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1986-09-04', '214.903.675-43'),
       ('Laís Martins', 'laís.martins@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1990-05-06', '143.502.968-24'),
       ('Isadora Barbosa', 'isadora.barbosa@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1986-10-10', '230.746.581-26'),
       ('Maria da Mata', 'maria.da.mata@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2000-08-23', '736.841.952-19'),
       ('Sr. Arthur Lima', 'sr.arthur.lima@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1996-11-14', '437.506.812-44'),
       ('Dr. Marcelo Cunha', 'dr.marcelo.cunha@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1995-03-01', '053.278.164-35'),
       ('Brenda Peixoto', 'brenda.peixoto@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1980-10-29', '193.245.670-80'),
       ('Sr. Paulo Melo', 'sr.paulo.melo@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1988-11-27', '416.350.297-16'),
       ('Eloah Castro', 'eloah.castro@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1999-12-08', '461.987.035-84'),
       ('Lavínia Cavalcanti', 'lavínia.cavalcanti@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1998-05-20', '026.148.735-35'),
       ('Mirella Costa', 'mirella.costa@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1999-01-06', '942.067.531-99'),
       ('Srta. Gabriela Azevedo', 'srta.gabriela.azevedo@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1999-06-17', '376.940.152-25'),
       ('Agatha Rezende', 'agatha.rezende@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1979-12-05', '915.276.384-64'),
       ('Theo Viana', 'theo.viana@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1993-01-04',
        '814.563.270-62'),
       ('Helena Ramos', 'helena.ramos@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1999-01-30', '093.652.841-98'),
       ('Yago Castro', 'yago.castro@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2005-12-10',
        '750.293.186-40'),
       ('Dra. Daniela da Mota', 'dra.daniela.da.mota@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1993-09-01', '105.637.894-84'),
       ('Bárbara Freitas', 'bárbara.freitas@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2001-06-16', '864.230.591-60'),
       ('Dr. Kevin Viana', 'dr.kevin.viana@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2004-08-01', '053.719.286-77'),
       ('Alexia Costa', 'alexia.costa@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1987-11-18', '450.971.362-25'),
       ('Mariane Barros', 'mariane.barros@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1990-10-25', '486.029.571-49'),
       ('Dra. Eloah Sales', 'dra.eloah.sales@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2005-02-27', '451.098.372-79'),
       ('Ana Julia Ramos', 'ana.julia.ramos@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1989-09-06', '635.270.841-26'),
       ('Bruno Novaes', 'bruno.novaes@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1995-01-10', '679.518.023-95'),
       ('Melissa Costa', 'melissa.costa@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1987-12-27', '027.865.341-35'),
       ('Kamilly Araújo', 'kamilly.araújo@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1980-05-17', '169.857.304-93'),
       ('João Gabriel Rodrigues', 'joão.gabriel.rodrigues@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1985-12-16', '203.146.598-89'),
       ('Maria Fernanda da Paz', 'maria.fernanda.da.paz@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1993-02-23', '564.827.091-76'),
       ('Benício Vieira', 'benício.vieira@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2004-02-18', '958.470.621-76'),
       ('Maria Clara Gonçalves', 'maria.clara.gonçalves@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1986-09-21', '583.796.241-73'),
       ('Dr. Rafael da Luz', 'dr.rafael.da.luz@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1999-04-14', '935.140.286-05'),
       ('Heitor da Mota', 'heitor.da.mota@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1992-06-21', '268.170.354-90'),
       ('Davi Luiz Lima', 'davi.luiz.lima@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1980-08-20', '152.604.793-43'),
       ('Alexandre Lopes', 'alexandre.lopes@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1989-05-20', '841.095.623-33'),
       ('Srta. Stella Alves', 'srta.stella.alves@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2005-08-26', '293.068.541-70'),
       ('Matheus Araújo', 'matheus.araújo@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1987-09-13', '142.706.839-96'),
       ('Vitor Hugo Nascimento', 'vitor.hugo.nascimento@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1986-06-15', '387.190.542-97'),
       ('Samuel Novaes', 'samuel.novaes@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1993-04-10', '432.870.591-14'),
       ('Erick Martins', 'erick.martins@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1992-04-26', '276.034.851-26'),
       ('Ana Carvalho', 'ana.carvalho@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2006-09-12', '267.018.493-69'),
       ('Dr. Yago Porto', 'dr.yago.porto@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2005-12-24', '432.019.658-98'),
       ('Erick Gonçalves', 'erick.gonçalves@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1983-04-14', '087.916.234-13'),
       ('Gabrielly Gonçalves', 'gabrielly.gonçalves@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '2000-01-29', '586.413.720-08'),
       ('Laís da Cunha', 'laís.da.cunha@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1982-07-10', '675.014.283-44'),
       ('Diogo Melo', 'diogo.melo@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1982-10-28',
        '835.140.972-32'),
       ('Cauã Castro', 'cauã.castro@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1983-07-20',
        '178.259.436-19'),
       ('Lívia Viana', 'lívia.viana@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1985-05-15',
        '719.425.063-25'),
       ('Gabrielly Moreira', 'gabrielly.moreira@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1990-04-19', '135.860.492-42'),
       ('Francisco da Cruz', 'francisco.da.cruz@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2003-01-26', '032.147.589-50'),
       ('Enrico da Mata', 'enrico.da.mata@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2002-05-17', '091.632.584-98'),
       ('Ana Lívia Ramos', 'ana.lívia.ramos@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2006-08-21', '593.684.270-38'),
       ('Kaique Correia', 'kaique.correia@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1989-05-01', '843.961.270-22'),
       ('Ana Beatriz Martins', 'ana.beatriz.martins@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1996-08-04', '382.596.074-92'),
       ('Rebeca da Rocha', 'rebeca.da.rocha@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1981-11-29', '178.906.354-00'),
       ('Marina Santos', 'marina.santos@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1994-03-25', '278.163.954-00'),
       ('João Miguel Araújo', 'joão.miguel.araújo@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2004-09-27', '934.072.851-32'),
       ('Milena Caldeira', 'milena.caldeira@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1983-09-21', '312.946.057-80'),
       ('Dr. Carlos Eduardo da Conceição', 'dr.carlos.eduardo.da.conceição@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1991-02-15', '046.835.279-10'),
       ('Juan da Mata', 'juan.da.mata@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2004-06-23', '863.402.719-87'),
       ('Noah Rezende', 'noah.rezende@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1990-01-28', '463.728.509-74'),
       ('Guilherme Moraes', 'guilherme.moraes@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1989-06-05', '541.967.283-91'),
       ('Maria Alice da Luz', 'maria.alice.da.luz@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2003-04-06', '253.708.149-88'),
       ('Joana Ferreira', 'joana.ferreira@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1987-03-05', '723.410.685-53'),
       ('Caio Nunes', 'caio.nunes@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1990-08-21',
        '406.751.389-57'),
       ('Bryan Azevedo', 'bryan.azevedo@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1994-10-08', '157.932.086-40'),
       ('Ana Beatriz das Neves', 'ana.beatriz.das.neves@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1996-09-28', '764.391.820-13'),
       ('Ana Vitória Almeida', 'ana.vitória.almeida@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1986-08-28', '058.319.726-40'),
       ('Igor Nunes', 'igor.nunes@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1981-05-12',
        '391.278.456-64'),
       ('Ana Luiza Vieira', 'ana.luiza.vieira@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1991-05-06', '542.081.379-32'),
       ('Maria Fernanda Alves', 'maria.fernanda.alves@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1981-01-03', '372.169.580-12'),
       ('Eduardo Cardoso', 'eduardo.cardoso@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1984-05-21', '469.031.578-75'),
       ('Marcela Rezende', 'marcela.rezende@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2001-09-07', '701.456.398-00'),
       ('Emanuella Nunes', 'emanuella.nunes@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1981-10-11', '859.763.401-48'),
       ('Helena Cunha', 'helena.cunha@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1998-12-10', '918.204.637-96'),
       ('Luiza Castro', 'luiza.castro@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2002-07-15', '946.570.218-85'),
       ('Vitória da Costa', 'vitória.da.costa@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1983-08-27', '765.340.281-07'),
       ('Bárbara Gomes', 'bárbara.gomes@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2000-01-16', '354.629.701-61'),
       ('Vitória Rocha', 'vitória.rocha@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1991-06-04', '360.972.458-74'),
       ('Mariana Fogaça', 'mariana.fogaça@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1980-06-07', '831.246.705-07'),
       ('Sra. Rafaela Cavalcanti', 'sra.rafaela.cavalcanti@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1981-10-29', '061.574.283-17'),
       ('Pedro Correia', 'pedro.correia@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2000-02-28', '748.935.621-00'),
       ('Rebeca da Conceição', 'rebeca.da.conceição@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1982-04-01', '731.869.402-22'),
       ('Catarina Viana', 'catarina.viana@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2005-02-07', '205.319.647-52'),
       ('Ana Sophia Costela', 'ana.sophia.costela@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1998-07-24', '281.036.459-15'),
       ('Lara Fogaça', 'lara.fogaça@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1980-01-01',
        '927.156.304-25'),
       ('Dr. Davi Luiz Rezende', 'dr.davi.luiz.rezende@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1994-03-22', '680.235.479-92'),
       ('Caroline Araújo', 'caroline.araújo@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1991-07-09', '098.413.762-96'),
       ('Caio Lopes', 'caio.lopes@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '2006-09-18',
        '683.209.154-06'),
       ('Dr. Bruno Gomes', 'dr.bruno.gomes@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1987-06-29', '985.012.734-14'),
       ('Juan Silveira', 'juan.silveira@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1990-04-12', '139.607.254-34'),
       ('Caio Vieira', 'caio.vieira@test.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2',
        '1995-03-25',
        '572.869.340-74'),
       ('Luiz Otávio Azevedo', 'luiz.otávio.azevedo@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1985-03-15', '945.728.031-88'),
       ('Sra. Marcela Campos', 'sra.marcela.campos@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '2007-04-25', '157.023.694-16'),
       ('Ana Vitória da Rosa', 'ana.vitória.da.rosa@test.com',
        '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1982-07-02', '816.394.205-33');

INSERT INTO classes (name, description)
VALUES ('Análise de Sistemas',
        'Estudo de métodos, técnicas e ferramentas para análise, especificação e modelagem de sistemas de informação.'),
       ('Engenharia de Software',
        'Aplicação de princípios de engenharia para o desenvolvimento, manutenção e gestão de softwares de alta qualidade.'),
       ('Banco de Dados',
        'Conceitos, modelagem, implementação e administração de sistemas de gerenciamento de bancos de dados relacionais.'),
       ('Redes de Computadores',
        'Introdução às redes de comunicação de dados, seus protocolos, arquiteturas e funcionamento.'),
       ('Programação Orientada a Objetos',
        'Fundamentos da programação utilizando o paradigma orientado a objetos, com classes, objetos, herança e polimorfismo.'),
       ('Estruturas de Dados',
        'Estudo das principais estruturas de dados como listas, pilhas, filas, árvores e grafos, e suas aplicações.'),
       ('Arquitetura de Computadores',
        'Compreensão da organização e funcionamento interno dos computadores, incluindo CPU, memória e dispositivos de entrada/saída.'),
       ('Inteligência Artificial',
        'Introdução aos conceitos e técnicas de IA, como aprendizado de máquina, processamento de linguagem natural e sistemas especialistas.'),
       ('Algoritmos e Lógica de Programação',
        'Desenvolvimento de raciocínio lógico e habilidades de construção de algoritmos para resolução de problemas computacionais.'),
       ('Sistemas Operacionais',
        'Estudo dos princípios e funcionamento de sistemas operacionais, com ênfase em processos, memória e sistemas de arquivos.'),
       ('Gestão de Projetos',
        'Planejamento, execução e controle de projetos, com práticas baseadas em metodologias ágeis e tradicionais.'),
       ('Empreendedorismo e Inovação',
        'Desenvolvimento de competências empreendedoras para criação e gestão de novos negócios e produtos inovadores.'),
       ('Marketing Digital',
        'Fundamentos do marketing no ambiente digital, incluindo estratégias de SEO, mídias sociais, e-commerce e análise de métricas.'),
       ('Contabilidade Básica',
        'Princípios de contabilidade, com foco em demonstrações financeiras, análise de balanços e registros contábeis.'),
       ('Direito Empresarial',
        'Noções jurídicas aplicadas à constituição, funcionamento e responsabilidade das empresas e seus contratos comerciais.'),
       ('Matemática Financeira',
        'Aplicação de conceitos matemáticos para análise de operações financeiras, como juros simples, compostos e amortizações.'),
       ('Estatística Aplicada',
        'Conceitos de estatística descritiva e inferencial aplicados à análise de dados e tomada de decisão.'),
       ('Ética e Responsabilidade Social',
        'Discussão sobre valores éticos e práticas de responsabilidade social no ambiente corporativo e na sociedade.'),
       ('Metodologia Científica',
        'Orientações sobre métodos de pesquisa científica, elaboração de projetos, artigos e trabalhos acadêmicos.'),
       ('Psicologia Organizacional',
        'Análise do comportamento humano nas organizações, focando em motivação, liderança, comunicação e cultura organizacional.'),
       ('Logística Empresarial',
        'Planejamento, implementação e controle eficiente do fluxo de materiais, informações e serviços na cadeia de suprimentos.'),
       ('Finanças Corporativas',
        'Gestão financeira das empresas, abordando investimentos, estrutura de capital e análise de riscos.'),
       ('Segurança da Informação',
        'Princípios e práticas para proteger sistemas de informação contra acessos não autorizados, falhas e ataques cibernéticos.'),
       ('Desenvolvimento Mobile',
        'Conceitos e práticas para o desenvolvimento de aplicações móveis para plataformas Android e iOS.');


INSERT INTO enrollments (student_id, class_id)
VALUES (1, 1),
       (1, 2),
       (1, 3),
       (2, 3),
       (2, 4),
       (2, 5),
       (19, 1),
       (19, 6),
       (40, 1),
       (26, 2),
       (26, 4),
       (26, 5),
       (5, 3),
       (57, 4),
       (57, 6)