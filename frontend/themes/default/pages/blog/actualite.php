<!-- News page -->


<div id="actualite-page">
    <div class="middle-column">
	<div class="border-big-title">
	    <h1 class="left-title big-title">
		<?php echo $news->get("title"); ?>
	    </h1>
	    <div class="cl"></div>
	</div>
	
	<div class="article-content">
	    <h4>
		<span class="date"><?php echo PUBLISHED . " " . format_date($news->get("date")); ?></span>
		<span class="date"><?php echo BY; ?></span>
		<span class="author"><a href="<?php echo Kernel::getUrl("user/profil/" . $news->get("author")->get("pseudo")); ?>"><?php echo $news->get("author")->get("pseudo"); ?></a></span>
	    </h4>
	    <div class="article-tags right">
		<?php 
		    foreach($news->get("tags") as $tag) {
		?>
			<a href="<?php echo Kernel::getUrl("blog/tag/" . $tag->get("name")); ?>" class="article-tag">
			    <?php echo $tag->get("name"); ?>
			</a>
		<?php
		    }
		?>
	    </div>
	    <div class="cl"></div>
	    <p>
		<?php echo nl2br($news->get("text")); ?>
	    </p>
	</div>
	
	<div id="ancre-comments" class="article-comments">
	    <?php
		$text_comment = (count($news->get("comments")) > 0 ? COMMENTS_LIST : NO_COMMENT);
	    ?>
	    <h2><?php echo $text_comment; ?></h2>
	    <?php
		foreach($news->get("comments") as $comment){
		    $url_image = get_url_image($comment->get("author"));
		    $alt_image = "avatar de " . $comment->get("author")->get("pseudo");
	    ?>
	    <div class="one-comment">
		<div class="comment-user-image">
		    <img src="<?php echo $url_image; ?>" alt="<?php echo $alt_image;?>" width="100px" />
		</div>
		<div class="comment-body">
		    <div class="comment-header">
			<span class="author"><a href="#"><?php echo $comment->get("author")->get("pseudo"); ?></a></span>
			<span class="date"><?php echo PUBLISH . " " . format_date($comment->get("date")); ?></span>
		    </div>
		    <p><?php echo $comment->get("text"); ?></p>
		</div>
		
		<div class="cl"></div>
	    </div>
	    <?php
		}
	    ?>
	</div>
    </div>
</div>