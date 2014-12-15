#!/bin/bash

#extract db details from config.ini file
config_file_path="../config.ini"
db_user=$(awk -F " = " '/user/ {print $2}' $config_file_path)
db_pass=$(awk -F " = " '/password/ {print $2}' $config_file_path)
db_name=$(awk -F " = " '/name/ {print $2}' $config_file_path)
db_backup_directory=$(awk -F " = " '/backup_directory/ {print $2}' $config_file_path)

mysql -u $db_user -p$db_pass -D $db_name << EOF
ALTER TABLE _inde_REFERENCES ADD ALERT_STOCK float;
EOF




