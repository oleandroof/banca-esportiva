#!/bin/bash
set -e

service mariadb start
sleep 3

mysql -u root <<EOF
CREATE DATABASE IF NOT EXISTS bancaesportiva CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'bancauser'@'localhost' IDENTIFIED BY 'banca123';
GRANT ALL PRIVILEGES ON bancaesportiva.* TO 'bancauser'@'localhost';
FLUSH PRIVILEGES;
EOF

if [ -f /var/www/html/database.sql ]; then
    mysql -u root bancaesportiva < /var/www/html/database.sql
    echo "SQL importado"
fi

apache2-foreground
