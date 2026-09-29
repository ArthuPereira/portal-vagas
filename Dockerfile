FROM php:8.2-apache

# Dependências do sistema e extensões PHP
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Habilita mod_rewrite no Apache
RUN a2enmod rewrite

# Ajusta configuração do Apache para permitir .htaccess (AllowOverride All)
RUN sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

# Ajusta limites de upload do PHP para suportar currículos
RUN echo "upload_max_filesize = 10M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 12M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini

# Copia Composer do container oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia arquivos de dependência primeiro para cache de camada Docker
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader || composer dump-autoload --optimize

# Copia todo o código-fonte da aplicação
COPY . /var/www/html/

# Symlink para compatibilidade retroativa com acessos que incluam /mvc-php
RUN ln -s /var/www/html /var/www/html/mvc-php

RUN mkdir -p /var/www/html/uploads/resumes \
    && chown -R www-data:www-data /var/www/html/uploads \
    && chmod -R 775 /var/www/html/uploads

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]
