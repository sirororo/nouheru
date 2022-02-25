# ビルド元のDockerイメージに、php:7.4-fpmを指定
FROM php:7.4-fpm
# php.iniをコンテナにコピーしたい場合はここに記述
COPY php.ini /usr/local/etc/php/









# RUN apt-get update && docker-php-ext-install pdo_mysql
RUN apt-get update && apt-get install -y \
    mariadb-client vim zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo_mysql \
    && apt-get clean
    

# conposerをインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /var/www/
