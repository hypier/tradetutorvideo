<?php include_once ('includes/header.php'); ?>

<?php

  $categories = "SELECT COUNT(*) as num FROM tbl_category";
  $totalCategories = $connect->query($categories);
  $totalCategories = $totalCategories->fetch_array();
  $totalCategories = $totalCategories['num'];

  $videos = "SELECT COUNT(*) as num FROM tbl_gallery";
  $totalVideos = $connect->query($videos);
  $totalVideos = $totalVideos->fetch_array();
  $totalVideos = $totalVideos['num'];

?>

    <section class="content">

    <ol class="breadcrumb">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li class="active">Home</a></li>
    </ol>

        <div class="container-fluid">
             
             <div class="row">

                <a href="category.php">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect corner-radius col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name uppercase"><?php echo $menu_category; ?></div>
                            <div class="color-name"><i class="material-icons">people</i></div>
                            <div class="color-class-name">Total ( <?php echo $totalCategories; ?> ) Categories</div>
                            <br>
                        </div>
                    </div>
                </a>

                <a href="video.php">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect corner-radius col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name uppercase"><?php echo $menu_video; ?></div>
                            <div class="color-name"><i class="material-icons">subscriptions</i></div>
                            <div class="color-class-name">Total ( <?php echo $totalVideos; ?> ) Videos</div>
                            <br>
                        </div>
                    </div>
                </a>

                <a href="ads.php">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect corner-radius col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name uppercase"><?php echo $menu_ads; ?></div>
                            <div class="color-name"><i class="material-icons">monetization_on</i></div>
                            <div class="color-class-name">App Monetization</div>
                            <br>
                        </div>
                    </div>
                </a>

                <a href="notification.php">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect corner-radius col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name uppercase"><?php echo $menu_notification; ?></div>
                            <div class="color-name"><i class="material-icons">notifications</i></div>
                            <div class="color-class-name">Send notification to your users</div>
                            <br>
                        </div>
                    </div>
                </a>

                <a href="admin.php">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect corner-radius col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name uppercase"><?php echo $menu_administrator; ?></div>
                            <div class="color-name"><i class="material-icons">people</i></div>
                            <div class="color-class-name">Admin Panel Privileges</div>
                            <br>
                        </div>
                    </div>
                </a>

                <a href="settings.php">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect corner-radius col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name uppercase"><?php echo $menu_setting; ?></div>
                            <div class="color-name"><i class="material-icons">settings</i></div>
                            <div class="color-class-name">Key and Privacy Settings</div>
                            <br>
                        </div>
                    </div>
                </a>

                <a href="apps.php">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect corner-radius col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name uppercase"><?php echo $menu_app; ?></div>
                            <div class="color-name"><i class="material-icons">adb</i></div>
                            <div class="color-class-name">Apps and Redirect</div>
                            <br>
                        </div>
                    </div>
                </a>

                <a href="license.php">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect corner-radius col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name uppercase"><?php echo $menu_license; ?></div>
                            <div class="color-name"><i class="material-icons">vpn_key</i></div>
                            <div class="color-class-name">Item purchase code</div>
                            <br>
                        </div>
                    </div>
                </a>

            </div>
            
        </div>

    </section>


<?php include_once('includes/footer.php'); ?>