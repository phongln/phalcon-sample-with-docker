#FROM php:fpm
#
#LABEL maintainer="MilesChou <github.com/MilesChou>, fizzka <github.com/fizzka>"
#
#ARG PHALCON_VERSION=3.4.2
#ARG PHALCON_EXT_PATH=php7/64bits
#
#RUN set -xe && \
#        # Compile Phalcon
#        curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz && \
#        tar xzf ${PWD}/v${PHALCON_VERSION}.tar.gz && \
#        docker-php-ext-install -j $(getconf _NPROCESSORS_ONLN) ${PWD}/cphalcon-${PHALCON_VERSION}/build/${PHALCON_EXT_PATH} && \
#        # Remove all temp files
#        rm -r \
#            ${PWD}/v${PHALCON_VERSION}.tar.gz \
#            ${PWD}/cphalcon-${PHALCON_VERSION}
#
# Should place docker-compose and dockerfile in same place when COPY
#COPY docker-phalcon-* /usr/local/bin/

FROM mileschou/phalcon:fpm

RUN	\
	apt-get -y upgrade \
	&& apt-get update --fix-missing \
	&& apt-get install -y \
    git \
    curl \
    libxml2-dev \
    zlib1g-dev \
    libpng-dev \
    libpcre3-dev \
    libzip-dev \
    zip \
    --no-install-recommends \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        soap \
        zip \
        gd \
        mysqli \
        opcache \
        simplexml \
        xml \
        json \
        xmlrpc \
        xmlwriter \
        intl \
        bcmath \
    && cp /usr/local/bin/php /usr/bin/ \
    && rm -r /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/ \
    && ln -s /usr/bin/composer.phar /usr/bin/composer

WORKDIR /src

COPY . /src

RUN chmod 755 /src \
    && usermod -u 1000 www-data

ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"

RUN docker-phalcon-install-devtools \
    && composer install \
    && apt-get clean \
    && apt-get autoclean

CMD ["php-fpm"]