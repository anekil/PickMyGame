FROM ubuntu
ARG DEBIAN_FRONTEND=noninteractive

WORKDIR /app
COPY backend_app .

RUN apt-get update && apt install -y lsb-release gnupg2 ca-certificates apt-transport-https software-properties-common && add-apt-repository ppa:ondrej/php
RUN apt-get update && apt-get install -y php8.2 php8.2-intl php8.2-mbstring php8.2-xml composer curl
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install symfony-cli

###> recipes ###
###< recipes ###

RUN composer require amphp/http-client:^4.2.1
CMD symfony server:start