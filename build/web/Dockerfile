FROM php:8.2-apache

# Update and Dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends locales apt-utils libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev zip unzip curl wget vim nano npm iproute2 traceroute iputils-ping apt-utils sudo;

# Install NPM
RUN npm install npm@latest -g && \
    npm install n -g && \
    n latest
    
# French language
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

# Install Composer
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
    mv composer.phar /usr/local/bin/composer

# Install Docker 
RUN curl -fsSL https://get.docker.com -o install-docker.sh && \
    sh install-docker.sh \
    && rm install-docker.sh
    
RUN echo "www-data ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

# PHP Extensions
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql gd opcache intl zip calendar dom mbstring zip gd xsl


