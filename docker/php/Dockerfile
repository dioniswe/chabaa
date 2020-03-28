# php:7.4-cli contains a debian buster image
FROM php:7.4-fpm

USER root
RUN apt-get update
RUN apt-get -y install  libonig-dev libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev zlib1g-dev libxml2-dev \
                        libzip-dev libonig-dev graphviz openssl gnupg-utils libmcrypt4 libmcrypt-dev libssl-dev net-tools \
                        procps

RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring xml json phar zip gd dom session
#zlib common
RUN docker-php-ext-enable pdo pdo_mysql mysqli mbstring xml json phar zip gd dom session
#zlib common

# adduser bibelkreis who will be the database user as well
RUN addgroup --gid 1001 bibelkreis
RUN adduser --uid 1001 --gid 1001 --home /home/bibelkreis bibelkreis
RUN adduser bibelkreis bibelkreis
RUN adduser bibelkreis www-data
RUN adduser www-data www-data

WORKDIR /var/www/bibelkreis
RUN pecl install redis-5.1.1 \
    && pecl install xdebug-2.8.1 \
    && docker-php-ext-enable redis xdebug
RUN chown -R www-data:www-data /var/www
# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#COPY --chown=www-data:www-data . /var/www/bibelkreis
# Change current user to www
#USER bibelkreis
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000


# ************************** ----------------- vsftpd --------------------*****************
#RUN apt-get -y install vsftpd && \
    # add sftp user and his directory for accessing recordings
    #addgroup sftpgroup && \
    #mkdir /recordings && \
    #chown root:root /recordings && \
    #adduser recordings -g sftpgroup -s /sbin/nologin && \
    #TODO alternativly for differing adduser version: adduser recordings  --shell=/bin/false --no-create-home
    #TODO add password (passwd recordings)
    ##sudo mkdir /recordings/recording && \
    ##chown recordings:sftpgroup /recordings/recordings && \
    # group for chrooting sftp user into its designated directory

    # TODO below statements will be probably better off using seperate containers with mounted config file volumes
  #modify /etc/ssh/sshd_conf and add following block (while uncommenting existing MatchBlock directive)
  #Subsystem      sftp    /usr/lib/openssh/sftp-server
  #Subsystem sftp internal-sftp
  #Match Group sftpgroup
  # Force the connection to use SFTP and chroot to the required directory.
  #ForceCommand internal-sftp
  #ChrootDirectory /recordings
  # Disable tunneling, authentication agent, TCP and X11 forwarding.
  #PermitTunnel no
  #AllowAgentForwarding no
  #AllowTcpForwarding no
  #X11Forwarding no


#***************************** php-config allowing upload of pastor's message and media **************************
  #modify php/cli/php.ini and php/fpm/php.ini, add
  #upload_max_filesize=128M
  #post_max_size=128M

  #modify /etc/nginx/nginx.conf, add to http block:
  #client_max_body_size 128M;


#  npm run websocket