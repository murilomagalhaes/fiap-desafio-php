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
    cpf        VARCHAR(14) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    INDEX (birth_date)
);

CREATE TABLE classes
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255),
    description TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO staff (name, email, password)
VALUES ('Admin', 'admin@admin.com', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2');

INSERT INTO students (name, email, password, birth_date, cpf)
VALUES ('John Doe', 'john@doe.test', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1992-05-05',
        '933.578.130-41'),
       ('Jane Doe', 'jane@doe.test', '$2y$12$2HRCGqQ0SQeyZ8S/iThc4uJfk3exGrXhq/46x6i51m5v/1XaD8HF2', '1998-03-02',
        '772.671.590-10');

INSERT INTO classes (title, description)
VALUES ('Cybersecurity',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat'),
       ('Business Administration',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat'),
       ('WEB Development 01',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat');

INSERT INTO student_has_classes
VALUES (1, 1),
       (1, 3),
       (2, 2)