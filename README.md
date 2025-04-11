
# Phonolang


## セットアップ手順

### GitHubからクローン
```bash
$ git clone <リポジトリURL>
```

### `.env` ファイルの設定
`.env.example` を `.env` にコピーし、必要な環境設定
```bash
$ cd /path/to/your/workspace/
$ cp .env.example .env
```
その後、`.env` ファイルを開き、データベース設定など必要な環境情報を記入

### Dockerコンテナの立ち上げ
以下のコマンドでDockerコンテナをバックグラウンドで起動します。
```bash
$ docker compose up -d
```

### コンテナに接続
次に、PHPコンテナに接続します。
```bash
$ docker compose exec php bash
```

### コンテナに接続
```bash
$ cd /var/www/phonolang
$ composer install
```
※/var/www/phonolang配下に、venderディレクトリが作成されている事

### Laravelの設定
Laravelの初期設定を行います。

```bash
$ cd /var/www/phonolang
$ php artisan key:generate
$ php artisan storage:link
$ php artisan migrate
```

### Tailwind CSSのセットアップ
Tailwind CSSをインストールし、設定を行います。
```bash
$ cd /var/www/phonolang
$ npm install -D tailwindcss postcss autoprefixer
$ npx tailwindcss init
```
