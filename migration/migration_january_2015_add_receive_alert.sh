#!/bin/bash

#extract db details from config.ini file
config_file_path="../config.ini"
db_user=$(awk -F " = " '/^user/ {print $2}' $config_file_path)
db_pass=$(awk -F " = " '/^password/ {print $2}' $config_file_path)
db_name=$(awk -F " = " '/^name/ {print $2}' $config_file_path)

mysql -u $db_user -p$db_pass -D $db_name << EOF
ALTER TABLE _inde_ADHERENTS ADD RECEIVE_ALERT_STOCK tinyint;

CREATE TABLE `_inde_ALERTS_STOCK_RAISED` (
  `id_inde_ALERTS_STOCK_RAISED` INT NOT NULL,
  `ID_REFERENCE` INT NULL,
  `TIMESTAMP` TIMESTAMP NULL DEFAULT NOW() AFTER `REFERENCE_ID`,
  PRIMARY KEY (`id_inde_ALERTS_STOCK_RAISED`));


EOF


