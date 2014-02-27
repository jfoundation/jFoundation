<?php defined( '_JEXEC' ) or die; 
/* ========================================================================
Template:	JFoundation
Author: 	René Kreijveld - http://about.me/renekreijveld - @renekreijveld
Version: 	0.1
Created: 	February 2014
Copyright:	René Kreijveld - (C) 2014 - All rights reserved
Licenses:	GNU/GPL v3 or later http://www.gnu.org/licenses/gpl-3.0.html

Joomla 3.x base template built on Foundation 5

Based on the excellent work of:

Foundation: http://foundation.zurb.com/
OneWeb for Joomla: Seth Warburton - Internet Inspired! - @nternetinspired
Yireo Template Helper for Joomla!: Jisse Reitsma - http://www.yireo.com
Blank Template: Alexander Schmidt - http://blank.vc
SiegeEngine2: Antony Doyle - http://www.siegeengine.org/
Ordasoft Base Template: http://ordasoft.com/

File: index.php - main template file

/* ===================================================================== */
include_once JPATH_THEMES.'/'.$this->template.'/parameters.php'; // load parameters.php
?><!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="<?php echo $this->language; ?>" > <![endif]-->
<html class="no-js" lang="<?php echo $this->language; ?>">
	<head>
		<?php if($this->countModules('headerstart')>0) : ?><jdoc:include type="modules" name="headerstart" /><?php endif; ?>
		<jdoc:include type="head" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/images/icons/apple-touch-icon-57x57-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/images/icons/apple-touch-icon-72x72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/images/icons/apple-touch-icon-114x114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $tpath; ?>/images/icons/apple-touch-icon-144x144-precomposed.png">
		<?php if ($analytics != "UA-XXXXXXXX-Y") : ?>
		<script>
			var _gaq=[["_setAccount","<?php echo htmlspecialchars($analytics); ?>"],["_trackPageview"]];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
			g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
			s.parentNode.insertBefore(g,s)}(document,"script"));
		</script>
		<?php endif; ?>
		<?php if($this->countModules('headerfinish')>0) : ?><jdoc:include type="modules" name="headerfinish" /><?php endif; ?>
	</head>
	<body class="<?php echo (($onhome==1) ? ('homepage') : ('page')).' '.$active->alias; if ($pageclass) echo ' '.$pageclass; ?>">
		<?php if($this->countModules('bodystart')>0) : ?><jdoc:include type="modules" name="bodystart" /><?php endif; ?>

		<div class="row">
			<div class="large-12 columns">
				<!-- Nav Bar -->
				<nav class="top-bar" data-topbar>
					<ul class="title-area">
						<li class="name"><h1><a href="/"><?php echo $sitename;?></a></h1></li>
						<li class="toggle-topbar menu-icon">
							<a href="#">Menu</a>
						</li>
					</ul>
					<section class="top-bar-section">
						<jdoc:include type="modules" name="topbarmenu" />
					</section>
				</nav>
				<!-- End Nav -->
			</div>
		</div>

		<!-- Main Page Content and Sidebar -->
		<div class="row">
			<!-- Main Blog Content -->
			<div class="large-12 columns" role="content">
				<?php if($this->countModules('contentstart')>0) : ?><jdoc:include type="modules" name="contentstart" /><?php endif; ?>
				<jdoc:include type="component" />
				<?php if($this->countModules('contentfinish')>0) : ?><jdoc:include type="modules" name="contentfinish" /><?php endif; ?>
			</div>
			<!-- End Main Content -->
		</div>
		<!-- End Main Content and Sidebar -->
		<!-- Footer -->
		<footer class="row">
			<div class="large-12 columns">
				<hr />
				<div class="row">
					<div class="large-6 columns">
						<?php if ($copyright) : ?><p>© <?php echo $copyright;?></p><?php endif; ?>
					</div>
					<div class="large-6 columns">
						<ul class="inline-list right">
							<li><a href="#">Link 1</a></li>
							<li><a href="#">Link 2</a></li>
							<li><a href="#">Link 3</a></li>
							<li><a href="#">Link 4</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>

		<script src="<?php echo $fjsloader;?>"></script>
		<script>$(document).foundation();</script>
		<?php if($this->countModules('bodyfinish')>0) : ?><jdoc:include type="modules" name="bodyfinish" /><?php endif; ?>
		<jdoc:include type="modules" name="debug" />
	</body>
</html>