<div id="sitemap-page">
<!-- sitemap content -->
    <div class="middle-column">
	<div class="border-big-title">
		<h1 class="left-title big-title">
		    <?php echo SITEMAP ?>
		</h1>
	    <div class="cl"></div>
	</div>
	
	<div class="sitemap-container">
	    <div class="category-sitemap">
		    <h2 >Webtuts</h2>
		    <br />
		    <p>
			<a href="<?php echo Kernel::getUrl("page/about"); ?>"><?php echo ABOUT; ?></a><br />
			<a href="<?php echo Kernel::getUrl("page/contact"); ?>"><?php echo CONTACT_US; ?></a><br />
			<a href="<?php echo Kernel::getUrl("page/partners"); ?>"><?php echo PARTNERS; ?></a><br />
		    </p>
	    </div>
	    <div class="category-sitemap">
		    <h2 ><?php echo BLOG; ?></h2>
		    <br />
		    <p>
			<a href="<?php echo Kernel::getUrl("blog/categories"); ?>"><?php echo SEE_CATEGORIES; ?></a><br />
			<a href="<?php echo Kernel::getUrl("blog/tags"); ?>"><?php echo SEE_TAGS; ?></a><br />
			<a href="<?php echo Kernel::getUrl("blog/articles"); ?>"><?php echo SEE_ARTICLES; ?></a><br />
			<a href="<?php echo Kernel::getUrl("blog/actualites"); ?>"><?php echo SEE_NEWS; ?></a><br />
			<a href="<?php echo Kernel::getUrl("blog/rss"); ?>"><?php echo RSS; ?></a><br />
		    </p>
	    </div>
	    <div class="category-sitemap">
		    <h2><?php echo COMMUNITY; ?></h2>
		    <br />
		    <p>
			<a href="<?php echo Kernel::getUrl("user/connection"); ?>"><?php echo CONNECTION; ?></a><br />
			<a href="<?php echo Kernel::getUrl("user/subscription"); ?>"><?php echo INSCRIPTION; ?></a><br />
		    </p>

	    </div>
	    <div style="clear: left;">
	    </div>
	</div>
    </div>
</div>