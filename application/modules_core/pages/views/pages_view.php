<?php echo Modules::run('header/Header/homepage'); ?>
<?php echo Modules::run('additional_js/additional_js/homepage'); ?>
<body>
	<?php echo Modules::run('top_menu/top_menu/aboutustopmenu'); ?>
	<div class="wrapper">
			<header class="header about-us-banner">
		<?php echo Modules::run('top_menu/top_menu/homepage'); ?>
		<?php echo Modules::run('pages_content/pages_content/page_details'); ?>
		<?php echo Modules::run('footer/footer/homepage'); ?> 
	</div>
</body>