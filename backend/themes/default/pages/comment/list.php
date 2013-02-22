<?php partial("content_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;">
		<div style="font-size: 1.6em;float: left;">
			<?php echo ucfirst(text("comments")); ?>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<?php foreach ($comments as $comment) : ?>
	<div class="itemlist showmore" style="cursor: pointer;">	
		<input class="close" type="button" style="display: none;float: right;" value="-" />
		<div class="titleitem" style="float: left;width: 200px;">
			<a href="<?php echo createLink("/user/show/".$comment->get("author")->get("id")); ?>"><?php echo $comment->get("author")->get("pseudo"); ?></a>
			<span style="display: none;font-size: 0.8em;"><?php echo "Le ".printdate($comment->get("date")); ?></span>
		</div>
		<div class="descriptionitem" style="overflow: hidden;padding-top: 1px;padding-left: 10px;position: relative;">
			<span><?php echo lang($comment->get("article")->get("title")); ?></span>
			<span class="textcomment" style="margin-top: 10px;font-size: 0.8em;color: grey;display :none;"><?php echo $comment->get("text"); ?></span>		
			<form method="post" action="<?php echo Kernel::getURL("comment/delete"); ?>">
				<input type="hidden" name="id" value="<?php echo $comment->get("id"); ?>"/>
				<input type="submit" value="Supprimer" style="display: none; margin-top: 10px;" />
			</form>
		</div>
		<div style="clear: both;">
		</div>
	</div>
	<?php endforeach; ?>

</div>