<?php
const RSS_URL = "http://mysite.local/PHP-2017/course_3/news/rss.xml";
const FILE_NAME = "news.xml";
const RSS_TTL = 60;
function download($url, $filename){
    $file = file_get_contents($url);
    if($file) file_put_contents ($filename, $file);
}
if(!is_file(FILE_NAME))    download(RSS_URL, FILE_NAME);
?>
<!DOCTYPE html>

<html>
<head>
	<title>Новостная лента</title>
	<meta charset="utf-8" />
</head>
<body>

<h1>Последние новости</h1>
<?php
$sxml = simplexml_load_file(FILE_NAME);
//var_dump(time() - filemtime(FILE_NAME));
foreach ($sxml->channel->item as $news){
    echo <<<RSS
    <h3><a href="$news->linkNews">$news->titleNews</a></h3><br>
    <p>
    {$news->description}<br>
    <strong>Категория: {$news->category}</strong>&nbsp
    <em>Опубликовано: {$news->pubdate}</em>
    </p>
    <p align='right'>
     <a href="$news->linkNews">Читать далее</a>
    </p>
RSS;
}
if(time() - filemtime(FILE_NAME) > RSS_TTL)
    download(RSS_URL, FILE_NAME);
?>
</body>
</html>