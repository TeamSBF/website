<?php /**  * @copyright	Copyright (C) 2013 JoomlaTemplates.me - All Rights Reserved. **/ defined( '_JEXEC' ) or die( 'Restricted access' );
$scrolltop		= $this->params->get('scrolltop');
$logo			= $this->params->get('logo');
$logotype		= $this->params->get('logotype');
$sitetitle		= $this->params->get('sitetitle');
$sitedesc		= $this->params->get('sitedesc');
$menuid			= $this->params->get('menuid');
$animation		= $this->params->get('animation');
$app			= JFactory::getApplication();
$doc			= JFactory::getDocument();
$templateparams	= $app->getTemplate(true)->params;
$menu = $app->getMenu();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<jdoc:include type="head" />
<?php if ( version_compare( JVERSION, '3.0.0', '<' ) == 1) { ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<?php } else { JHtml::_('bootstrap.framework');JHtml::_('bootstrap.loadCss', false, $this->direction);}?>
<?php include "functions.php"; ?>
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/styles.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/font-awesome.min.css" type="text/css" />
<!-- Custom CSS For IE -->
<!--[if IE 7]><link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/font-awesome-ie7.min.css" type="text/css" /><![endif]-->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
<!-- Custom CSS -->
<link href='http://fonts.googleapis.com/css?family=Joti+One' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<?php if ($scrolltop == 'yes' ) : ?>
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/scroll.js"></script>
<?php endif; ?>
</head>
<body class="background">
<div id="wrapper">
<div id="header-wrap" class="clr">
    	<div id="header" class="container row clr">   
            <div id="logo" class="col span_4">
				<?php if ($logotype == 'image' ) : ?>
                <?php if ($logo != null ) : ?>
            <a href="<?php echo $this->baseurl ?>"><img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logo); ?>" alt="<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>" /></a>
                <?php else : ?>
            <a href="<?php echo $this->baseurl ?>/"><img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/logo.png" border="0"></a>
                <?php endif; ?><?php endif; ?> 
                <?php if ($logotype == 'text' ) : ?>
            <a href="<?php echo $this->baseurl ?>"><?php echo htmlspecialchars($sitetitle);?></a>
                <?php endif; ?>
                <?php if ($sitedesc !== '' ) : ?>
                <div id="site-description"><?php echo htmlspecialchars($sitedesc);?></div>
                <?php endif; ?>  
            </div><!-- /logo -->
        	<?php if ($this->countModules('top')) : ?>
            <div id="top" class="col span_8">
				<jdoc:include type="modules" name="top" style="none" />
			</div>
        	<?php endif; ?>
           <! <?php include "social.php"; ?>
    	</div>
</div>
<?php $menu = $app->getMenu(); if ($menu->getActive() == $menu->getDefault()) { ?>
<div class="business"><?php jlink(); ?></div>
<?php } ?>  
<?php if ($this->countModules('menu')) : ?>
<div id="navbar-wrap">
    <nav id="navbar" class="container row clr">
    	<div id="navigation" class="span_12 col clr"> 
        	<jdoc:include type="modules" name="menu" style="menu" />
         </div>            
    </nav>
</div>
<div class="clr"></div>
<?php endif; ?>
       
<?php if (is_array($menuid) && !is_null($menu->getActive()) && in_array($menu->getActive()->id, $menuid, false)) { ?>
            <div id="slide-wrap" class="container row clr">
                    <?php include "slideshow.php"; ?>
            </div>
<?php } ?>
 
      
		<?php if ($this->countModules('user1')) : ?>
            <div id="user1-wrap"><div id="user1" class="container row clr">
            	<jdoc:include type="modules" name="user1" style="usergrid" grid="<?php echo $user1_width; ?>" />
            </div></div>
        <?php endif; ?>
        <?php if ($this->countModules('breadcrumbs')) : ?>
        	<jdoc:include type="modules" name="breadcrumbs"  style="none"/>
        <?php endif; ?>
<div id="box-wrap" class="container row clr">
	<div id="main-content" class="row span_12">
							<?php if ($this->countModules('left')) : ?>
                            <div id="leftbar-w" class="col span_3 clr">
                            	<div id="sidebar">
                                	<jdoc:include type="modules" name="left" style="grid" />
                            	</div>
                            </div>
                            <?php endif; ?>
                                <div id="post" class="col span_<?php echo $compwidth ?> clr">
                                    <div id="comp-wrap">
                                        <jdoc:include type="message" />
                                        <jdoc:include type="component" />
                                    </div>
                                </div>
							<?php if ($this->countModules('right')) : ?>
                            <div id="rightbar-w" class="col span_3 clr">
                            	<div id="sidebar">
                                	<jdoc:include type="modules" name="right" style="grid" />
                            	</div>
                            </div>
                            <?php endif; ?>
	</div>
</div>

		<?php if ($this->countModules('user2')) : ?>
            <div id="user2-wrap"><div id="user2" class="container row clr">
            	<jdoc:include type="modules" name="user2" style="usergrid" grid="<?php echo $user2_width; ?>" />
            </div></div>
        <?php endif; ?>
        
<div id="footer-wrap"  class="container row clr" >
        <?php if ($this->countModules('copyright')) : ?>
            <div class="copyright">
                <jdoc:include type="modules" name="copyright"/>
            </div>
        <?php endif; ?>
        <?php if ($this->countModules('footer-menu')) : ?>
            <div id="footer-nav">           
				<jdoc:include type="modules" name="footer-menu" style="none" />
            </div>
        <?php endif; ?>                
</div>
</div>
</body>
</html>