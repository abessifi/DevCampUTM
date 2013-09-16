# Prérequis :
Les packages apache2 mysql-server php5 php5-mysql et git doivent être installer.
Installion des packages la fimille Debian : #apt-get install apache2 mysql-server php5 php5-mysql git
NB : le login et le mot de passe doivent être réspectivement root et admin.
mysql_user = root (default)
mysql_password = admin (requested durant mysql server installation)


# Installation des sources :
1- Créez un répertoire sous /var/www/ et nommez le DevCampUTM
2- Maintenant clonez le projet :
  $ cd /var/www/DevCampUTM
  si vous avez un compte github faite :
  $ git clone https://github.com/vaytess/DevCampUTM.git
  si vous avez un accès SSH faite :
  $ git clone git@github.com:vaytess/DevCampUTM.git
3- Initialisez la base de données :
  $ mysql -u root -p
  mysql> create database wp2;
  mysql> quit
  $ mysql -u root -p wp2 < wp_db.sql
  $ chown www-data:www-data -R DevCampUTM
  $ chmod -R 755 DevCampUTM
  $ chmod 600 DevCampUTM/wp-config.php

Maintenant vous pouvez accéder à la page d'acceuil du projet via http://localhost/DevCampUTM
Pour accèdez à la page d'administation passez par : http://localhost/DevCampUTM/wp-admin
Login : root
Password : admin

# TODO :
- Préparation du menu
- Préparation des pages et articles
- Préparation du contenus des pages et articles
- Élaborer un slideshow au niveau du header du site.
- Positionnement du logo
- Adaptation du design (template, css,..) aux changements prévus.
- ...

Merci d'améliorer le README et d'ajouter ce qui manque..
