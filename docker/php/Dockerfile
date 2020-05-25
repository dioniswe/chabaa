# php:7.4-cli contains a debian buster image
FROM php:7.4-fpm


ARG USER_ID
ARG GROUP_ID

USER root

# ************** STEP 1 extend image to add necessary libraries ****************** #
# step 1.1 install php extensions
RUN apt-get update
RUN apt-get -y install  libonig-dev libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev zlib1g-dev libxml2-dev \
                        libzip-dev libonig-dev graphviz openssl gnupg-utils libmcrypt4 libmcrypt-dev libssl-dev net-tools \
                        procps vim

RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring xml json phar zip gd dom session
RUN docker-php-ext-enable pdo pdo_mysql mysqli mbstring xml json phar zip gd dom session

# step 1.2 install xdebug pecl extension
RUN pecl install redis-5.1.1 \
    && pecl install xdebug-2.8.1 \
    && docker-php-ext-enable redis xdebug

RUN \
if [ -z ${XDEBUG_ENABLE} ]; then \
    echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=mertblog.net" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
;fi

# step 1.3 install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


#******** STEP 2 add user having same user id as php project-owning host user to ease development and deployment ******#
#*** see also https://jtreminio.com/blog/running-docker-containers-as-current-host-user/#ok-so-what-actually-works ****#
RUN if [ ${USER_ID:-0} -ne 0 ] && [ ${GROUP_ID:-0} -ne 0 ]; then \
    # step 2.1 add user and setup the php project directory
    # todo check if required to delete www-data? |||||||||| userdel -f chabaa &&\
    if getent group chabaa ; then groupdel chabaa; fi  &&\
    groupadd -g ${GROUP_ID} chabaa  &&\
    useradd -l -u ${USER_ID} -g chabaa chabaa &&\
    install -d -m 0755 -o chabaa -g chabaa /home/chabaa &&\
    install -d -m 0755 -o chabaa -g chabaa /var/www/chabaa \
#
    # step 2.2 setup permissions for php project directory
#    chown --changes --silent --no-dereference --recursive \
 #       --from=33:33 ${USER_ID}:${GROUP_ID} \
  #      /.composer \
   #     /var/run/php-fpm \
    #    /var/lib/php/sessions \

;fi
#TOOO handle case when no USER_ID has been given
USER chabaa
# Change current user to chabaa
WORKDIR /var/www/chabaa
# Expose port 9000 and start php-fpm server
EXPOSE 9000

COPY ./docker/php/startup.sh /usr/local/bin/startup.sh
USER root
RUN chmod g+x,o+x /usr/local/bin/startup.sh
USER chabaa
CMD [ "/usr/local/bin/startup.sh"]
