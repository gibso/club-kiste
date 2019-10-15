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
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
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