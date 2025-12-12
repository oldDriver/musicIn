# syntax=docker/dockerfile:1
FROM php:8.3-apache
# Set the working directory in the container
WORKDIR /var/www

# Copy your PHP application code into the container
COPY ./project/ .
RUN rm /etc/apache2/sites-available/000-default.conf
COPY ./docker/apache /etc/apache2/sites-enabled

RUN chown -R www-data:www-data .
# Install PHP extensions and other dependencies
RUN apt-get update && \
    apt-get install -y libpng-dev && \
    docker-php-ext-install pdo pdo_mysql gd

RUN apt-get update \
    && apt-get install -qq -y --no-install-recommends \
    cron \
     vim \
     locales coreutils apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev;

RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql mysqli gd opcache intl zip calendar dom mbstring zip gd xsl && a2enmod rewrite
RUN pecl install apcu && docker-php-ext-enable apcu

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

#RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
#    install-php-extensions amqp


# Expose the port Apache listens on
EXPOSE 80

# Start Apache when the container runs
CMD ["apache2-foreground"]
