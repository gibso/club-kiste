FROM php:7.0-cli

COPY . /usr/src/kiste
WORKDIR /usr/src/kiste

# install needed packages
RUN apt-get update
RUN apt-get install -y git gnupg zip unzip

# install nodejs
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
RUN apt-get install -y nodejs

# install bower
RUN npm install -g bower

# install php pdo extension
RUN docker-php-ext-install pdo pdo_mysql

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

# dont run composer or bower as root
RUN useradd -ms /bin/bash symfony
RUN chown -R symfony:symfony /usr/src/kiste
USER symfony

# run composer install
RUN php composer.phar install

# run bower install
RUN bower install

CMD php bin/console doctrine:schema:update --force && \
    php bin/console server:run 0.0.0.0:8000