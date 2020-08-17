FROM webdevops/php-apache-dev:7.4-alpine
RUN apk add php-mysqli
WORKDIR /app
