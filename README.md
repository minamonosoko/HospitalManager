# portfolio

## 開発環境
OS : macOS 14.0  
php : 8.2.11


## 実行の手順
1. クローンする。
    ```
    git clone https://github.com/minamonosoko/HospitalManager.git
    ```
2. portfolioディレクトリに移動する。
    ```
    cd ./portfolio
    ``````
3. データベースのマイグレーションを実行する。  
    実行後、database.sqliteの作成を促す選択肢が現れるのでYesを選択する。
    ```
    php artisan migrate
    ```
4. Seederを実行する。
    ```
    php artisan db:seed
    ```
5. サーバーを起動する。
    ```
    php artisan serve
    ```
6. Webブラウザでアクセスする。  
    http://localhost:8000