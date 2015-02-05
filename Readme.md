Kiita - Qiita Modoki on PHP
====

Welcome to Kiita
----
これは任意のWebサーバ上で[Qiita](http://qiita.com/)もどきを実現するphpライブラリです。
[GitHub](https://github.com/K-atc/Kiita)で公開しています。

サーバ上のMarkdownファイルに対する動作例→[sample.md](http://katc.sakura.ne.jp/Kiita/?file=sample.md) [DEMO]

[投稿記事一覧](http://katc.sakura.ne.jp/Kiita/?list)

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

php-markdownを利用するために、kiita/processor.phpで次のようにinclude_onceされるようになっています。
```php
include_once dirname(__FILE__) . '/../vendor/php-markdown/php-markdown.php';
use \Michelf\MarkdownExstra;
```

How to use
----
付属のindex.phpが最も参考になると思います。

> **重要：** 必ず表示させるファイルのパス名をチェックするようにしてください。
> phpのファイルオープンはネットワーク上のリソースも対象とされています。

まずライブラリを読み込みます。

```php
include './kiita/processor.php';
use \Katc\Kiita;
```

Markdownファイルをそのまま表示させたいときは、Kiita::raw()を使用します。

```php 
$processor = new Kiita();
$html = $processor->raw($md_source_file_path);
```
厳密には、htmlファイルのpreタグの中で表示されるようになっています。

Markdownを変換したいときは、まずKiita::render()でbodyを取得します。
必要に応じてインデックスに登録して「投稿記事一覧」に表示されるようにするといいかもしれません。
Kiita::render()はoutput（HTMLのソース）とtitle（h1のtextContent）を含むオブジェクトを返します。
```php 
$rendered = $processor->render($md_source_file_path);
$processor->addIndex($md_source_file_path, $rendered->title);
```

出力するHTMLファイルのtitleを指定することができます。
Kiita::convert()で先に取得したbodyをHTMLファイルに流し込みます。
```php 
$processor->document_title = $rendered->title;
$html = $processor->convert($rendered->output);
```

変換結果をKiita::chache()で保存して次回以降の表示を最適化できます。
```php
$processor->chache($md_source_file_path, $html);
```

TODO
----
### ファイル名を出す拡張形式は…

```ruby: test.rb 
puts "ヾﾉ*＞ㅅ＜)ﾉｼ"
```
