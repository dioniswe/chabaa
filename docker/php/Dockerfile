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
                        procps

RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring xml json phar zip gd dom session
RUN docker-php-ext-enable pdo pdo_mysql mysqli mbstring xml json phar zip gd dom session

# step 1.2 install xdebug pecl extension
RUN pecl install redis-5.1.1 \
    && pecl install xdebug-2.8.1 \
    && docker-php-ext-enable redis xdebug

# step 1.3 install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


#******** STEP 2 add user having same user id as php project-owning host user to ease development and deployment ******#
#*** see also https://jtreminio.com/blog/running-docker-containers-as-current-host-user/#ok-so-what-actually-works ****#
RUN [ "echo", "$USER_ID" ]
RUN [ "echo", "$GROUP_ID" ]
RUN [ "echo", "${USER_ID}" ]
RUN [ "echo", "${GROUP_ID}" ]
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
# Change current user to chabaa
USER chabaa
WORKDIR /var/www/chabaa
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