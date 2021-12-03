### 益得毛巾工廠
#### 環境設置

1. 將 php.ini 內 memory_limit 改成 2G

2. 輸入以下程式碼
    ```
    composer install
    ```
3. 複製 .env.example檔案為 .env

4. 輸入以下程式碼
    ```
   php artisan key:generate
    ```
5. 資料庫名稱
    > EDearTextile
            >
6. 導入php extension-mysql_xdevapi  
    [mysql_xdevapi](https://pecl.php.net/package/mysql_xdevapi)  
7. 導入php extension-mongodb  
    [mongodb php7.2以前](https://pecl.php.net/package/mongodb/1.5.2/windows)  
    [mongodb php7.3以後](https://pecl.php.net/package/mongodb/1.11.1/windows)  
#### 問題解決串
1. 遇到 "Target class [xxxSeeder] does not exist. 解決辦法"
> composer dump-autoload

   


