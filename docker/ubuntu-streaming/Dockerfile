FROM ubuntu:noble


USER root
RUN apt update
RUN apt -y upgrade
RUN apt -y install libnginx-mod-rtmp
RUN mkdir /var/www/html/stream
RUN ln -s /etc/nginx/sites-available/rtmp /etc/nginx/sites-enabled/rtmp
RUN apt update
RUN apt -y upgrade
#RUN apt -y install libaio
RUN apt  -y install build-essential libpcre3 libpcre3-dev libssl-dev
RUN apt -y install ffmpeg
RUN apt -y install nginx
RUN apt -y install --fix-missing libonig-dev libfreetype6-dev libmcrypt-dev libpng-dev zlib1g-dev libxml2-dev \
                        libzip-dev libonig-dev graphviz openssl gnupg-utils libmcrypt4 libmcrypt-dev libssl-dev net-tools \
                        procps exiftool default-mysql-client vim
#COPY . .
EXPOSE 1935 8000 8080
CMD ["nginx", "-g", "daemon off;"]
