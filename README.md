# Prérequis :

Les packages apache2 mysql-server php5 php5-mysql et git doivent être installer.
Installion des packages la fimille Debian : #apt-get install apache2 mysql-server php5 php5-mysql git
NB : le login et le mot de passe doivent être réspectivement root et admin.
mysql_user = root (default)
mysql_password = admin (requested durant mysql server installation)


# Installation des sources :

1- Créez un répertoire sous /var/www/ et nommez le DevCampUTM
2- Maintenant clonez le projet :
- cd /var/www/DevCampUTM
si vous avez un compte github faites :
- git clone https://github.com/vaytess/DevCampUTM.git
3- Initialisez la base de données :
- mysql -u root -p
- mysql> create database wp2;
- mysql> quit
- mysql -u root -p wp2 < wp_db.sql
4- Permission et configuration de Git :
- chown www-data:www-data -R DevCampUTM
- chmod -R 755 DevCampUTM
- chmod 600 DevCampUTM/wp-config.php
- cd DevCampUTM
- git init
- git config user.name "your_name"
- git config user.email "your_email"

Maintenant vous pouvez accéder à la page d'acceuil du projet via http://localhost/DevCampUTM . Pour accèdez à la page d'administation passez par : http://localhost/DevCampUTM/wp-admin
Login : root
Password : admin

# Your First Push

Si vous avez un compte github faites :
- git add remote github https://github.com/vaytess/DevCampUTM.git
Si vous avez un accès SSH :
- git add remote github git@github.com:vaytess/DevCampUTM.git
Ensuite après modification des sources, vous pouvez les pousser vers github comme suit :
- git add .
- git commit -m "your comment here"
- git push github master

# TODO :
- Préparation du menu
- Préparation des pages et articles
- Préparation du contenus des pages et articles
- Élaborer un slideshow au niveau du header du site.
- Positionnement du logo
- Adaptation du design (template, css,..) aux changements prévus.
- ...

Merci d'améliorer le README et d'ajouter ce qui manque pour la TODO list..
