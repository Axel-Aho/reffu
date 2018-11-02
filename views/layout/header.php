<!DOCTYPE html>
<html>
	<head>
		<meta charset="<?php echo get_bloginfo('charset'); ?>">
		<title><?php wp_title(); ?></title>
		<meta name="viewport" content="width=device-width" />
		<link href="https://fonts.googleapis.com/css?family=Montserrat: 400,700" rel="stylesheet">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>	
		<?php if( isset( $favicon) ): ?>
			<link rel="shortcut icon" href="<?= $favicon; ?>" />
		<?php endif; ?>
		<?php wp_head(); ?>
	</head>
	<body <?= body_class(); ?>>