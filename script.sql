CREATE DATABASE teachersportal_db;

USE teachersportal_db;

CREATE TABLE tbl_genders
(
	gender_id BIGINT NOT NULL AUTO_INCREMENT,
	gender VARCHAR(45) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(gender_id)
);

INSERT INTO
	tbl_genders(gender)
VALUES
	("Male"), ("Female"), ("Others");

CREATE TABLE tbl_positions
(
	position_id BIGINT NOT NULL AUTO_INCREMENT,
	`position` VARCHAR(45) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(position_id)
);

INSERT INTO
	tbl_positions(position)
VALUES
	("Dean"), ("Part-Time Teacher"), ("Full-Time Teacher");

CREATE TABLE tbl_users
(
	user_id BIGINT NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(45) NOT NULL,
	middle_name VARCHAR(45) DEFAULT NULL,
	last_name VARCHAR(45) NOT NULL,
	gender_id BIGINT NOT NULL,
	age INT NOT NULL,
	`address` VARCHAR(45) NOT NULL,
	contact_number VARCHAR(45) DEFAULT NULL,
	email_address VARCHAR(45) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	position_id BIGINT NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(user_id),
	FOREIGN KEY(gender_id) REFERENCES tbl_genders(gender_id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(position_id) REFERENCES tbl_positions(position_id) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
	tbl_users(first_name, middle_name, last_name, gender_id, age, `address`, contact_number, email_address, `password`, position_id)
VALUES
	("Joven Joshua", "Celiz", "Alovera", 1, 23, "Roxas City, Capiz", "09123456789", "joven@gmail.com", SHA1("admin"), 1);

CREATE TABLE tbl_students
(
	student_id BIGINT NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(45) NOT NULL,
	middle_name VARCHAR(45) DEFAULT NULL,
	last_name VARCHAR(45) NOT NULL,
	gender_id BIGINT NOT NULL,
	age INT NOT NULL,
	`address` VARCHAR(45) NOT NULL,
	contact_number VARCHAR(45) DEFAULT NULL,
	email_address VARCHAR(45) NOT NULL,
	user_id BIGINT NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(student_id),
	FOREIGN KEY(gender_id) REFERENCES tbl_genders(gender_id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(user_id) REFERENCES tbl_users(user_id) ON UPDATE CASCADE ON DELETE CASCADE
);