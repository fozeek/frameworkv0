<?php partial("content_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;margin-bottom: 10px;">
		<div style="font-size: 1.6em;float: left;">
			<span style="color: grey;"><?php echo ucfirst(text("article")); ?> :</span> 
			<?php echo strip_tags(lang($article->get("title"))); ?>
		</div>
		<div style="overflow: hidden;padding-top:10px;padding-left: 20px;">
			<form method="post" action="<?php echo Kernel::getURL("article/delete"); ?>" style="margin-left: 20px;display: inline-block; float: right;padding-right: 5px;padding-left: 5px;">
				<input type="hidden" name="id" value="<?php echo $article->get("id"); ?>"/>
				<input type="submit" value=<?php echo ucfirst(text("delete")); ?> style="margin-top: -10px;" />
			</form>
			<a href="<?php echo createLink("/article/show/".$article->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("description")); ?></a>
			<a href="<?php echo createLink("/article/update/".$article->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("update")); ?></a>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<form action="" method="post">
		<input type="hidden" name="id" value="<?php echo $article->get("id"); ?>"/>
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("title")); ?> (fr)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="titlefr" type="text" value="<?php echo lang($article->get("title", "fr")); ?>"/>
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("text")); ?> (fr)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<textarea name="textfr"><?php echo lang($article->get("text", "fr")); ?></textarea>
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("title")); ?> (en)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="titleen" type="text" value="<?php echo lang($article->get("title", "en")); ?>"/>
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("text")); ?> (en)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<textarea name="texten"><?php echo lang($article->get("text", "en")); ?></textarea>
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input type="submit" value="<?php echo ucfirst(text("save")); ?>">
		</div>
		<div style="clear: left;">
		</div>
	</form>
</div>