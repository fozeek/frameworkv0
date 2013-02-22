<div>
	<style type="text/css">
		#text-page {
			line-height: 25px;
			text-indent: 25px;
		}

		#text-page .title {
			margin: 20px 0;
			color: rgb(51,86,129);
			font-size: 40px;line-height: 44px;
			font-weight: bold;
			text-indent: 10px;
			text-shadow: 0 1px 0px rgba(0,0,0,0.6);
		}

		.color-grey {
			color: grey;
		}

		#text-page .sub-title {
			margin: 10px 0;
			color: rgb(51,86,129);
			font-size: 25px;line-height: 34px;
			font-weight: bold;
			text-shadow: 0 1px 0px rgba(0,0,0,0.6);
		}
	</style>

	<div id="text-page">
		<?php echo $page->get("text"); ?>
	</div>
</div>