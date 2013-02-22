<?php partial("content_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;margin-bottom: 10px;">
		<div style="font-size: 1.6em;float: left;">
			<span style="color: grey;"><?php echo ucfirst(text("article")); ?> :</span> 
			<?php echo strip_tags(lang($article->get("title", $lang))); ?>
		</div>
		<div style="overflow: hidden;padding-top:10px;padding-left: 20px;">
			<form method="post" action="<?php echo Kernel::getURL("article/delete"); ?>" style="margin-left: 20px;display: inline-block; float: right;padding-right: 5px;padding-left: 5px;">
				<input type="hidden" name="id" value="<?php echo $article->get("id"); ?>"/>
				<input type="submit" value=<?php echo ucfirst(text("delete")); ?> style="margin-top: -10px;" />
			</form>
			<?php foreach(Kernel::get("langs") as $key => $langKernel) { ?>
				<a <?php if($lang!=$langKernel) { ?>href="<?php echo createLink("/article/show/".$article->get("id")."/".$langKernel); ?>"<?php } ?> style="float: right;"><?php echo text($langKernel); ?></a> 
				<?php if($key!=count(Kernel::get("langs"))-1) { ?>
				<span style="float: right;">&nbsp;&nbsp;</span> 
				<?php } ?>
			<?php } ?>
			<a href="<?php echo createLink("/article/show/".$article->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("description")); ?></a>
			<a href="<?php echo createLink("/article/update/".$article->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("update")); ?></a>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("title")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo lang($article->get("title", $lang)); ?>
	</div>
	<div style="clear: left;">
	</div>

	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("date")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo printDate($article->get("date")); ?>
	</div>
	<div style="clear: left;">
	</div>

	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("author")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<a href="<?php echo createLink("/user/show/".$article->get("author")->get("id")); ?>"><?php echo lang($article->get("author")->get("pseudo")); ?></a>
	</div>
	<div style="clear: left;">
	</div>

	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("text")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo nl2br(lang($article->get("text", $lang))); ?>
	</div>
	<div style="clear: left;">
	</div>

	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("tags")); ?>
	</div>
	<?php if($tags = $article->get("tags")) : ?>
	<div style="overflow: hidden;padding: 11px 15px;">
		<?php foreach($tags as $tag) : ?>
		<a href="<?php echo createLink("/tag/show/".$tag->get("id")); ?>" style="display: inline-block;padding: 4px 10px;font-size: 0.8em;background-color: rgb(227,223,223);margin-right: 5px;border-radius: 2px;-webkit-border-radius: 2px;-moz-border-radius: 2px;-o-border-radius: 2px;-ms-border-radius: 2px;">	
			<?php echo lang($tag->get("name", $lang)); ?><br />
		</a>
		<?php endforeach; ?>
	</div>
	<?php else: ?>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo ucfirst(text("no_tags")); ?>
	</div>
	<?php endif; ?>
	<div style="clear: left;">
	</div>
</div>