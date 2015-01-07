#!/bin/bash

##crontab : sudo crontab -e
#every friday at 5:01am. crontab -l to list existing entries
#01 5 * * 5 /var/www/html/gase-web/backup_script.sh
#anacron
#sudo apt-get install anacron
#in /etc/anacrontab : 
#6 5 backup.gase.db /var/www/html/gase-web/backup_script.sh
#replace path to command with relevant path

#extract db details from config.ini file
#!!! path to config.ini file should be ABSOLUTE
config_file_path="/home/gase/Web/gase/config.ini"


################
db_user=$(awk -F " = " '/^user/ {print $2}' $config_file_path)
db_pass=$(awk -F " = " '/^password/ {print $2}' $config_file_path)
db_name=$(awk -F " = " '/^name/ {print $2}' $config_file_path)
db_backup_directory_root=$(awk -F " = " '/^backup_directory/ {print $2}' $config_file_path)
db_backup_directory="$db_backup_directory_root/database_backup"
db_backup_depth=$(awk -F " = " '/^backup_depth/ {print $2}' $config_file_path)

echo $config_file_path
echo $db_user
echo $db_pass
echo $db_backup_directory

#backup
mysqldump -u $db_user -p$db_pass $db_name > $db_backup_directory/gase_db_backup_`date +%Y-%m-%d_%Hh%Mmin%S`.sql

#delete old backup files
num_of_backup=$(ls $db_backup_directory | grep -c gase_db_backup)
echo "num of backup : " $num_of_backup
while [ $num_of_backup -gt $db_backup_depth ]
do
oldest_file_name=$(ls $db_backup_directory | grep gase_db_backup | head -n 1)
echo "delete old backup : " $db_backup_directory/$oldest_file_name
rm -f $db_backup_directory/$oldest_file_name
num_of_backup=$(ls $db_backup_directory | grep -c gase_db_backup)
done

#trigger grive sync
cd $db_backup_directory_root
grive

#to restore restore
# mysql -u $db_user -p$db_pass $db_name < dumpfilename.sql
