#backup
mysqldump -u gase -pgasepass gasedl > gase_db_backup_`date +%Y%m%d`.sql

#restore
# mysql -u gase -pgasepass gasedl < dumpfilename.sql
