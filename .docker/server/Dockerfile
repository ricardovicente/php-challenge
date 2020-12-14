FROM wyveo/nginx-php-fpm:latest
WORKDIR /usr/share/nginx/
RUN rm /etc/nginx/conf.d/default.conf
COPY ./nginx.conf /etc/nginx/conf.d

RUN apt-get update && apt-get install bash
RUN rm -rf /usr/share/nginx/html
COPY . /usr/share/nginx
#RUN chmod -R o+w /usr/share/nginx/storage/*
#RUN chmod -R 777 /usr/share/nginx/storage/*
#RUN chmod -R o+w /usr/share/nginx/bootstrap/*
#RUN chmod -R 777 /usr/share/nginx/bootstrap/*
