# portfolio

## 開発環境
OS : macOS 14.0  
php : 8.2.11  
Laravel : 10.28.0  
Composer : 2.6.5

## 実行の手順（macOS）
### 環境構築
1. Homebrewのインストール  
    以下のURLからインストール用のスクリプトをコピーし、ターミナルで実行する。
    ```
    https://brew.sh
    ```
2. PHPのインストール
    ```
    brew install php
    ```
3. Composerのインストール
    ```
    brew install composer
    ```
4. Node.jsのインストール
    ```
    brew install node
    ```

### プロジェクトの設定
1. クローンする。
    ```
    git clone https://github.com/minamonosoko/HospitalManager.git
    ```
2. portfolioディレクトリに移動する。
    ```
    cd ./HospitalManager/portfolio
    ``````
3. ライブラリのインストール
    ```
    composer install
    ```
4. .envファイルの作成
    ```
    cp ./.env.example ./.env
    ```
5. .envファイルの加筆修正
    ```
    vim ./.env
    ```

    編集箇所
    ```
    # 修正前
    4 APP_DEBUG=true
    11 DB_CONNECTION=mysql
    12 DB_HOST=127.0.0.1
    13 DB_PORT=3306
    14 DB_DATABASE=laravel
    15 DB_USERNAME=root
    16 DB_PASSWORD=

    # 修正後
    4 APP_DEBUG=false           # true -> false
    11 DB_CONNECTION=sqlite     # mysql -> sqlite
    # 12 DB_HOST=127.0.0.1      # コメントアウト
    # 13 DB_PORT=3306           # コメントアウト
    # 14 DB_DATABASE=laravel    # コメントアウト
    # 15 DB_USERNAME=root       # コメントアウト
    # 16 DB_PASSWORD=           # コメントアウト
    ```
6. アプリケーションキーの初期化
    ```
    php artisan key:generate
    ```

7. データベースのマイグレーションを実行する。  
    ```
    php artisan migrate
    ```
    実行後、database.sqliteの作成を促す選択肢が現れるのでカーソルキーでYesを選択してEnterキーを押下する。
8. Seederを実行する。
    ```
    php artisan db:seed
    ```
9. JSとCSSのビルド
    ```
    npm install && npm run build
    ```
10. サーバーを起動する。
    ```
    php artisan serve
    ```
11. Webブラウザでアクセスする。  
    http://localhost:8000