<?php

	define ('SERVICE', 'Exif情報');				// サービス名

	// テスト環境と本番環境の切り替え
	if(stristr($_SERVER["HTTP_HOST"], "test")){
		define('HOME_URL', 'http://test.hanak.in/exif/');
		define('DOC_ROOT', '/var/www/test/hanak.in/exif/');
	}else{
		define('HOME_URL', 'http://hanak.in/exif/');
		define('DOC_ROOT', '/var/www/site/hanak.in/exif/');
	}

	// ディレクトリ設定
	define ('SRC_DIR'     , DOC_ROOT . 'src/');					// プログラムソース
	define ('LIB_DIR'     , SRC_DIR . 'lib/');						// クラスライブラリ
	define ('PAGE_DIR'    , SRC_DIR . 'page/');					// ページソース
	define ('SMARTY_DIR'  , '/usr/local/lib/Smarty-v.e.r/libs/');			// 設置したSmarty本体へのパスを設定します(絶対パス)

	// URL設定
	define ('CSS_URL'	  , './css/');						// CSSファイルへのURLパス
	define ('JS_URL'	  , './js/');						// JavascriptファイルへのURLパス
	define ('IMG_URL'	  , './img/');						// イメージファイルへのURLパス

	// Smarty 関連
	require_once SMARTY_DIR . 'Smarty.class.php';
	$smarty = new Smarty();
	$smarty->template_dir = './src/templates/';					// テンプレート
	$smarty->compile_dir  = './src/templates_c/';				// コンパイル済みテンプレート

	// URLパラメータの取得
	$method = $_SERVER['REQUEST_METHOD'];					// メソッドの取得
	if( strtoupper( $method ) == "POST" )	$param = $_POST;
	else				$param = $_GET;

	// グローバル変数の初期化
	$user_id = 0;
	$err = $_SESSION['err'];
	$message1 = $_SESSION['message1'];
	$message2 = $_SESSION['message2'];

	// サービス名
	$service = "index";
	if( isset($param["sv"]) ){
		$service = $param[ "sv" ];
	}

	// ページ名
	$page = "index";
	if( isset($param["pg"]) ){
		$page = $param[ "pg" ];
	}

	// モード
	$mode = 0;
	if( isset($param["md"]) ){
		$mode = $param[ "md" ];
	}

	// ページファイル名を生成
	$sv_pg = $service . '_' . $page;

	//リダイレクトURL
	$redirect_url = NULL;

	// テンプレートの変数
	$smarty->assign('home_url'	, '/' . $service . '/');				// ホームURL
	$smarty->assign('css_url'	, CSS_URL);					// CSS URL
	$smarty->assign('js_url'	, JS_URL);					// JS URL
	$smarty->assign('img_url'	, IMG_URL);					// イメージURL
	$smarty->assign('service_name', SERVICE);					// サービス名
?>