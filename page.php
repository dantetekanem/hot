<?PHP
	error_reporting(E_ERROR | E_PARSE);
	require "config.php";

	$path 		= $config['image_path'];

	$start 		= $_GET['start_at'] == "" ? 0 : $_GET['start_at'];
	$limit 		= $config['per_page'];

	$images = array_slice(glob($path."{*.jpg,*.png,*.gif,*.jpeg,*.JPG,*.PNG,*.GIF,*.JPEG}", GLOB_BRACE), $start, $limit);

	if(count($images) == 0) {
		die("empty");
	}

	foreach($images as $img) {
		$img_name 	= end(explode("/", $img));
		$filesize 	= filesize($img);
		list($width, $height) = getimagesize($img);
		$w 			= $config['width'];
		$h 			= ($height * $config['width']) / $width;
		$text 		= '<b>'.$config['language']['name'].':</b> '.$img_name.'<br />';
		$text 		.= '<b>'.$config['language']['size'].':</b> '.byte_format($filesize).'<br />';
		$text 		.= '<b>'.$config['language']['dimensions'].':</b> '.$width.'x'.$height.'<br />';
		if($config['allow_download'] == true)
			$text 	.= '<a href=\'download.php?file='.$img.'\'>'.$config['language']['download'].'</a>';

		echo '<div style="width: '.$w.'px; height: '.$h.'px;" class="box" rel="'.$text.'">';
		echo '<a href="'.$img.'" class="fancy">';
		echo '<img src="thumb.php?w='.$w.'&img='.urlencode($img).'" />'."\n";
		echo '</a>';
		echo '</div>';
	}