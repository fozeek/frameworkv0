<footer>
	<div id="top-footer">
		<div class="footer-box-container">
			<div id="left-top-footer" class="footer-box">
				<h2><?php echo PARTNER_LINKS; ?> :</h2>
				<a href="http://www.grafikart.fr/">Grafikart</a>
				<a href="http://www.siteduzero.com/">Site du zéro</a>
				<a href="http://www.alsacreations.com/">Alsacréation</a>
				<a href="http://stackoverflow.com/">Stackoverflow</a>
				<a href="http://www.developpez.com/">Développez.com</a>
			</div>
			
			<div id="middle-top-footer" class="footer-box">
				<h2><?php echo USEFUL_LINKS; ?> :</h2>
				<a href="<?php echo Kernel::getUrl("page/about"); ?>"><?php echo ABOUT; ?></a>
				<a href="<?php echo Kernel::getUrl("page/contact"); ?>"><?php echo CONTACT_US; ?></a>
				<a href="<?php echo Kernel::getUrl("page/sitemap"); ?>"><?php echo SITEMAP; ?></a>
				<a href="<?php echo Kernel::getUrl("page/partners"); ?>"><?php echo PARTNERS; ?></a>
			</div>
			
			<div id="right-top-footer" class="footer-box">
				<h2><?php echo FOLLOW_NEWS; ?> :</h2>
				<a href="https://twitter.com/webtuts_fr">Twitter</a>
				<a href="https://www.facebook.com/webtuts.fr">Facebook</a>
				<a href="<?php echo Kernel::getUrl("blog/rss"); ?>"><?php echo RSS; ?></a>
				<a href="#"><?php echo NEWSLETTERS; ?></a>
			</div>
		</div>
			<div class="cl"></div>
	</div>
	
	<div id="bottom-footer">
		<p><?php echo COPYRIGHTS; ?> - Webtuts 2012</p>
	</div>
</footer>