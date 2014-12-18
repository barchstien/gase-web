#!/bin/bash


#extract db details from config.ini file
 
config_file_path="config.ini"
db_user=$(awk -F " = " '/user/ {print $2}' $config_file_path)
db_pass=$(awk -F " = " '/password/ {print $2}' $config_file_path)
db_name=$(awk -F " = " '/name/ {print $2}' $config_file_path)
db_backup_directory=$(awk -F " = " '/backup_directory/ {print $2}' $config_file_path)
db_backup_depth=$(awk -F " = " '/backup_depth/ {print $2}' $config_file_path)
 

#backup
#mysqldump -u $db_user -p$db_pass $db_name > $db_backup_directory/gasedl.sql;

#Connexion à mysql en root
mysql -u root --password=gase
#mysql -u root -p  #Invite de saisie du mdp (linux root)

mysql> CREATE DATABASE $db_name;
mysql > source $db_backup_directory/gasedl.sdl;
mysql> GRANT ALL PRIVILEGES ON $db_name.* TO $db_user@'%' IDENTIFIED BY $db_pass;
mysql> quit;