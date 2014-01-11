<?php

	$err = $param["err"];
	$url = $param["url"];

	if($url && !$err){
		$url = str_replace(" ", "%20", $url);

		$jpeg = new PelJpeg($url);
		if( !$jpeg ) {$err = 1;}

		if(!$err){
			$app1 = $jpeg->getExif();
			if( !$app1 ) {$err = 2;}
		}

		if(!$err){
			$tiff = $app1->getTiff();
			if( !$tiff ) {$err = 3;}
		}

		if(!$err){
			$ifd = $tiff->getIfd();
			if( !$ifd ) {$err = 4;}
		}

		if(!$err){
			$exif = $ifd->getSubIfd(PelIfd::EXIF);
			if( !$exif ) {$err = 5;}
		}

	 	if(!$err){
			$data = array();

			if($ifd->getEntry(PelTag::MAKE))				$data['make']				=$ifd->getEntry(PelTag::MAKE)->getText(); // メーカー
			if($ifd->getEntry(PelTag::MODEL))				$data['model']				=$ifd->getEntry(PelTag::MODEL)->getText(); // モデル

			if($exif->getEntry(PelTag::PIXEL_X_DIMENSION))		$data['pixel_x_dimension']		=$exif->getEntry(PelTag::PIXEL_X_DIMENSION)->getText(); // 幅サイズ
			if($exif->getEntry(PelTag::PIXEL_Y_DIMENSION))		$data['pixel_y_dimension']		=$exif->getEntry(PelTag::PIXEL_Y_DIMENSION)->getText(); // 縦サイズ

			if($exif->getEntry(PelTag::FNUMBER))				$data['fnumber']			=$exif->getEntry(PelTag::FNUMBER)->getText(); // 絞り値
			if($exif->getEntry(PelTag::EXPOSURE_TIME))			$data['exposure_time']		=$exif->getEntry(PelTag::EXPOSURE_TIME)->getText(); // 露出時間
			if($exif->getEntry(PelTag::ISO_SPEED_RATINGS))		$data['iso_speed_ratings']		=$exif->getEntry(PelTag::ISO_SPEED_RATINGS)->getText(); // ISO速度
			if($exif->getEntry(PelTag::FOCAL_LENGTH))			$data['focal_length']			=$exif->getEntry(PelTag::FOCAL_LENGTH)->getText(); // 焦点距離
			if($exif->getEntry(PelTag::DATE_TIME_ORIGINAL))		$data['date_time_original']		=$exif->getEntry(PelTag::DATE_TIME_ORIGINAL)->getText(); // 撮影日時
			if($exif->getEntry(PelTag::WHITE_BALANCE))			$data['white_balance']			=$exif->getEntry(PelTag::WHITE_BALANCE)->getText(); // ホワイトバランス

			if($exif->getEntry(PelTag::FOCAL_LENGTH_IN_35MM_FILM))	$data['focal_length_in_35mm_film']	=$exif->getEntry(PelTag::FOCAL_LENGTH_IN_35MM_FILM)->getText(); // 35mm 換算焦点距離
			if($exif->getEntry(PelTag::EXPOSURE_PROGRAM))		$data['exposure_program']		=$exif->getEntry(PelTag::EXPOSURE_PROGRAM)->getValue(); // 露出プログラム
			if($ifd->getEntry(PelTag::X_RESOLUTION))			$data['x_resolution']			=$ifd->getEntry(PelTag::X_RESOLUTION)->getText(); // 解像度
			if($ifd->getEntry(PelTag::RESOLUTION_UNIT))			$data['resolution_unit']			=$ifd->getEntry(PelTag::RESOLUTION_UNIT)->getValue(); // 解像度の単位

			$smarty->assign('exif', $data);
		}
	}

	$url = urldecode($param["url"]);
	$smarty->assign('url', $url);
	$smarty->assign('err', $err);
	
?>
