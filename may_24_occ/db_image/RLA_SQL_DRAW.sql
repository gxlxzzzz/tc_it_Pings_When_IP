CREATE TABLE `user_type` (
    `user_type_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `type` INT NOT NULL,
    `discount` DECIMAL(5,2) NOT NULL,
    PRIMARY KEY (`user_type_id`)
);

CREATE TABLE `user` (
    `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `f_name` VARCHAR(50) NOT NULL,
    `s_name` VARCHAR(50) NOT NULL,
    `user_type_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`user_id`),
    CONSTRAINT `user_type_id_fk` FOREIGN KEY (`user_type_id`) 
        REFERENCES `user_type` (`user_type_id`)
);

CREATE TABLE `h_booking` (
    `booking_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED NOT NULL,
    `made_on` TIMESTAMP NOT NULL,
    `date` DATE NOT NULL,
    `nights` INT NOT NULL,
    PRIMARY KEY (`booking_id`),
    CONSTRAINT `h_booking_user_id_fk` FOREIGN KEY (`user_id`) 
        REFERENCES `user` (`user_id`)
);

CREATE TABLE `hotel_rooms` (
    `hr_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `type` INT NOT NULL,
    `occupancy` INT NOT NULL,
    `no_of_rooms` INT NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (`hr_id`)
);

CREATE TABLE `staying_in` (
    `stay_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `booking_id` INT UNSIGNED NOT NULL,
    `hr_id` INT UNSIGNED NOT NULL,
    `no_of_people` INT NOT NULL,
    PRIMARY KEY (`stay_id`),
    CONSTRAINT `staying_in_booking_id_fk` FOREIGN KEY (`booking_id`) 
        REFERENCES `h_booking` (`booking_id`),
    CONSTRAINT `staying_in_hr_id_fk` FOREIGN KEY (`hr_id`) 
        REFERENCES `hotel_rooms` (`hr_id`)
);

CREATE TABLE `t_booking` (
    `t_booking` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED NOT NULL,
    `made_on` TIMESTAMP NOT NULL,
    `date` DATE NOT NULL,
    PRIMARY KEY (`t_booking`),
    CONSTRAINT `t_booking_user_id_fk` FOREIGN KEY (`user_id`) 
        REFERENCES `user` (`user_id`)
);

CREATE TABLE `tickets` (
    `t_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `type` INT NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `no_of_tickets` INT NOT NULL,
    PRIMARY KEY (`t_id`)
);

CREATE TABLE `visits` (
    `visit_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `t_booking` INT UNSIGNED NOT NULL,
    `t_id` INT UNSIGNED NOT NULL,
    `no_of_t` INT NOT NULL,
    PRIMARY KEY (`visit_id`),
    CONSTRAINT `visits_t_booking_fk` FOREIGN KEY (`t_booking`) 
        REFERENCES `t_booking` (`t_booking`),
    CONSTRAINT `visits_t_id_fk` FOREIGN KEY (`t_id`) 
        REFERENCES `tickets` (`t_id`)
);

CREATE TABLE `loyalty` (
    `it_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `points` INT NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`it_id`),
    CONSTRAINT `loyalty_user_id_fk` FOREIGN KEY (`user_id`) 
        REFERENCES `user` (`user_id`)
);