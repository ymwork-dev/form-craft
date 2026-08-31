# form-craft

このリポジトリは、laravelを利用したお問い合わせフォームアプリです。
元々は学習用教材をベースに作成したアプリですが、ポートフォリオ公開にあたり
コードベース全体を修正、機能の追加、配色・フォントなどのデザイン刷新を行いました。


## 環境構築

#### リポジトリをクローン

```
git clone git@github.com:ymwork-dev/form-craft.git
```

#### ディレクトリの移動

```
cd form-craft/src
```

#### .env ファイルの作成

```
cp .env.example .env
```

#### .env ファイルの修正

```
DB_CONNECTION=mysql
DB_HOST=form-craft-db
DB_PORT=3306
DB_DATABASE=form_craft_db
DB_USERNAME=root
DB_PASSWORD=password
```

#### ディレクトリの移動

```
cd ..
```

#### コンテナの起動

```
docker compose up -d
```

#### PHPライブラリのインストール

```
docker compose exec -u 1000 php composer install
```

### キー生成

```
docker compose exec php php artisan key:generate
```

#### 権限の付与

```
docker compose exec php chmod -R 777 storage bootstrap/cache
```

#### マイグレーション・シーディングを実行

```
docker compose exec -u 1000 php php artisan migrate --seed
```

## 使用技術（実行環境）

フレームワーク: Laravel 13.4.0x

言語：PHP 8.3

Webサーバー：Nginx 1.21.1

データベース：mySQL 8.0.26

## ER図

![ER図](FormCraft.drawio.png)

## URL

アプリケーション：http://localhost:8081/

phpMyAdmin：http://localhost:8080


