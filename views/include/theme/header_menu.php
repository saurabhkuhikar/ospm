<div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <?php if(!empty(Yii::$app->user->identity->profile_picture)){?>                                    
                                    <img src="/upload/profile_pictures/<?= Yii::$app->user->identity->profile_picture; ?>" alt=""><?= Yii::$app->user->identity->first_name; ?>
                                     <?php }else{ ?>
                                       <img src="/upload/profile_pictures/empty_image.png" alt=""><?= Yii::$app->user->identity->first_name; ?>  
                                    <?php }?>

                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <?php  $accountType = Yii::$app->user->identity->account_type;?>
                                    <?php if($accountType == "Supplier"){ ?>                            
                                    <li><a href="/supplier/profile">My Profile</a></li>  
                                    <?php }else{ ?> 
                                    <li><a href ="/customer/profile">My Profile</a></li> 
                                    <?php }?>
                                    
                                    <li><a href="javascript:;">Help</a></li>
                                    <li>
                                        <form action="<?= Yii::getAlias('@homeUrl') .'/site/logout';?>" method="post">
                                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
                                            <button type="submit" class="btn btn-link logout">Logout (<?= Yii::$app->user->identity->first_name; ?>)</button>
                                        </form>
                                    <li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                    
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        
                                    </a>
                                </li>
                                <li>
                                    <a>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        
                                    </a>
                                </li>
                                <li>
                                <div class="text-center">
                                    <a>
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                                </li>
                            </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>