<?PHP
	error_reporting(E_ERROR | E_PARSE);
	require "config.php";
?>
<html>
<head>
	<title><?= $config['page_title'] ?></title>
	<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
	<script type="text/javascript" src="js/jquery.masonry.js"></script>
	<!-- Add fancyBox -->
	<link rel="stylesheet" href="fancybox/jquery.fancybox.css?v=2.0.6" type="text/css" media="screen" />
	<script type="text/javascript" src="fancybox/jquery.fancybox.pack.js?v=2.0.6"></script>
	<link rel="stylesheet" href="fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.2" type="text/css" media="screen" />
	<script type="text/javascript" src="fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.2"></script>

	<script type="text/javascript">
		$_TEXT_END 		= "<?= $config['language']['ended'] ?>";
	</script>
	<script type="text/javascript" src="js/hot.js"></script>
	<link rel="stylesheet" href="css/hot-estelar.css" type="text/css" media="screen" />

</head>
<body>

	<h3><?= $config['page_title'] ?></h3>

	<div id="container">
	</div>

	<div id="loader"></div>

</body>
</html>