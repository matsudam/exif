<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="{$css_url}style.css" type="text/css" />
	<title>{$service_name}</title>

	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
	</script>
	<![endif]-->
</head>
<body>

<!-- GoogleAnalytics-Start -->
{literal}
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-28045860-2', 'hanak.in');
  ga('send', 'pageview');
</script>
{/literal}
<!-- GoogleAnalytics-end -->

<header id="header">
	<a href="./"><img src="{$img_url}logo.png" /></a>
</header>
<div id="main">

	<form action="/exif/?" method="get">
		<p>
			<input type="text" name="url" id="input" value="{$url}" onclick="this.select();" />
		</p>
		<p>
			<input type="submit" id="submit" value="チェック！" />
		</p>
	</form>

	{if $err ==99}
	<p id="msg"><span id="msg" class="err">指定されたURLが画像ファイルではありません。（code:{$err}）</span></p>
	{elseif $err}
	<p id="msg"><span id="msg" class="err">指定されたファイルにEXIF情報がありませんでした。（code:{$err}）</span></p>
	{/if}

	{if !$url}
	<p id="msg">
		<span id="msg"><strong>使い方</strong></span><br />
		<span id="msg">上記にEXIF情報を取得した写真のURLを入力し、<br />「チェック」ボタンを押してください。</span><br />
		<span id="msg">写真の中に記録されているEXIF情報を表示します。</span><br />
	</p>
	{/if}


	{if !$err && $url}
		<p>
			{if $exif.pixel_x_dimension > 500 || $exif.pixel_y_dimension > 500}
				{if $exif.pixel_x_dimension >= $exif.pixel_y_dimension}
					<img src="{$url}" width="500" />
				{else}
					<img src="{$url}" height="500" />
				{/if}
			{else}
				<img src="{$url}" />
			{/if}
		</p>

		<table id="exif_info">
			{if $exif.make}
			<tr>
				<td class="caption">メーカー</td>
				<td class="value">{$exif.make}</td>
			</tr>
			{/if}

			{if $exif.model}
			<tr>
				<td class="caption">モデル</td>
				<td class="value">{$exif.model}</td>
			</tr>
			{/if}

			{if $exif.pixel_x_dimension && $exif.pixel_y_dimension}
			<tr>
				<td class="caption">サイズ</td>
				<td class="value">{$exif.pixel_x_dimension} × {$exif.pixel_y_dimension}</td>
			</tr>
			{/if}

			{if $exif.x_resolution && $exif.resolution_unit}
			<tr>
				<td class="caption">解像度</td>
				<td class="value">{$exif.x_resolution}
				{if $exif.resolution_unit == 2}
					dpi
				{elseif $exif.resolution_unit == 3}
					pixel per cm
				{/if}
				</td>
			</tr>
			{/if}

			{if $exif.fnumber}
			<tr>
				<td class="caption">絞り値</td>
				<td class="value">{$exif.fnumber}</td>
			</tr>
			{/if}

			{if $exif.exposure_time}
			<tr>
				<td class="caption">露出時間</td>
				<td class="value">{$exif.exposure_time}</td>
			</tr>
			{/if}

			{if $exif.iso_speed_ratings}
			<tr>
				<td class="caption">ISO感度</td>
				<td class="value">{$exif.iso_speed_ratings}</td>
			</tr>
			{/if}

			{if $exif.focal_length}
			<tr>
				<td class="caption">焦点距離</td>
				<td class="value">{$exif.focal_length}</td>
			</tr>
			{/if}

			{if $exif.focal_length_in_35mm_film}
			<tr>
				<td class="caption">35mm換算焦点距離</td>
				<td class="value">{$exif.focal_length_in_35mm_film}</td>
			</tr>
			{/if}

			{if $exif.exposure_program}
			<tr>
				<td class="caption">露出プログラム</td>
				{if $exif.exposure_program == 0}
					<td class="value">未定義</td>
				{elseif $exif.exposure_program == 1}
					<td class="value">マニュアル</td>
				{elseif $exif.exposure_program == 2}
					<td class="value">ノーマルプログラム</td>
				{elseif $exif.exposure_program == 3}
					<td class="value">絞り優先</td>
				{elseif $exif.exposure_program == 4}
					<td class="value">シャッタースピード優先</td>
				{elseif $exif.exposure_program == 5}
					<td class="value">クリエイティブプログラム(被写界を深度方向に偏らせる)</td>
				{elseif $exif.exposure_program == 6}
					<td class="value">アクションプログラム(シャッタースピードを高速側に偏らせる)</td>
				{elseif $exif.exposure_program == 7}
					<td class="value">ポートレイトモード(近接撮影、フォーカスを背景から外す)</td>
				{elseif $exif.exposure_program == 8}
					<td class="value">ランドスケープモード(風景撮影、フォーカスを背景に合わせる)</td>
				{else}
					<td class="value">{$exif.exposure_program}</td>
				{/if}
			</tr>
			{/if}

			{if $exif.date_time_original}
			<tr>
				<td class="caption">撮影日</td>
				<td class="value">{$exif.date_time_original}</td>
			</tr>
			{/if}

		</table>

	{/if}
</div>
<footer id="footer">
	Copyright (C) {$smarty.now|date_format:"%Y"} <a href="http://matsudam.com" target="_blank">matsudam</a> All Rights Reserved.
</footer><!-- #footer -->

</body>
</html>