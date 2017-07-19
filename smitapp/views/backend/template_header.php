<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <title><?php echo $title; ?></title>
    
    <!-- Favicon-->
    <link rel="icon" href="<?php echo BE_IMG_PATH . 'logo/favicon.ico'; ?>" type="image/x-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Core Css -->
    <link href="<?php echo BE_PLUGIN_PATH . 'bootstrap/css/bootstrap.css'; ?>" rel="stylesheet" />
    
    <!-- Additional/Plugins CSS -->
    <link href="<?php echo BE_PLUGIN_PATH . 'sweetalert/sweetalert.css'; ?>" rel="stylesheet" />
    <?php echo $headstyles; ?>

    <!-- Custom CSS -->
    <link href="<?php echo BE_CSS_PATH . 'style.css'; ?>" rel="stylesheet" />

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo BE_CSS_PATH . 'themes/theme-blue.css'; ?>" rel="stylesheet" />
</head>