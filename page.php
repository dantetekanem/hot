<?PHP
	error_reporting(E_ERROR | E_PARSE);
	require "config.php";

	$path 		= $config['image_path'];

	$start 		= $_GET['start_at'] == "" ? 0 : $_GET['start_at'];
	$limit_max 	= $config['per_page'];

	$images = array_slice(glob($path."*"), $start, $limit_max);
	foreach($images as $img) {
		$img_name 	= end(explode("/", $img));
		$filesize 	= filesize($img);
		list($width, $height) = getimagesize($img);
		$w 			= $config['width'];
		$h 			= ($height * $config['width']) / $width;
		$text 		= '<b>'.$config['language']['name'].':</b> '.$img_name.'<br /><b>'.$config['language']['size'].':</b> '.byte_format($filesize).'<br /><a href=\'download.php?file='.$img.'\'>'.$config['language']['download'].'</a>';

		echo '<div style="width: '.$w.'px; height: '.$h.'px;" class="box" rel="'.$text.'">';
		echo '<a href="'.$img.'" class="fancy">';
		echo '<img src="thumb.php?w='.$w.'&img='.urlencode($img).'" />'."\n";
		echo '</a>';
		echo '</div>';
	}