# Rese(店舗予約システム)
　飲食店の店舗情報を一覧形式で表示しており、会員登録を行うことにより店舗予約・お気に入り登録などの機能を利用できるようになっている。

## 作成した目的
　飲食店の予約を行う方法として、主に電話で店舗に連絡することが挙げられる。しかし、店舗の混雑時や準備時間・営業時間外など、対応が困難なタイミングも存在し、顧客側も予約対応可能な時間がわかりにくいと感じることも考えられる。
  これらの問題を解決するため、店舗予約システムを実装し、顧客側で予約登録・変更・キャンセルをwebページにて行えるようにした。これにより24時間予約可能となるため、店舗側は予約業務にかかわる人員負荷の軽減、顧客側は予約が容易に行いやすくなる。そのほかにデータ登録され、顧客もwebページにて確認できるため、予約のミスマッチのリスクが減少することが見込める。

##アプリケーションURL
・開発環境：http://localhost/
・phpMyadmin：http://localhost:8080/

##機能一覧
　　・会員登録機能
　　・ログイン機能
　　・予約登録機能
　　・予約内容変更機能
　　・予約キャンセル機能
　　・お気に入り登録・解除機能

##使用技術
・PHP8.3.0
・Lavavel8.83.27
・MySQL8.0.26

##テーブル設計
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

##ER図

##環境構築
Dockerビルド
1. git clone git@github.com:estra-inc/confirmation-test-contact-form.git
2. DockerDesktopアプリを立ち上げる
3. docker-compose up -d --build
