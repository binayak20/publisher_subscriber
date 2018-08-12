<div class="row">
    <div class="col-sm-12">
      <div id="user-nav" class="navbar" style="padding-top: 20px">
        <div class="navbar-inner">   
            <ul class="nav">
                <li class="active">
                  <a href="home.php" ><span class="glyphicon glyphicon-dashboard"></span>Dashboard</a>    
                </li>
           
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="glyphicon glyphicon-user"></span> Profile <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a tabindex="0" href="view.userprofile.php">View Profile</a></li>
                      <li class="divider"></li>
                      <li><a tabindex="0" href="view.userprofile.php?edit=<?php echo $ID; ?>">Edit Profile</a></li>

                      <li><a tabindex="0" href="view.changepassword.php?changpass=<?php echo $ID ; ?>">Change Password</a></li>
                    </ul>
                </li>
            </ul>
        </div>
      </div>
    </div>
</div>