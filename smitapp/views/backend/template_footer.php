<!-- Jquery Core Js -->
<script src="<?php echo BE_PLUGIN_PATH . 'jquery/jquery.min.js'; ?>"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo BE_PLUGIN_PATH . 'bootstrap/js/bootstrap.js'; ?>"></script>

<!-- Additional/Plugins JS -->
<script src="<?php echo BE_PLUGIN_PATH . 'sweetalert/sweetalert.min.js'; ?>"></script>
<script src="<?php echo BE_PLUGIN_PATH . 'bootbox/bootbox.min.js'; ?>"></script>
<?php echo $scripts; ?>

<!-- Custom Js -->
<script src="<?php echo BE_JS_PATH . 'custom.js'; ?>"></script>

<!-- Init Js -->
<?php 
    echo $scripts_init; 
    echo $scripts_add;
?>