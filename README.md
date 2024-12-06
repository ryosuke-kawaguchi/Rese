# Rese(店舗予約システム)

　飲食店の店舗情報を一覧形式で表示しており、会員登録を行うことにより店舗予約・お気に入り登録などの機能を利用できるようになっている。

## 作成した目的

　飲食店の予約を行う方法として、主に電話で店舗に連絡することが挙げられる。しかし、店舗の混雑時や準備時間・営業時間外など、対応が困難なタイミングも存在し、顧客側も予約対応可能な時間がわかりにくいと感じることも考えられる。
  これらの問題を解決するため、店舗予約システムを実装し、顧客側で予約登録・変更・キャンセルをwebページにて行えるようにした。これにより24時間予約可能となるため、店舗側は予約業務にかかわる人員負荷の軽減、顧客側は予約が容易に行いやすくなる。そのほかにデータ登録され、顧客もwebページにて確認できるため、予約のミスマッチのリスクが減少することが見込める。

## アプリケーションURL

* 開発環境：http://localhost/
* phpMyadmin：http://localhost:8080/

## 機能一覧

* 会員登録機能
* ログイン機能
* 予約登録機能
* 予約内容変更機能
* 予約キャンセル機能
* お気に入り登録・解除機能

## 使用技術

* PHP8.3.0
* Lavavel8.83.27
* MySQL8.0.26

## テーブル設計

usersテーブル
|カラム名|型|PRIMARY KEY|UNIQUE KEY|NOT NULL|FOREIGN KEY|
|---|---|---|---|---|---|
|id|bigint| ○ |  |  |  |
|name|varchar(255)|  |  | | ○ |  |
|email|varchar(255)|  | ○ | ○ |  |
|email_verified|timestamp|  |  | ○ |  |
|password|varchar(255)|  |  |  |  |
|remember_token|varchar(255)|  |  |  |  |
|create_at|timestamp|  |  |  |  |
|update_at|timestamp|  |  |  |  |

reservesテーブル
|カラム名|型|PRIMARY KEY|UNIQUE KEY|NOT NULL|FOREIGN KEY|
|---|---|---|---|---|---|
|id|bigint| ○ |  |  |  |
|user_id|bigint|  |  |  | ○ |
|shop_name|varchar(255)|  |  | ○ |  |
|date|date|  |  | ○ |  |
|time|time|  |  | ○ |  |
|member|integer|  |  | ○ |  |
|created_at|timestamp|  |  |  |  |
|updated_at|timestamp|  |  |  |  |

favoritesテーブル
|カラム名|型|PRIMARY KEY|UNIQUE KEY|NOT NULL|FOREIGN KEY|
|---|---|---|---|---|---|
|id||bigint| ○ |  |  |  |
|user_id||bigint|  |  |  | ○ |
|shop_id||integer|  |  | ○ |  |
|created_at||timestamp|  |  |  |  |
|updated_id||timestamp|  |  |  |  |

## ER図
![ER図](docs/io.drawio.png)

## 環境構築
#### 1. 下記の構造でディレクトリを作成

```

Rese
├── docker
│   ├── mysql
│   │   ├── data
│   │   └── my.cnf
│   ├── nginx
│   │   └── default.conf
│   └── php
│       ├── Dockerfile
│       └── php.ini
├── docker-compose.yml
└── src
```

#### 2. docker-compose.ymlの作成

```
version: '3.8'

services:
    nginx:
        image: nginx:1.21.1
        ports:
            - "80:80"
        volumes:
            - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
            - ./src:/var/www/
        depends_on:
            - php

    php:
        build: ./docker/php
        volumes:
            - ./src:/var/www/

    mysql:
        image: mysql:8.0.26
        environment:
            MYSQL_ROOT_PASSWORD: root
            MYSQL_DATABASE: laravel_db
            MYSQL_USER: laravel_user
            MYSQL_PASSWORD: laravel_pass
        command:
            mysqld --default-authentication-plugin=mysql_native_password
        volumes:
            - ./docker/mysql/data:/var/lib/mysql
            - ./docker/mysql/my.cnf:/etc/mysql/conf.d/my.cnf

    phpmyadmin:
        image: phpmyadmin/phpmyadmin
        environment:
            - PMA_ARBITRARY=1
            - PMA_HOST=mysql
            - PMA_USER=laravel_user
            - PMA_PASSWORD=laravel_pass
        depends_on:
            - mysql
        ports:
            - 8080:80
```

#### 3. nginxの設定
./docker/nginxのdefault.confに、以下の設定を記述

```
server {
    listen 80;
    index index.php index.html;
    server_name localhost;

    root /var/www/public;

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
}
```

#### 4. PHPの設定
./docker/phpのDockerfileに以下の設定を記述

```
FROM php:7.4.9-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

WORKDIR /var/www
```

続いて.docker/phpのphp.iniファイルに以下の通り設定を記述

```
date.timezone = "Asia/Tokyo"

[mbstring]
mbstring.internal_encoding = "UTF-8"
mbstring.language = "Japanese"
```

#### 5. MySQLの設定
.docker/mysqlのmy.confに以下の設定を記述

```
[mysqld]
character-set-server = utf8mb4

collation-server = utf8mb4_unicode_ci

default-time-zone = 'Asia/Tokyo'
```
#### 6. docker-composeコマンドでビルド
以下をコマンドラインに入力
```
$ docker-compose up -d --build
```

#### 7. Laravelインストール
以下のコマンドで、phpコンテナへログイン
```
$ docker-compose exec php bash
```

次に、以下のコマンドでインストール
```
$ composer create-project "laravel/laravel=8.*" . --prefer-dist
```
