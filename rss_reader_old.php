<?php
	define("RSS_URL", "http://mysite.local/news/rss.xml");
	define("FILE_NAME", "news.xml");
	function download($url, $filename){
		$file = file_get_contents($url);
		if($file) file_put_contents($filename, $file);
	}
	if(!file_exists(FILE_NAME))
		download(RSS_URL, FILE_NAME);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<title>Новостная лента</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<h1>Последние новости</h1>
<?php

	$sxml = simplexml_load_file(FILE_NAME);
	//var_dump ($sxml);
	foreach($sxml->channel->item as $news){
	
	/*
			 echo <<<LABEL
			<hr>
			<p>
				<h3><a href="$news->link">$news->title</a></h3><br> from[$news->category] @ $news->datetime
					<br>$news->pubDate
			</p>
LABEL;
*/
		echo <<<RSS
		<h3><a href="$news->link">$news->title</a></h3><br>
		<p>
		{$news->description}<br>
		<strong>Категория: {$news->category}</strong>&nbsp
		<em>Опубликовано: {$news->pubDate}</em>
		</p>
		<p align='right'>
			<a href="$news->link">Читать далее</a>
		</p>
RSS;
	}
	//кэширование
	if(time() > filemtime(FILE_NAME) + 30)
		download(RSS_URL, FILE_NAME);
?>
</body>
</html>