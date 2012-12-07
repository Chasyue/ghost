-- -----------------------------------------------------
-- Table `session`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `session` (
  `session_id` VARCHAR(255) NOT NULL ,
  `session_value` TEXT NOT NULL ,
  `session_time` INT UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`session_id`) )
ENGINE = InnoDB;