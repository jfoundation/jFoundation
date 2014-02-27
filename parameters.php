<?php defined('_JEXEC') or die;
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

File: parameters.php - parameter handling

/* ===================================================================== */

// variables
$app = JFactory::getApplication();
$doc = JFactory::getDocument(); 
$params = $app->getParams();
$headdata = $doc->getHeadData();
$menu = $app->getMenu();
$active = $menu->getActive();
$onhome = 0;
if ($active == $menu->getDefault()) $onhome = 1;
$menuname = $active->title;
$parentId = $active->tree[0];
$parentName = $menu->getItem($parentId)->title;
$pageclass = $params->get('pageclass_sfx');
$tpath = $this->baseurl.'/templates/'.$this->template;
$sitename = $app->getCfg('sitename');

// basic parameters
$cssloading = $this->params->get('cssloading');
$modernizr = $this->params->get('modernizr');
$normalize = $this->params->get('normalize');
$fontawesome = $this->params->get('fontawesome');
$nocaption = $this->params->get('nocaption');
$removecore = $this->params->get('removecore');
$generator = $this->params->get('generator');
$copyright = $this->params->get('copyright');
$analytics = $this->params->get('analytics');

// javascript parameters
$ff = $this->params->get('ffound');
$fab = $this->params->get('fabide');
$fac = $this->params->get('faccordion');
$fal = $this->params->get('falert');
$fc = $this->params->get('fclearing');
$fd = $this->params->get('fdropdown');
$fe = $this->params->get('fequalizer');
$fi = $this->params->get('finterchange');
$fj = $this->params->get('fjoyride');
$fm = $this->params->get('fmagellan');
$foc = $this->params->get('foffcanvas');
$fob = $this->params->get('forbit');
$fr = $this->params->get('freveal');
$fta = $this->params->get('ftab');
$fto = $this->params->get('ftooltip');
$ftb = $this->params->get('ftopbar');

$fjsloader = $tpath.'/js/js.php?ff='.$ff.'&amp;fab='.$fab.'&amp;fab='.$fab.'&amp;fac='.$fac.'&amp;fal='.$fal.'&amp;fc='.$fc.'&amp;fd='.$fd.'&amp;fe='.$fe.'&amp;fi='.$fi.'&amp;fj='.$fj.'&amp;fm='.$fm.'&amp;foc='.$foc.'&amp;fob='.$fob.'&amp;fr='.$fr.'&amp;fta='.$fta.'&amp;fto='.$fto.'&amp;ftb='.$ftb;

// Clear Generator tag
$this->setGenerator($generator);

// remove core scripts
if ($removecore==1) :
	unset($doc->_scripts[$this->baseurl.'/media/jui/js/jquery.min.js']);
	unset($doc->_scripts[$this->baseurl.'/media/jui/js/jquery-noconflict.js']);
	unset($doc->_scripts[$this->baseurl.'/media/jui/js/jquery-migrate.min.js']);
	unset($doc->_scripts[$this->baseurl.'/media/system/js/tabs-state.js']);
endif;

// remove caption if needed
if ($nocaption==1) :
	unset($doc->_scripts[$this->baseurl.'/media/system/js/caption.js']);
	if (isset($this->_script['text/javascript'])) :
		$this->_script['text/javascript'] = preg_replace('%jQuery\(window\)\.on\(\'load\',\s*function\(\)\s*{\s*new\s*JCaption\(\'img.caption\'\);\s*}\);\s*%', '', $this->_script['text/javascript']);
		if (empty($this->_script['text/javascript'])) unset($this->_script['text/javascript']);
	endif;
endif;

// Force latest IE & chrome frame
$doc->setMetadata('x-ua-compatible', 'IE=edge,chrome=1');

// If needed load normal CSS
if ($cssloading==0) :
	// Load Normalize if needed
	if ($normalize==1) $doc->addStyleSheet($tpath.'/css/normalize.css');
	$doc->addStyleSheet($tpath.'/css/foundation.css');
	// Load Font Awesome if needed
	if ($fontawesome==1) $doc->addStyleSheet($tpath.'/css/font-awesome.css');
	// Load website css
	$doc->addStyleSheet($tpath.'/css/site.css');
	if ($fontawesome==1) $doc->addStyleSheet($tpath.'/css/site-font-awesome.css');
endif;

// If needed load minified CSS
if ($cssloading==1) :
	// Load Normalize if needed
	if ($normalize==1) $doc->addStyleSheet($tpath.'/css/normalize.css');
	$doc->addStyleSheet($tpath.'/css/foundation.min.css');
	// Load Font Awesome if needed
	if ($fontawesome==1) $doc->addStyleSheet($tpath.'/css/font-awesome.min.css');
	// Load website css
	$doc->addStyleSheet($tpath.'/css/site.css');
	if ($fontawesome==1) $doc->addStyleSheet($tpath.'/css/site-font-awesome.css');
endif;

// If needed load merged CSS
if ($cssloading==2) :
	$doc->addStyleSheet($tpath.'/css/css.php?nm='.$normalize.'&amp;fa='.$fontawesome);
endif;

// Load Modernizr if needed
if ($modernizr==1) $doc->addScript($tpath.'/js/vendor/modernizr.js');

?>