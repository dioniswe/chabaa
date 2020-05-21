FROM node:current-buster-slim

WORKDIR /usr/src/app

#COPY package*.json ./
USER root
RUN npm install node-media-server
RUN apt-get update
RUN apt-get install -y ffmpeg bash vim-tiny
RUN mkdir /media/streams

#COPY . .

EXPOSE 1935 8000

CMD ["node","app.js"]