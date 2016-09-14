FROM phpdockerio/php56-fpm:latest


# Install phalcon
RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 1E569794 \
    && echo "deb http://ppa.launchpad.net/phalcon/stable/ubuntu wily main" > /etc/apt/sources.list.d/phalcon.list \
    && apt-get update \
    && apt-get install php5-phalcon \
    && php5enmod phalcon \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR "/var/www/ai"