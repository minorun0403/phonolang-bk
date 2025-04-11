FROM php:8.3-fpm

# 必要な環境変数を設定
ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer \
  PATH="/var/www/node_modules/.bin:$PATH"

# Composer のインストール
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# 必要なパッケージのインストール
RUN apt-get update && \
  apt-get -y install --no-install-recommends git unzip libzip-dev libicu-dev libonig-dev curl && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-install intl pdo_mysql zip bcmath

# Node.js と npm のインストール
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs
RUN npm install -g npm

WORKDIR /var/www/phonolang

# npm のキャッシュクリア
RUN npm cache clean --force

# package.json の作成
RUN npm init -y

# Tailwind CSS 関連のパッケージをインストール
RUN npm install -D tailwindcss postcss autoprefixer

# インストール後の確認
RUN ls -la node_modules/.bin

# php.ini のコピー
COPY ./php.ini /usr/local/etc/php/php.ini
