#!/bin/bash
set -e

service mariadb start
sleep 3

# Popular tabelas de timezone do MariaDB
mysql_tzinfo_to_sql /usr/share/zoneinfo | mysql -u root mysql 2>/dev/null || true

mysql -u root <<EOF
CREATE DATABASE IF NOT EXISTS bancaesportiva CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'bancauser'@'localhost' IDENTIFIED BY 'banca123';
CREATE USER IF NOT EXISTS 'bancauser'@'127.0.0.1' IDENTIFIED BY 'banca123';
GRANT ALL PRIVILEGES ON bancaesportiva.* TO 'bancauser'@'localhost';
GRANT ALL PRIVILEGES ON bancaesportiva.* TO 'bancauser'@'127.0.0.1';
FLUSH PRIVILEGES;
EOF

if [ -f /var/www/html/database.sql ]; then
    mysql -u root bancaesportiva < /var/www/html/database.sql
    echo "SQL importado"
fi

apache2-foreground
