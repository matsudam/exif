<?php
/**
 * 「Exif情報表示」
 */

	try{ 
		include_once ('./src/initialization.php');
		include_once (LIB_DIR . 'common.php');
		require_once(LIB_DIR . 'pel/PelJpeg.php');
		
		// ページ処理
		$page_path = PAGE_DIR . $sv_pg . ".php";
		$result = include_once ($page_path);

		// テンプレート表示
		$template = $sv_pg . ".tpl";
		$smarty->display( $template );

	} catch (Exception $e){ 
		echo "エラー発生:" . $e->getMessage();
		exit();
	}

	// MySQLへの接続を閉じる
	$db->close();

?>
