<?php echo Modules::run('header/Header/homepage'); ?>
<body>
	<div class="wrapper">
		<header class="header">
		<?php echo Modules::run('top_menu/top_menu/homepage'); ?>		
		<?php echo Modules::run('home_content/home_content/homepage'); ?>
		<?php echo Modules::run('footer/footer/homepage'); ?> 
		
	</div>
<?php echo Modules::run('additional_js/additional_js/homepage'); ?>
</body>