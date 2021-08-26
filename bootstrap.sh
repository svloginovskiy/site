#!/usr/bin/env bash

apt-get update >/dev/null 2>&1
apt-get install -y apache2 >/dev/null 2>&1
perl -0777 -i -pe 's/\/var\/www\/>\n\tOptions Indexes FollowSymLinks\n\tAllowOverride None/\/var\/www\/>\n\tOptions Indexes FollowSymLinks\n\tAllowOverride All/igs' /etc/apache2/apache2.conf 
a2enmod rewrite
systemctl restart apache2
apt-get install -y mysql-server >/dev/null 2>&1
mysql -u root -e "USE mysql;CREATE USER 'vagrant'@'localhost' IDENTIFIED BY 'password';GRANT ALL PRIVILEGES ON *.* TO 'vagrant'@'localhost';UPDATE user SET plugin='auth_socket' WHERE User='vagrant';FLUSH PRIVILEGES;"
service mysql restart
apt-get install -y php >/dev/null 2>&1
apt-get install -y libapache2-mod-php >/dev/null 2>&1
apt-get install -y php-fpm php-mysql >/dev/null 2>&1
apt-get install -y htop >/dev/null 2>&1
apt-get install -y php-xdebug >/dev/null 2>&1
echo "xdebug.remote_enable=1" >> /etc/php/7.2/fpm/conf.d/20-xdebug.ini
echo "xdebug.remote_host=0.0.0.0" >> /etc/php/7.2/fpm/conf.d/20-xdebug.ini
echo "xdebug.remote_connect_back=1" >> /etc/php/7.2/fpm/conf.d/20-xdebug.ini
echo "xdebug.remote_port=9000" >> /etc/php/7.2/fpm/conf.d/20-xdebug.ini
service php7.2-fpm restart
service apache2 restart
if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi

