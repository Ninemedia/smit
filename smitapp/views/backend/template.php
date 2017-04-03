<!DOCTYPE html>
<html>
    <!-- Load Template Header -->
    <?php $this->load->view(VIEW_BACK . 'template_header'); ?>
    
    <body class="theme-blue">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->
        
        <!-- Search Bar -->

        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="START TYPING...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div>
        <!-- #END# Search Bar -->
        
        <!-- Load Template Topbar -->
        <?php $this->load->view(VIEW_BACK . 'template_topbar'); ?>
        
        <!-- Load Template Sidebar -->
        <?php $this->load->view(VIEW_BACK . 'template_sidebar'); ?>
        
        <!-- Load Template Content -->
        <section class="content">
            <div class="container-fluid">
                <?php $this->load->view(VIEW_BACK . $main_content); ?>
            </div>
        </section>
        
        <!-- Load Template Footer -->
        <?php $this->load->view(VIEW_BACK . 'template_footer'); ?>
    </body>
</html>