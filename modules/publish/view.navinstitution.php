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

                      <li class="divider"></li>
                      <li><a tabindex="0" href="#">Invite Friends</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-education"></span> My Institute <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a tabindex="0" href="view.myinstitution.php">View My Institute</a></li> 
                    <li class="divider"></li>
                    <li><a tabindex="0" href="view.institution.php">Create Institute</a></li>
                    <li><a tabindex="0" href="view.creategroup.php">Create Group</a></li>
                  </ul>
                </li>  
                <!-- <li class="active" >
                  <form action="view.searchInstitute.php" method="post" >
                        <div class="nav navbar-nav " style="width: 250px;padding-top: 3px;margin-left: 500px">
                            <div class="input-group" >
                                <input type="text" class="form-control" name="search" placeholder="Search Institution"/>
                                 <div class="input-group-btn">
                                    <button class="btn btn-success" type="submit_search" name="submit_search"><i class="glyphicon glyphicon-search"></i></button>
                                 </div>
                            </div>
                        </div>
                  </form>    
                </li> -->
                 
            </ul>
        </div>
      </div>
    </div>

</div>