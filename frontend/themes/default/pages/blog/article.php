<!-- Article page -->

<div id="article-page">
    <div class="middle-column">
	<div class="border-big-title">
	    <h1 class="left-title big-title">
		<?php echo $article->get("title"); ?>
	    </h1>
	    <div class="cl"></div>
	</div>
	
	<div class="article-content">
	    <h4>
		<span class="date"><?php echo PUBLISHED . " " . format_date($article->get("date")); ?></span>
		<span class="date"><?php echo BY; ?></span>
		<span class="author"><a href="<?php echo Kernel::getUrl("user/profil/" . $article->get("author")->get("pseudo")); ?>"><?php echo $article->get("author")->get("pseudo"); ?></a></span>
	    </h4>
	    <div class="article-tags right">
		<?php 
		    foreach($article->get("tags") as $tag) {
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
		<?php echo nl2br($article->get("text")); ?>
	    </p>
	</div>
	
	<div id="ancre-comments" class="article-comments">
	    <?php
		$text_comment = (count($article->get("comments", array("orderBy" => "date"))) > 0 ? COMMENTS_LIST : NO_COMMENT);
	    ?>
	    <h2><?php echo $text_comment; ?></h2>
	    <?php
		foreach($article->get("comments") as $comment){
		    $default_image = '/' . _theme_path_ . 'images/' . 'article-image.png';
		    $image = md5(strtolower(trim($comment->get("author")->get("mail"))));
		    
		    $url_image = 'http://www.gravatar.com/avatar/' . $image . '?d=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . $default_image);
		    $alt_image = AVATAR . " " . $comment->get("author")->get("pseudo");
	    ?>
	    <div class="one-comment">
		<div class="comment-user-image">
		    <img src="<?php echo $url_image; ?>" alt="<?php echo $alt_image;?>" width="100px" />
		</div>
		<div class="comment-body">
		    <div class="comment-header">
			<span class="author"><a href="<?php echo Kernel::getUrl("user/profil/" . $comment->get("author")->get("pseudo")); ?>"><?php echo $comment->get("author")->get("pseudo"); ?></a></span>
			<span class="date"><?php echo PUBLISH . " " . format_date($comment->get("date")); ?></span>
		    </div>
		    <p><?php echo $comment->get("text"); ?></p>
		</div>
		
		<div class="cl"></div>
	    </div>
	    <?php
		}
	    ?>
	    <?php 
		if($user = Kernel::get("user")) { 
		    $default_image = '/' . _theme_path_ . 'images/' . 'article-image.png';
		    $image = md5(strtolower(trim($user->get("mail"))));
		    
		    $url_image = 'http://www.gravatar.com/avatar/' . $image . '?d=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . $default_image);
		    $alt_image = AVATAR . " " . $user->get("pseudo");
	    ?>
	   	<div class="one-comment" style="background: #f2f2f2;">
			<div class="comment-user-image">
			    <img src="<?php echo $url_image; ?>" alt="<?php echo $alt_image;?>" width="100px" />
			</div>
		    
			<div class="comment-body">
			    <div class="comment-header">
				<span class="author"><a href="<?php echo Kernel::getUrl("user/profil/" . $user->get("pseudo")); ?>" id="pseudo-text"><?php echo $user->get("pseudo"); ?></a></span>
			    </div>
			    
			    <form method="post" action="" id="post-comment">
				<textarea class="textarea" placeholder="Votre commentaire ici." name="message-text" id="message-text"></textarea>

				<input type="hidden" name="user" value="<?php echo $user->get("pseudo"); ?>" />
				<input type="hidden" name="article" id="article-comment-value" value="<?php echo $article->get("id"); ?>"/>

				<div class="cl"></div>
				<div class="marginAuto">
				    <div class="button big-button">
					<span>
					    <input id="send-comment" type="submit" value="Envoyer" />
					</span>
				    </div>
			       </div>
			    </form>
			</div>
			
			<div class="cl"></div>
	    </div>
	    <?php } ?>

	</div>
    </div>
</div>