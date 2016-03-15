# tmnt-hp-scraping
多摩NT学会のHPのニュース、活動報告、フォトギャラリーのスクレイピングを行うためのツールを開発。

# Seleniumの起動
```
java -jar /usr/local/bin/selenium-server-standalone-2.52.0.jar
```

# データのスクレイピング
- src/datas.php に読み取るデータの配列を作成
- test/ScTest.php にtest???()と言う関数を作成して、データを指定して$this->procList(CDatas::データ);を呼び出す
- 不要なtest関数は_をつけるなどして名前を変更
- ./vendor/bin/phpunit test で実行する
- ./results/result.jsonにデータが保存される。result.txtは可読化したもの

# リンクの変更
- php ./entry/photoconv.php を実行して、イメージへのリンクや改行コードなどを変更する
- ./results/result-photo.jsonが保存される。result-photo.txtは可読化したもの

# データの登録
- EntryTest.php が登録用のコード。必要な箇所を変更
- ./entry/categorymap.php にカテゴリーの対応がある。必要であれば修正
- ./vendor/bin/phpunit entry で実行する


# テストの実行
```
./vendor/bin/phpunit test
```
