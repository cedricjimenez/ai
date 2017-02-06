<?php

$dockmeConfig = [
    'active' => true,
    'name' => 'ai',
    'services' => [
        'memcahed',
        'redis',
        'mysql',
        'php-fpm',
        'nginx'
    ]
];



if ($dockmeConfig['active']) {
    echo '
###############################################################################
#                          Generated on phpdocker.io
# To run : php docker-compose.php | sudo docker-compose -f - up -d
###############################################################################

' . $dockmeConfig['name'] . '-memcached:
  image: phpdockerio/memcached:latest
  container_name: ' . $dockmeConfig['name'] . '-memcached

' . $dockmeConfig['name'] . '-redis:
  image: phpdockerio/redis:latest
  container_name: ' . $dockmeConfig['name'] . '-redis

' . $dockmeConfig['name'] . '-mysql:
  image: mysql:5.7
  container_name: ' . $dockmeConfig['name'] . '-mysql
  environment:
    - MYSQL_ROOT_PASSWORD=%C3dr1c%
    - MYSQL_DATABASE=aidb
    - MYSQL_USER=aiadmin
    - MYSQL_PASSWORD=%C3dr1c%

' . $dockmeConfig['name'] . '-webserver:
  image: phpdockerio/nginx:latest
  container_name: ' . $dockmeConfig['name'] . '-webserver
  volumes:
      - ..:/var/www/ai
      - ./nginx/nginx.conf:/etc/nginx/conf.d/default.conf
  ports:
   - "8383:80"
  links:
   - ' . $dockmeConfig['name'] . '-php-fpm

' . $dockmeConfig['name'] . '-php-fpm:
  build: .
  dockerfile: php-fpm/Dockerfile
  container_name: ' . $dockmeConfig['name'] . '-php-fpm
  volumes:
    - ..:/var/www/ai
    - ./php-fpm/php-ini-overrides.ini:/etc/php5/fpm/conf.d/99-overrides.ini
  links:
    - ' . $dockmeConfig['name'] . '-memcached
    - ' . $dockmeConfig['name'] . '-mysql
    - ' . $dockmeConfig['name'] . '-redis
';
}