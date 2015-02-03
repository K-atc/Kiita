Welcome to Kiita
====

Kiitaへようこそ
----
これは任意のWebサーバ上でQiitaもどきを実現するphpライブラリです。

サーバ上のMarkdownファイルに対する動作例→[sample.md](./processor.php?file=sample.md)

サンプル
----
### Usage without an autoloader

If you cannot use class autoloading, you can still use `include` or `require` 
to access the parser. To load the `\Michelf\Markdown` parser, do it this way:

	require_once 'Michelf/Markdown.inc.php';

Or, if you need the `\Michelf\MarkdownExtra` parser:

	require_once 'Michelf/MarkdownExtra.inc.php';

While the plain `.php` files depend on autoloading to work correctly, using the
`.inc.php` files instead will eagerly load the dependencies that would be 
loaded on demand if you were using autoloading.

###

Pull requests for fixing bugs are welcome. Proposed new features are
going meticulously reviewed -- taking into account backward compatibility, 
potential side effects, and future extensibility -- before deciding on
acceptance or rejection.

If you make a pull request that includes changes to the parser please add 
tests for what is being changed to [MDTest][] and make a pull request there 
too.

 [MDTest]: https://github.com/michelf/mdtest/