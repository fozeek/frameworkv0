<script type="text/javascript" src="/site/backend/themes/default/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
	theme_advanced_fonts : "Andale Mono=andale mono,times;"+
                "Arial=arial,helvetica,sans-serif;"+
                "Arial Black=arial black,avant garde;"+
                "Book Antiqua=book antiqua,palatino;"+
                "Comic Sans MS=comic sans ms,sans-serif;"+
                "Courier New=courier new,courier;"+
                "Georgia=georgia,palatino;"+
                "Helvetica=helvetica;"+
                "Impact=impact,chicago;"+
                "Symbol=symbol;"+
                "Tahoma=tahoma,arial,helvetica,sans-serif;"+
                "Terminal=terminal,monaco;"+
                "Times New Roman=times new roman,times;"+
                "Trebuchet MS=trebuchet ms,geneva;"+
                "Verdana=verdana,geneva;"+
                "Webdings=webdings;"+
		"Segoe ui=Segoe UI light, verdana;"+
		"Ubuntu-c=Ubuntu-C, arial;",
	    
	theme_advanced_font_sizes : "10px,12px,14px,16px,18px,20px,22px,24px",

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});
</script>




<?php partial("content_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;margin-bottom: 10px;">
		<div style="font-size: 1.6em;float: left;">
			<?php echo ucfirst(text("add_an_article")); ?>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<form action="" method="post">
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("title")); ?> (fr)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="titlefr" type="text"/>
		</div>
		<div style="clear: left;">
		</div>
		
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("title")); ?> (en)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="titleen" type="text"/>
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("text")); ?> (fr)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<textarea name="textfr"></textarea>
		</div>
		<div style="clear: left;">
		</div>
		
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("text")); ?> (en)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<textarea name="texten"></textarea>
		</div>
		<div style="clear: left;">
		</div>
		
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("category")); ?>
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<select name="category">
				<?php foreach($categories as $category){ ?>
					<option value=<?php echo $category->get('id'); ?> ><?php echo lang($category->get('name')); ?></option>
				<?php } ?>
			</select>
		</div>
		<div style="clear: left;">
		</div>
		
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("node")); ?>
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<select name="node">
				<?php foreach($nodes as $node){ ?>
					<option value=<?php echo $node->get('id'); ?> ><?php echo lang($node->get('name')); ?></option>
				<?php } ?>
			</select>
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