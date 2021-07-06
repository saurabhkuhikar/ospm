
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>OSPM!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="/upload/profile_pictures/empty_image.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= Yii::$app->user->identity->first_name; ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br/>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">   
                    <?php $accountType = Yii::$app->user->identity->account_type;
                    if($accountType == "Customer"){?>                    
                    <li>
                        <a href ="/site/index"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li>
                        <a href ="/customer/dashboard"><i class="fa fa-laptop"></i> Dashboard</a>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Order List <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/cylinder-booking/index?status=Pending">Pending</a></li>
                            <li><a href="/cylinder-booking/index?status=Process">Process</a></li>
                            <li><a href="/cylinder-booking/index?status=Delivered">Delivered</a></li>
                        </ul>
                    <?php }
                    if($accountType == "Supplier"){?>
                        <li>
                            <a href ="/supplier/dashboard"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <li><a><i class="fa fa-edit"></i> Order List <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/booking-request/index?status=Pending">Pending</a></li>
                                <li><a href="/booking-request/index?status=Process">Process</a></li>
                                <li><a href="/booking-request/index?status=Delivered">Delivered</a></li>
                            </ul>
                        </li> 
                        <li><a href="/cylinder-list/index"><i class="glyphicon glyphicon-pencil"></i>Add Cylinders </a>
                        </li>               
                    <?php } ?>
                </ul>                   
            </div> 
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>            
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>