#!/bin/bash

##crontab : sudo crontab -e
#every friday at 5:01am. crontab -l to list existing entries
#01 5 * * 5 /var/www/html/gase-web/backup_script.sh

#extract db details from config.ini file
config_file_path="config.ini"
db_user=$(awk -F " = " '/user/ {print $2}' $config_file_path)
db_pass=$(awk -F " = " '/password/ {print $2}' $config_file_path)
db_name=$(awk -F " = " '/name/ {print $2}' $config_file_path)
db_backup_directory=$(awk -F " = " '/backup_directory/ {print $2}' $config_file_path)

#backup
mysqldump -u $db_user -p$db_pass $db_name > $db_backup_directory/gase_db_backup_`date +%Y-%m-%d_%Hh%Mmin%S`.sql

#to restore restore
# mysql -u $db_user -p$db_pass $db_name < dumpfilename.sql
