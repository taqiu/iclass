<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="language" content="en"/>

	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>
<?php /*
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
	      media="screen, projection"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
	      media="print"/>
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
	      media="screen, projection"/>
	<![endif]--> */
?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<!-- Part 1: Wrap all page content here -->
<div id="wrap">
<div class="container" id="page">
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="bootsnippbrand btn btn-danger" href="#"><?php echo Yii::app()->name ?></a>
				<div class="nav-collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array( 'class' => 'nav' ),
						'activeCssClass'	=> 'active',
						'items'=>array(
							array('label'=>'Home', 'url'=>array('/site/index')),
							array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
							array('label'=>'Contact', 'url'=>array('/site/contact')),
						),
					)); ?>
					<?php if (!Yii::app()->user->isGuest): ?>
					<ul class="nav pull-right">
						 <li class="dropdown">
							<a id="user-panel" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> <?php echo Yii::app()->user->name ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
          						<li><a href="<?php echo $this->createUrl('user/view&id='.Yii::app()->user->id)?>"><i class="icon-cog"></i> Profile</a></li>
          						<li><a href="<?php echo $this->createUrl('user/password&id='.Yii::app()->user->id)?>"><i class="icon-lock"></i> Change Password</a></li>
          						<li><a href="#"><i class="icon-info-sign"></i> Help</a></li>
        					</ul>
      					</li>
        				<li><a href="<?php echo $this->createUrl('site/logout')?>"><i class="icon-off  icon-white"></i> Logout</a></li>
      				</ul>					
					<?php elseif (Yii::app()->controller->getAction()->getId() !== "login"): ?>
					<form class="navbar-form pull-right" id="nav-login" action="<?php echo $this->createUrl('site/login')?>" method="post">
						<input class="span2" type="text" placeholder="Username" name="LoginForm[username]" id="LoginForm_username" >
						<input class="span2" type="password" placeholder="Password" name="LoginForm[password]" id="LoginForm_password">
						<button type="submit" class="btn btn-success">Log In</button>
						<input id="ytLoginForm_rememberMe" type="hidden" value="0" name="LoginForm[rememberMe]" />
						<label class="checkbox" for="LoginForm_rememberMe"><input name="LoginForm[rememberMe]" id="LoginForm_rememberMe" value="1" type="checkbox" />
		Keep me logged in</label>
					</form>
					<?php endif?>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>	<!-- navbar -->

	<div class="container" style="<?php if (Yii::app()->user->isGuest && Yii::app()->controller->getAction()->getId() !== "login") {echo 'margin-top:77px';} ?>
								  <?php if (!Yii::app()->user->isGuest || Yii::app()->controller->getAction()->getId() === "login") {echo 'margin-top:60px';} ?>">
		<?php if (isset($this->breadcrumbs)): ?>
			<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links' => $this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
		<?php endif?>

		<?php echo $content; ?>
	</div>
</div><!-- page -->
</div> <!-- wrap -->

<div id="footer">
	<div class="container">
		<span id="footer-terms"><a href="http://www.iub.edu/">IUB</a> | <a href="http://www.soic.indiana.edu/computer-science/">SOIC</a> | <a href="http://vision.soic.indiana.edu/">Vision Lab</a> <br/> Copyright &copy; <?php echo date('Y'); ?>.   All Rights Reserved. </span>
		<span id="footer-copyright"> <a href="#">[TOP]</a></span>
	</div>
</div> <!-- footer -->
</body>
</html>