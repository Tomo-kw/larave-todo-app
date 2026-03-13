# Laravel TODO アプリ（スキルマップ学習用）

## 概要

Laravel を使用したシンプルな TODO アプリケーション。  
スキルマップの学習・検証を目的として作成した。

以下の内容を実装・確認した。
- Laravel フレームワークの基本構造
- Eloquent ORM
- サービスコンテナ（Dependency Injection）
- ミドルウェア
- Docker を使った開発環境構築
- Web / DB / Cache / Mail サーバの構成確認

アプリケーションは Docker 上で動作する。

---

# システム構成
Browser<br>
　↓<br>
nginx<br>
　↓<br>
php-fpm<br>
　↓<br>
Laravel<br>
　↓<br>
MySQL<br>
　↓<br>
Redis（キャッシュ）<br>
　↓<br>
Mailpit（メール確認）<br>


---

# 使用技術

- Laravel
- PHP-FPM
- Nginx
- MySQL
- Redis
- Mailpit
- Docker
- Docker Compose

---

# アプリケーション機能

## TODO 管理

- Todo 作成
- Todo 一覧表示
- Todo 更新
- Todo 削除

---

## Eloquent ORM

- User と Todo のリレーションを定義
- User 1 --- N Todo

```php
Todo::with('user')->get();
```

## サービスコンテナ（DI）
Todo の処理ロジックを TodoService に分離し、
Controller に依存注入して使用。

### 目的
- Controller の責務を軽くする
- 保守性を高める

## ミドルウェア
リクエスト処理時間をログ出力するミドルウェアを実装。

### 用途
- 処理時間計測
- ログ
- 認証
- 共通処理

## Docker 環境

docker-compose により以下のサービスを構築。
| サービス | 役割 |
| ---- | ---- |
| nginx | Webサーバ |
| php-fpm | PHP実行環境 |
| mysql | データベース |
| redis | キャッシュ |
| mailpit | メール確認 |


### 起動方法
`docker compose up -d --build`

### アクセス
- アプリ
  - http://localhost:8080
- Mailpit
  - http://localhost:8025

### サーバ動作確認
各サーバのログを確認して動作を検証。

#### Web サーバ（nginx）
`docker compose logs nginx`
アクセスログが出力されることを確認。

####DBサーバ（MySQL）
`docker compose logs mysql`

確認ログ
`mysqld: ready for connections`

#### Cache サーバ（Redis）
`docker compose logs redis`
確認ログ
`Ready to accept connections`

Laravel 側ではキャッシュとして Redis を利用。
```PHP
Cache::remember('todos', 60, function () {
    return Todo::with('user')->get();
});
```

#### Mail サーバ（Mailpit）
`docker compose logs mailpit`

メール確認
`http://localhost:8025`

# Laravel 実装内容
## Eloquent
- Model 定義
- Relationship
- Eager Loading

## サービスコンテナ
- DI による依存解決
- bind / singleton の確認

## ミドルウェア
- リクエスト処理時間のログ出力

# スキルマップ対応
| 項目 | 実施内容 |
| ---- | ---- |
| Laravel(2) | Eloquent / サービスコンテナ / ミドルウェア |
| Webサーバ | nginx 設定ファイル（default.conf） |
| DBサーバ | MySQL コンテナ構築 / 接続確認 |
| Cacheサーバ | Redis キャッシュ |
| Mailサーバ | Mailpit SMTP |
| Docker(2) | docker-compose / Dockerfile / 複数サービス構成

# 学んだこと

- nginx は PHP を直接実行せず php-fpm に FastCGI で処理を渡す
- Docker により Web / DB / Cache / Mail 環境を簡単に再現できる
- DI により Controller の責務を分離できる
- Redis はキャッシュ用途として利用する
- Mailpit によりローカルでメール送信確認ができる