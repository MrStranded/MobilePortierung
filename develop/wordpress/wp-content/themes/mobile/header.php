<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo get_bloginfo( 'name' ); ?></title>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo get_bloginfo( 'template_directory' );?>/style.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php wp_head();?>
</head>

<body>

    <script>
        testPhp();
    </script>

    <?php if (wp_is_mobile()) { ?>
	    <div class="container-mobile">

            <div class="menu-container">
                <div class="menu-filler"></div>
                <div class="menu-button" id="slide-menu-button">
                    <img id="slide-menu-button-open" style="width: 100%;" src="<?php echo get_template_directory_uri(); ?>/images/baseline_menu_black_48dp_2x.png" alt="Open Menu" />
                    <img id="slide-menu-button-close" style="width: 100%; display: none;" src="<?php echo get_template_directory_uri(); ?>/images/baseline_close_black_48dp_2x.png" alt="Close Menu" />
                </div>
            </div>
    <?php } else { ?>
        <div class="container-desktop">
    <?php }; ?>
