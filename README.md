# Gase-Web
Logiciel pour Groupement d'Achat Service Epicerie

## Prérequis
Pour utiliser ce logiciel il faut disposer d'un ordinateur local ou d'un serveur avec une distribution LAMP (Linux, Apache, MySQL et PHP) récente.

## Installation en local
Il suffit de cloner les sources depuis le dépôt GitHub à partir du Terminal. Pour installer en local, il faudra que votre distribution Linux dispose de l'outil **git** qui permet de gérer les sources du logiciel. Voir plus bas pour l'installation de **git**.

1. Ouvrir le Terminal
2. Se placer dans le dossier racine d'Apache

	`cd /var/www/vhosts`
3. Cloner les sources

	`git clone http://github.com/barchstien/gase-web/`
4. Créer un lien symbolique (raccourci) pour renommer l'outil comme il vous convient, par ex "outil"

	`ln -s ./gase-web/source outil`
5. Créer la base MySQL avec un accès utilisateur personnalisé (il faut connaître le mot de passe MySQL de l'utilisateur **root**)

	`mysql -u root -p < ./gase-web/create_database.sql`
	
	**Note:** le fichier `create_database.sql` crée une base vide et l'utilisateur par défaut dont les identifiants sont donnés dans le fichier **config.ini**
6. Ouvrir un navigateur et aller à l'adresse suivante : [http://localhost/outil]()

Et voilà !

## Installation chez un hébergeur
S'il s'agit d'un hébergement mutualisé, il n'est pas possible d'utiliser **git** directement car l'accès est limité au FTP et phpMyAdmin pour MySQL. La procédure suivante indique comment installer ou mettre à jour les sources du logiciel en passant par la machine locale. On suppose que cette machine locale est une Linux.

1. Suivre TOUTE la procédure **Installation en local** ci-dessus jusqu'au point 4, sauf qu'au lieu de se mettre à la racine du serveur Apache, vous pouvez simplement vous placer à la racine de votre dossier utilisateur, avec la commande `cd ;` ou `cd ~`2. 
2. Copier tous les fichiers sur le serveur FTP en utilisant le script de synchronisation **sync_ftp.sh**

	`cd gase-web`

	puis
	
	`./sync_ftp.sh`
	
	**Note:** ce script permet de synchroniser TOUS les fichiers sources en local avec votre serveur FTP. Il faut bien entendu le modifier pour mettre les paramètres de votre connexion FTP ! De plus, ce script utilise le programme **curlftpfs** qu'il faudra peut-être installer sur votre distribution Linux, par ex : `sudo apt-get install curlftpfs`

## Mise à jour
La mise à jour consiste à récupérer la dernière version des sources sur le dépôt GitHub et d'appliquer éventuellement un script pour la migration de la base de données.
### En local
La mise à jour des fichiers se fait en local avec l'outil **git**. S'il y a un hébergement FTP, il suffit ensuite d'utiliser le script **sync_ftp.sh** pour faire répercuter les modifications sur le serveur.
### Chez un hébergeur
La différence avec la mise à jour en local se situe au niveau de la base de données. Il suffit de suivre les étapes suivantes :

1. Ouvrir le script de migration **update_database.sql** dans un éditeur de texte
2. Ouvrir **phpMyAdmin** sur le serveur de l'hébergeur avec les identifiants connus
3. Ouvrir l'onglet **SQL** et faire un copier-coller du contenu du script dans la zone de saisie, puis **Exécuter**.


## Compléments

### Installer *git*
Par exemple sur une distribution Linux Debian (ou Ubuntu), il suffit d'entrer la commande suivante :
`sudo apt-get install git` 
où `sudo` vous demande les droits super-utilisateur donc il faut avoir le mot de passe **root** sous la main.
