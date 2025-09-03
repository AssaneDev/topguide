#!/bin/bash

# Script de migration PHP 8.2 vers PHP 8.3
# À exécuter sur le serveur VPS avec sudo

echo "🚀 Début de la migration PHP 8.2 → PHP 8.3"

# 1. Arrêter les services
echo "🛑 Arrêt des services..."
sudo systemctl stop nginx
sudo systemctl stop php8.2-fpm

# 2. Sauvegarder la config PHP 8.2
echo "💾 Sauvegarde de la configuration PHP 8.2..."
sudo cp -r /etc/php/8.2 /etc/php/8.2.backup

# 3. Supprimer PHP 8.2
echo "🗑️ Suppression de PHP 8.2..."
sudo apt-get remove --purge php8.2* -y
sudo apt-get autoremove -y

# 4. Mettre à jour le système
echo "🔄 Mise à jour du système..."
sudo apt-get update

# 5. Installer PHP 8.3 avec extensions nécessaires
echo "⬇️ Installation de PHP 8.3..."
sudo apt-get install php8.3 php8.3-fpm php8.3-mysql php8.3-pdo php8.3-mbstring php8.3-xml php8.3-gd php8.3-curl php8.3-zip php8.3-intl php8.3-bcmath php8.3-soap php8.3-xsl php8.3-readline php8.3-common php8.3-cli -y

# 6. Vérifier l'installation
echo "✅ Vérification PHP 8.3..."
php8.3 --version
php8.3 -m | grep -i mysql

# 7. Configurer PHP-FPM 8.3
echo "⚙️ Configuration PHP-FPM 8.3..."
sudo sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/' /etc/php/8.3/fpm/php.ini
sudo sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 20M/' /etc/php/8.3/fpm/php.ini
sudo sed -i 's/post_max_size = 8M/post_max_size = 20M/' /etc/php/8.3/fpm/php.ini
sudo sed -i 's/max_execution_time = 30/max_execution_time = 300/' /etc/php/8.3/fpm/php.ini
sudo sed -i 's/memory_limit = 128M/memory_limit = 512M/' /etc/php/8.3/fpm/php.ini

# 8. Modifier nginx.conf pour PHP 8.3
echo "🌐 Mise à jour nginx.conf pour PHP 8.3..."
sudo sed -i 's/php8.2-fpm.sock/php8.3-fpm.sock/g' /etc/nginx/sites-available/default
sudo sed -i 's/php8.2-fpm.sock/php8.3-fpm.sock/g' /etc/nginx/sites-available/*

# 9. Mettre à jour le fichier nginx local du projet
echo "📝 Mise à jour du nginx.conf local du projet..."
sed -i 's/php8.2-fpm.sock/php8.3-fpm.sock/g' /var/www/topguide/nginx/ngnix.conf

# 10. Démarrer les services
echo "🚀 Démarrage des services..."
sudo systemctl enable php8.3-fpm
sudo systemctl start php8.3-fpm
sudo systemctl restart nginx

# 11. Tests finaux
echo "🧪 Tests finaux..."
sudo systemctl status php8.3-fpm
sudo systemctl status nginx
php8.3 -v
php8.3 -m | grep mysql

# 12. Vérification Laravel
echo "🐘 Test Laravel..."
cd /var/www/topguide
php8.3 artisan --version
php8.3 artisan config:cache
php8.3 artisan route:cache
php8.3 artisan view:cache

echo "✨ Migration terminée ! Testez votre site maintenant."
echo "📝 N'oubliez pas de mettre à jour le symlink si nécessaire :"
echo "   sudo ln -sf /usr/bin/php8.3 /usr/bin/php"