<head>
	<!-- Meta Tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
    <meta name="description" content="<?php echo get_option('company_name'); ?>" />
    <meta name="author" content="<?php echo get_option('company_name'); ?>" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />
    
    <!-- Title -->
	<title><?php echo $title; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" href="<?php echo FE_IMG_PATH; ?>logo/favicon.ico" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />
	
    
    <!-- Additional/Plugins CSS -->
    <?php echo $headstyles; ?>
    
    <!-- Bootstrap Core Css -->
	<link rel="stylesheet" type="text/css" href="<?php echo FE_CSS_PATH; ?>bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo FE_PLUGIN_PATH . 'bootstrap/css/bootstrap.css'; ?>"  />
    
	<!-- Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo FE_CSS_PATH; ?>font-awesome/font-awesome.min.css" />
    
    <!-- Owl Carousel  -->
	<link rel="stylesheet" type="text/css" href="<?php echo FE_CSS_PATH; ?>owl.carousel.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo FE_CSS_PATH; ?>owl.theme.default.min.css" />
    
	<!-- Theme style  -->
	<link rel="stylesheet" type="text/css" href="<?php echo FE_CSS_PATH; ?>style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo FE_CSS_PATH; ?>style1.css" />
    
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>