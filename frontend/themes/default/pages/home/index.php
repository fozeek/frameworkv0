<!-- Home page -->

<div id="home-page">
    <!-- Introduction -->
    <div id="explanation-text">
	<div class="border-title">
	    <h1 class="middle-title">
		<?php echo WEBTUTS_TITLE; ?>
	    </h1>
	</div>

	<p>
	    <?php echo WEBTUTS_INTRODUCTION_TEXT; ?>
	</p>
    </div>

    <!-- Categories sum up nav -->
    <div id="categories-box">
	<ul id="categories-nav">
	    <?php 
		foreach($cats as $cat) { 
		    $url_image = get_url_image($cat);
	    ?>
		    <li>
			<a href="<?php echo Kernel::getUrl("blog/category/" . Kernel::sanitize($cat->get("name")));?>">
			    <span><?php echo $cat->get("name"); ?></span>
			    <img src="<?php echo $url_image; ?>" alt="<?php echo ALT_CATEGORY_IMAGE . " " . $cat->get("name"); ?>" width="<?php echo $cat->get("image")->get("width"); ?>" />
			</a>
		    </li>
	    <?php
		}
	    ?>
	</ul>
	<div class="cl"></div>
	
    </div>

    <!-- Home page content -->
    <div id="middle-column">
	<div class="border-title" id="main-title-article">
	    <h1 class="middle-title border-until"><?php echo LAST_ARTICLE; ?></h1>
	</div>
	<?php 
	    foreach($articles as $article) { 
		$url_image = get_url_image($article);
		
		include(_theme_path_ . "partials/bigArticlePreview.php");
	    }
	?>
    </div>

    <!-- Sidebar -->
    <aside>
	<!-- News -->
	<div class="border-title">
	    <h1 class="right-title"><?php echo NEWS_WORD; ?></h1>
	</div>

	<div id="news-box" class="aside-box">
	    <?php
		foreach($news as $new) {
		    include(_theme_path_ . "partials/newsPreview.php");
		}
	    ?>

	    <div class="marginAuto">
		<div class="button big-button">
		    <span>
			<a href="<?php echo Kernel::getUrl("blog/actualites");?>"><?php echo SEE_NEWS; ?></a>
		    </span>
		</div>
	    </div>
	</div>

	<!-- Social -->
	<div class="border-title">
	    <h1 class="right-title"><?php echo FOLLOW_WEBTUTS; ?></h1>
	</div>

	<div id="social-box" class="aside-box">
	    <a target="_blank" href="https://www.facebook.com/webtuts.fr" id="facebook-social">
		Facebook
	    </a>
	    <a target="_blank" href="https://twitter.com/webtuts_fr" id="twitter-social">
		Twitter
	    </a>
	    <a target="_blank" href="<?php echo Kernel::getUrl("blog/rss"); ?>" id="rss-social">
		<?php echo RSS; ?>
	    </a>
	    <a href="#" id="newsletter-social">
		<?php echo NEWSLETTERS; ?>
	    </a>
	    <div class="cl"></div>
	    
	</div>

	<!-- Twitter feedback -->
	<div class="border-title">
	    <h1 class="right-title"><?php echo HAPPENS_ON_TWITTER; ?></h1>
	</div>

	<div id="twitter-box" class="aside-box">
	    <a class="twitter-timeline" href="https://twitter.com/webtuts_fr" data-widget-id="288663232435077120">Tweets de @webtuts_fr</a>
	    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>
    </aside>
    <div class="cl"></div>
    
</div>