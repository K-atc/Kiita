PHP 覚書
====

### 配列を要素数を数える: count

### json_encodeのオプション
* 出典： http://php.net/manual/ja/json.constants.php
* JSON_UNESCAPED_UNICODE 
:	Unicodeをエスケープしない
* JSON_UNESCAPED_SLASHES
:	スラッシュをエスケープしない
* 複数使いたいときは $options = （使いたいオプション1）＋（使いたいオプション2）

### キャストを用いたスマートな方法
* nullを配列型にキャストすると空配列になる：(array) null //=> []

### ヒアドキュメント構文
<<<を開始記号としてトークンから同じトークンまでの文字列を文字列リテラルとして扱える。
トークンの直後に空白を入れると<<が云々エラーが出るので注意。
インデントはしてはいけない。
詳しくは [PHP: 文字列 - Manual](http://php.net/manual/ja/language.types.string.php)

```php
$md_source = <<<HERE
てすとまーくだうん
===
it works
HERE;
```