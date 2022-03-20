FROM php:7.3.4-fpm

ADD apt-list /opt/

RUN apt-get update \ 
	&& apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    	&& docker-php-ext-install -j$(nproc) gd \
   	&& docker-php-ext-install pdo_mysql \
	&& pecl install redis-4.3.0 \
	&& docker-php-ext-enable redis
   	# && docker-php-ext-install zip
		

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    	&& composer config -g repo.packagist composer https://packagist.phpcomposer.com \

