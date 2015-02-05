Kiita - Qiita Modoki on PHP
====

Welcome to Kiita
----
これは任意のWebサーバ上で[Qiita](http://qiita.com/)もどきを実現するphpライブラリです。
[GitHub](https://github.com/K-atc/Kiita)で公開しています。

サーバ上のMarkdownファイルに対する動作例→[sample.md](http://katc.sakura.ne.jp/Kiita/?file=sample.md)

Dependency
----
index.phpと同じディレクトリにvenderディレクトリを作り、
その中に[php-markdown](https://michelf.ca/projects/php-markdown/)を設置してください。

以下に、設置方法を示します。
```bash
$ cd Kiita
$ mkdir vendor
$ cd vendor
$ git clone https://github.com/michelf/php-markdown.git
```

include_onceを容易にするために、php-markdownの直下に以下の内容のファイル(php-markdown.php)を置くと捗ります。
```php
include_once dirname(__FILE__) . '/Michelf/MarkdownInterface.php';
include_once dirname(__FILE__) . '/Michelf/Markdown.php';
include_once dirname(__FILE__) . '/Michelf/MarkdownExtra.php';
```

php-markdownを利用するために、kiita/processor.phpで次のようにinclude_onceされます。
```php
include_once dirname(__FILE__) . '/../vendor/php-markdown/php-markdown.php';
use \Michelf\MarkdownExstra;
```

How to use
----
**TODO**

TODO
----
### 記事一覧



### ファイル名を出す拡張形式は…

```ruby: test.rb 
puts "ヾﾉ*＞ㅅ＜)ﾉｼ"
```
