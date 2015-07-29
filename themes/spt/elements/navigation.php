<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#toggle-navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="<?php echo $view->getThemePath() ?>/assets/images/logo.png" height="49">
            </a>
        </div>
        <p class="navbar-text navbar-right">
	        <?php $u = new User();
	        if($u->isLoggedIn()){ ?>
	        	Hello, <a class="navbar-link" href="<?php echo $this->url('/account')?>"><?php echo $u->getUserName() ?></a>&nbsp;
	        	<a class="navbar-link" href="<?php echo URL::to('/login','logout', Loader::helper('validation/token')->generate('logout'))?>"><i class="fa fa-sign-out"></i></a>
	        <?php }else{?>
	    		<a class="navbar-link" href="<?php echo $this->url('/login')?>">Log In</a>
	        <?php } ?>
        </p>
        <div id="toggle-navbar" class="collapse navbar-collapse">
            <?php
                $a = new GlobalArea('Header Navigation');
                $a->display();
            ?>
        </div><!--/.nav-collapse -->
    </div>
</nav>
