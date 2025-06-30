#FROM ubuntu/nginx


#USER root
#RUN apt update
#RUN apt -y upgrade
#RUN apt -y install libnginx-mod-rtmp

#COPY . .

#EXPOSE 1935 8000

FROM tiangolo/nginx-rtmp

USER root
RUN mkdir /mnt/hls
RUN mkdir /var/www
RUN mkdir /var/www/stream
RUN mkdir /var/www/hls
RUN mkdir /var/www/html/
RUN mkdir /var/www/html/stream
RUN mkdir /var/www/html/stream/hls
RUN mkdir /etc/nginx/sites-available
RUN chmod -R 777 /var/www
RUN chmod -R 777 /mnt/hls
RUN chown -R www-data /mnt/hls
RUN chgrp -R www-data /mnt/hls
RUN mkdir /usr/local/nginx/html/live
RUN mkdir /usr/local/nginx/html/hls
RUN mkdir /etc/nginx/sites-enabled/
RUN ln -s /etc/nginx/sites-available/rtmp /etc/nginx/sites-enabled/rtmp
#COPY ./docker/php/startup.sh /usr/local/bin/startup.sh
RUN apt update
RUN apt -y upgrade
RUN apt -y install libaio1
RUN apt  -y install build-essential libpcre3 libpcre3-dev libssl-dev
RUN apt -y install ffmpeg

#RUN apt -y install libnginx-mod-rtmp
