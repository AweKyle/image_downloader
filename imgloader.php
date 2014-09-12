<?php
function get_image()
{
	$id = rand(101, 585295);	//id изображений на сайте начинаются со 101. 585295 далеко не последнее изображение, так что можно смело писать цифру побольше
	$url = "http://nuclear-wallpapers.ru.com/download.php?id=" . $id . "&width=1366&height=768";
/*
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$res = curl_exec($ch);
	curl_close($ch);
*/

	$img = "http://white-wallpapers.ru/image/" . $id . "-1366-768-nuclear-wallpapers.ru.com.jpg";
	
	/*
	 *Эту проверку делал для себя, на случай отсутствия интернета..
	*/
	$check = get_headers($url);
	if ($check[0] !== 'HTTP/1.1 200 OK') {	//проверяем, нормальный ли заголовок нам возвращается
		$dir = opendir('/mnt/trash/dl/wllpprs/');
		while (false !== ($file = readdir($dir))) { 
		    $images[] = $file;
		}
		shuffle($images);
		$img = '/mnt/trash/dl/wllpprs/' . $images[0];
		copy($img, '/home/nikolay/walls/wall.jpg');
	}
	else {
		if (!getimagesize($img)) {	//бывает, что попадается битое изображение, так что проверяется его размер
		get_image();
	}
		else {
			copy('/home/nikolay/walls/wall.jpg', '/home/nikolay/walls/old_wall.jpg');
			copy($img, '/home/nikolay/walls/wall.jpg');			
		}
	}
}
get_image();
?>