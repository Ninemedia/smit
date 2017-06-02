<!-- Jquery Core Js -->
<script type="text/javascript" src="<?php echo FE_PLUGIN_PATH . 'jquery/jquery.min.js'; ?>"></script>

<!-- Bootstrap Core Js -->
<script type="text/javascript" src="<?php echo FE_PLUGIN_PATH . 'bootstrap/js/bootstrap.js'; ?>"></script>

<!-- Jquery UI Js -->
<script type="text/javascript" src="<?php echo FE_JS_PATH . 'jquery-ui.min.js'; ?>"></script>

<!-- jQuery Easing -->
<script type="text/javascript" src="<?php echo FE_JS_PATH . 'jquery.easing.1.3.js'; ?>"></script>

<!-- Waypoints -->
<script type="text/javascript" src="<?php echo FE_JS_PATH . 'jquery.waypoints.min.js'; ?>"></script>

<!-- Carousel -->
<script type="text/javascript" src="<?php echo FE_JS_PATH . 'owl.carousel.min.js'; ?>"></script>

<!-- Modernizr JS -->
<script type="text/javascript" src="<?php echo FE_JS_PATH . 'modernizr-2.6.2.min.js'; ?>"></script>

<!-- Additional/Plugins JS -->
<?php echo $scripts; ?>

<!-- Custom Js -->
<script type="text/javascript" src="<?php echo FE_JS_PATH . 'custom.js'; ?>"></script>

<!-- Main -->
<script type="text/javascript" src="<?php echo FE_JS_PATH . 'main.js'; ?>"></script>

<!-- Init Js -->
<?php 
    echo $scripts_init; 
    echo $scripts_add;
?>