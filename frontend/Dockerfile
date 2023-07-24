FROM ubuntu
ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt install -y curl git
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash \
    && apt install -y nodejs

WORKDIR /app
RUN git clone https://github.com/ka1x/board-game-frontend
WORKDIR /app/board-game-frontend

RUN npm install
RUN npm -g install next
CMD npm run dev