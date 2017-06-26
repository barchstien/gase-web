# Introduction
Logiciel d'achat pour Gase, incluant :
 * interface d'achat, avec compte MoneyCoop pour chaque adhérent et enregistrement des achats
 * gestion des références (produits) disponibles
 * gestion des inventaires
 * gestion des adhérents
 * outil de communication
 * envois de tickets par email, script pour backup SQL, graphes consomation

# Historique
Logiciel créé par un gase de Maris (l'indépendante ?), transmis au gase de Rezé, amélioré par le gase de l'Esclain

# Instalation & Config

1. Install Ubuntu/Debian (Xubuntu Ubuntu Gnome)  
    Prefer LTS version  
    http://www.ubuntu.com/download/desktop  

2. Install and config LAMP  
    `sudo apt-get install LAMP^`  
    TODO config with symlink from available-sites to enable-sites
    
4. Create DB scheme and user with appropriate rights  
    run the script at migration/gase_db_init.sql
    
5. Copy and configue gase-web  
	copy to /var/www/you_folder  
    set config.ini

6. Backup  
    set config.ini file path in **backup_script.sh**  
    set backup_directory in **config.ini**  
    set anacron as explained in **backup_script.sh**  
    synchronise the backup_directory to a sync folder like dropbox (easy on ubuntu)  
    **WARNING** Better safe than sorry, do yourself a solid and do setup a backup !  
    
7. Setup email send  
	needed ? delete ?
