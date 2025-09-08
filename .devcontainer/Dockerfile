FROM php:7.1-cli

ARG DEBIAN_FRONTEND=noninteractive

# Corriger les dépôts obsolètes
RUN sed -i 's|deb.debian.org|archive.debian.org|g' /etc/apt/sources.list \
 && sed -i '/security.debian.org/d' /etc/apt/sources.list

# Installer outils système + extensions PHP
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libxml2-dev \
    libonig-dev \
    default-mysql-client \
    vim \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip intl mbstring xml opcache bcmath \
    && pecl install apcu-5.1.17 && docker-php-ext-enable apcu \
    && rm -rf /var/lib/apt/lists/*

# Installer Composer 1 (compatible Symfony 3.1)
RUN curl -sS https://getcomposer.org/installer | php -- --version=1.10.26 --install-dir=/usr/local/bin --filename=composer

# Créer un user non-root
ARG USER=vscode
ARG UID=1000
RUN useradd -m -u ${UID} ${USER} || true
USER ${USER}

WORKDIR /workspace
