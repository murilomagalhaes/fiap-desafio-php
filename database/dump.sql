SET
FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS classes;
DROP TABLE IF EXISTS student_has_classes;
DROP TABLE IF EXISTS staff;

SET
FOREIGN_KEY_CHECKS=1;

CREATE TABLE students
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255),
    email      VARCHAR(255) UNIQUE,
    password   VARCHAR(255),
    birth_date DATE,
    cpf        VARCHAR(14),
    created_at DATE,
    INDEX (birth_date)
);

CREATE TABLE classes
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255),
    description VARCHAR(255),
    created_at  DATE,
);

CREATE TABLE student_has_classes
(
    student_id INT,
    class_id   INT,
    PRIMARY KEY (student_id, class_id),
    FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes (id) ON DELETE CASCADE
);

CREATE TABLE staff
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255),
    email      VARCHAR(255) UNIQUE,
    password   VARCHAR(255),
    created_at DATE,
);
