Grunt 覚書
====

初めて
---
1. 本家からnode.jsをインストール
1. gruntをグローバルインストール
npm install -g grunt-cli


個別ディレクトリ
----
### 基本
1. 一から始める場合
	npm init
	* 対話形式でパッケージの情報を決定できる。
	* package.jsonが生成される。
1. npm install grunt --save-dev
	「save-dev」オプションを付けているので、package.jsonに依存関係が追記されます。
	package.jsonがあれば、他の環境でも「npm install」とすれば同じようにモジュールがインストールされます。
1. Gruntflile.jsを作成する。grunt（またはgrunt default）で実行可能

### ファイル変更監視
( http://www.atmarkit.co.jp/ait/articles/1404/08/news033_2.html )

1. npm install grunt-contrib-watch --save-dev
1. initConfigにwatchタスク追加
1.  Gruntfile.jsに `grunt.loadNpmTasks('grunt-contrib-watch');` を追加
1.  「grunt watch」コマンドを実行すると、ファイルの監視が始まります。


gruntタスク
----
### JS Hint
* 参考： http://gaishimo.hatenablog.com/entry/2013/03/09/185054
* JSの構文チェッカー

#### インストール
npm install grunt-contrib-jshint --save-dev

#### .jshintrcの設定
* JS Hintのパラメータとなる。
* 設定のパラメータなどの説明はGoogle検索に任せる。

#### .jshintignoreの設定
* 外部ライブラリなど対象外のファイルを指定できる。

#### 有効化
grunt.loadNpmTasks('grunt-contrib-jshint');

### watch
* ファイルの変更を監視してタスクを実行してくれる

#### インストール
npm install grunt-contrib-watch --save-dev

#### 有効化
grunt.loadNpmTasks('grunt-contrib-watch');


### livereload
* 変更時にブラウザを自動的にリロードさせる。
* connect, watchが必要。
* watchパッケージにビルドインされている。

#### インストール
npm install grunt-contrib-connect  --save-dev

#### Gruntfile.js
##### grunt.initConfig
        // サーバースタート
        connect: {
            demo: {
                options: {
                    port: 9001,
                    // middleware: function(connect) {
                    //     return [lrSnippet, folderMount(connect, '.')];
                    // },
                    base: 'demo.html'
                }
            }
        },
        
##### grunt.initConfigのwatchオプションに追加
            html_files: {
                files: ['**/*.html'],
                tasks: [],
            },
            options: {
                livereload: true,
                spawn: false,
            },
            
##### タスクを更新
grunt.registerTask('default', ['connect','watch']);            


### ChromeのLivereloadエクステンションをインストール
* Chrome Web Storeより


###  注意
* gruntのタスクをすでに実行中でそのタスクにconnectを追加する場合（上記の方法）、中止して再実行する必要あり。

#### Cannot GET /って出たんだけど...
 
