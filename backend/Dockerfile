FROM ubuntu
ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y lsb-release gnupg2 ca-certificates apt-transport-https software-properties-common curl mc \
    && add-apt-repository ppa:ondrej/php
RUN apt-get install -y php8.2 php8.2-intl php8.2-mbstring php8.2-xml php8.2-gd php8.2-pdo-pgsql php8.2-pgsql php8.2-curl php-json composer \
    && curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
    && apt install symfony-cli \
    && apt-get clean

WORKDIR /app

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

CMD symfony server:start