<nav id="w0" class="navbar-inverse navbar-fixed-top navbar">
  <div class="container">
    <div class="navbar-header">    
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#w0-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img src="/upload/logo/logo.png" alt="logo" srcset="" width="190px" height= "50px">
      <a class="navbar-brand" href="/"></a>
    </div>
    <div id="w0-collapse" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
      <ul id="w1" class="navbar-nav navbar-right nav">                  
        <?php if (!Yii::$app->user->isGuest){ 
          $accountType = Yii::$app->user->identity->account_type;
          if($accountType == "Customer"){?>
            <li><a href ="/site/index">Home</a></li>    
            <li><a href ="/customer/dashboard">Dashboard</a></li>
            <li><a href ="/customer/profile">My Profile</a></li>  
          <?php }if($accountType == "Supplier"){ ?>
            <li><a href="/cylinder-list/index">Cylinder List</a></li>  
            <li><a href="/supplier/dashboard">Dashboard</a></li>
            <li><a href="/supplier/profile">My Profile</a></li>  
          <?php } ?>                                           
          <li> 
              <form action="<?= Yii::getAlias('@homeUrl') .'/site/logout';?>" method="post">
                  <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
                  <button type="submit" class="btn btn-link logout">Logout (<?= Yii::$app->user->identity->first_name; ?>)</button>
              </form>
          </li>
        <?php }else{ ?>
          <li><a href="/site/index">Home</a></li>  
          <li><a href="/site/contact">Contact</a></li>                  
          <li><a href="/site/about">About</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> SignUp<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/account/customer-signup">Customer SignUp</a></li>
              <li><a href="/account/supplier-signup">Supplier SignUp</a></li>
            </ul>
          </li>
          <li><a href="/account/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php }?>                    
      </ul>
    </div>
  </div>
</nav>