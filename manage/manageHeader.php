<?php
require_once 'managefunctions.php';

function manage_main_nav(){
	
	global $mySQLAddress;
	global $mainDbUserName;
	global $mainDbPass;
	global $mainDbName;
	global $rootURLmanage;
	global $rootURL;
	
	echo <<<EOT
	<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{$rootURLmanage}managetop.php">JIOS System</a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li>
						    <a href="{$rootURLmanage}managetop.php"><i class="fa fa-dashboard fa-fw"></i> ダッシュボード</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users fa-fw"></i> ユーザー管理<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{$rootURLmanage}manageadduser.php"><i class="fa fa-plus-square-o fa-fw"></i>新規登録</a>
								</li>
								
								<li>
									<a href="{$rootURLmanage}manageusermanage.php"><i class="fa fa-edit fa-fw"></i>検索・編集</a>
								</li>
							</ul>
						</li>
						
						<li>
							<a href="#"><i class="fa fa-building-o fa-fw"></i> 企業管理<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{$rootURLmanage}manageaddcomp.php"><i class="fa fa-plus-square-o fa-fw"></i>新規登録</a>
								</li>
								
								<li>
									<a href="{$rootURLmanage}managecompmanage.php"><i class="fa fa-edit fa-fw"></i>検索・編集</a>
								</li>
							</ul>
						</li>
						
						<li>
							<a href="#"><i class="fa fa-file-text-o fa-fw"></i> 求人票管理<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{$rootURLmanage}manageaddjob.php"><i class="fa fa-plus-square-o fa-fw"></i>新規登録</a>
								</li>
								
								<li>
									<a href="{$rootURLmanage}managejobmanage.php"><i class="fa fa-edit fa-fw"></i>検索・編集</a>
								</li>
							</ul>
						</li>
						<li>
						    <a href="{$rootURLmanage}managecal.php"><i class="fa fa-calendar fa-fw"></i> スケジュール管理</a>
						</li>
						<li>
						    <a href="http://development.roundstone.besaba.com/jios/logout.php" style="color:red;"><i class="fa fa-sign-out fa-fw"></i> ログアウト</a>
						</li>
					
			
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
EOT;
}

?>