## Laravelのインストール

同一の階層に
 「template-3rd-study」
 「template-3rd-study-env」
をcloneする（必要に応じてfork）

template-3rd-study-envに移動し、
```docker-compose up -d```
appコンテナにログイン
```
rm -fr ./*
composer create-project --prefer-dist laravel/laravel blog "6.*"
mv ./blog/* ./

mv ./blog/.* ./
※若干エラーが出ますがOKです
　mv: cannot move './blog/.' to './.': Device or resource busy
　mv: cannot move './blog/..' to './..': Device or resource busy

rm -fr ./blog
```
ブラウザで
http://localhost/
にアクセスして、Laravelの画面が表示されたらOK
![image](https://user-images.githubusercontent.com/62699348/111896670-a08baf80-8a5e-11eb-8ff5-75f749928172.png)


.envファイルを修正する
※修正はdocker-compose.ymlを見て適切な値に変えてね
　どうしてもわからない人はgithubの.env.exampleを見ましょう

appコンテナにログイン
```php artisan migrate```

```
※実行結果がこんな感じになればOK
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table (0.06 seconds)
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table (0.04 seconds)
Migrating: 2019_08_19_000000_create_failed_jobs_table
Migrated:  2019_08_19_000000_create_failed_jobs_table (0.02 seconds)
```
