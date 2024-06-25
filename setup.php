<?php

$serverName = "localhost";
$userName = "root";
$password = "";

$dbc = new mysqli($serverName, $userName, $password);

$sql1 = "CREATE DATABASE IF NOT EXISTS myDb DEFAULT CHARACTER SET utf8";

$sql2 = "USE myDb";

$sql3= "CREATE TABLE IF NOT EXISTS `myDb`.`subscriptions` (
    `price` INT NOT NULL,
    `length` VARCHAR(30) NOT NULL,
    `description` VARCHAR(50) NULL DEFAULT NULL,
    `type` VARCHAR(20) NOT NULL,
    `id` INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    INDEX `id` (`id` ASC),
    UNIQUE INDEX `type_UNIQUE` (`type` ASC))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8
  COLLATE = utf8_persian_ci";

$sql4 = "CREATE TABLE IF NOT EXISTS `myDb`.`employees` (
  `username` VARCHAR(30) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `create_time` DATETIME NULL,
  `id` INT NOT NULL AUTO_INCREMENT,
  `subscription_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
  INDEX `id` (`id` ASC) VISIBLE,
  INDEX `subscription_id_idx` (`subscription_id` ASC) VISIBLE,
  CONSTRAINT `subscription_id`
    FOREIGN KEY (`subscription_id`)
    REFERENCES `myDb`.`subscriptions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_persian_ci";

$sql5 ="CREATE TABLE IF NOT EXISTS `myDb`.`managers` (
  `username` VARCHAR(30) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `create_time` DATETIME NULL,
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
  INDEX `id` (`id` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_persian_ci";

$sql6 = "CREATE TABLE IF NOT EXISTS `myDb`.`tasks` (
  `is_done` TINYINT NOT NULL,
  `expire_date` DATE NOT NULL DEFAULT '2024-01-01',
  `title` VARCHAR(100) NOT NULL,
  `id` INT NOT NULL AUTO_INCREMENT,
  `employee_id` INT NOT NULL,
  `flags` JSON NULL,
  `parent_task_id` INT NULL,
  `manager_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `employee_id_idx` (`employee_id` ASC) VISIBLE,
  INDEX `parent_task_id_idx` (`parent_task_id` ASC) VISIBLE,
  INDEX `manager_id_idx` (`manager_id` ASC) VISIBLE,
  CONSTRAINT `employee_id`
    FOREIGN KEY (`employee_id`)
    REFERENCES `myDb`.`employees` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `parent_task_id`
    FOREIGN KEY (`parent_task_id`)
    REFERENCES `myDb`.`tasks` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `manager_id`
    FOREIGN KEY (`manager_id`)
    REFERENCES `myDb`.`managers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_persian_ci";

$sql7 = "CREATE TABLE IF NOT EXISTS `myDb`.`done_tasks_history` (
  `done_date` DATE NOT NULL,
  `id` INT NOT NULL AUTO_INCREMENT,
  `employee_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `id` (`id` ASC) VISIBLE,
  CONSTRAINT `employees_id`
    FOREIGN KEY (`employee_id`)
    REFERENCES `myDb`.`employees` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_persian_ci";


$sql8 = "INSERT INTO subscriptions(type, price, length, description)
VALUES('Free', 0, 3, NULL),
      ('Gold', 1000000, 36, 'the best subscription')";

$result1 = $dbc->query($sql1);
if(!$result1)
    echo "Error:" . $sql1 . "<br>" . $dbc->error;

$result2 = $dbc->query($sql2);
if(!$result2)
    echo "Error:" . $sql2 . "<br>" . $dbc->error;

$result3 = $dbc->query($sql3);
if(!$result3)
    echo "Error:" . $sql3 . "<br>" . $dbc->error;

$result4 = $dbc->query($sql4);
if(!$result4)
    echo "Error:" . $sql4 . "<br>" . $dbc->error;

$result5 = $dbc->query($sql5);
if(!$result5)
    echo "Error:" . $sql5 . "<br>" . $dbc->error;

$result6 = $dbc->query($sql6);
if(!$result6)
    echo "Error:" . $sql6 . "<br>" . $dbc->error;

$result7 = $dbc->query($sql7);
if(!$result7)
    echo "Error:" . $sql7 . "<br>" . $dbc->error;

$result8 = $dbc->query($sql8);
if(!$result8)
    echo "Error:" . $sql8 . "<br>" . $dbc->error;

$dbc->close();