<div style="border-bottom: 1px solid #CCC;background: #F7F7F7;padding: 10px;">
	<div style="float: right;">
		<a href="/<?php echo Kernel::get("controller") ?>/list">List</a>
		<a href="/<?php echo Kernel::get("controller") ?>/show">show</a>
		<a href="/<?php echo Kernel::get("controller") ?>/add">add</a>
		<a href="/<?php echo Kernel::get("controller") ?>/update">update</a>
		<a href="/<?php echo Kernel::get("controller") ?>/delete">delete</a>
	</div>
	<span style="font-size: 1.2em;">
		<?php echo Kernel::get("action")." a ".Kernel::get("controller"); ?>
	</span>
</div>
<div style="height: 1px;width: 100%;border-top: 1px solid #F2F2F2;">
</div>