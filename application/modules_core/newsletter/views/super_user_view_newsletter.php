<?php echo Modules::run('header/Header/super_user'); ?>
<body class="pace-done mini-navbar">
<div id="wrapper">
	<?php echo Modules::run('left_sidebar/left_sidebar/super_user'); ?>
        <div id="page-wrapper" class="gray-bg">
        	<?php echo Modules::run('top_menu/top_menu/super_user'); ?>
            <?php echo Modules::run('newsletter_content/newsletter_content/viewnewsletter'); ?> 
            <?php echo Modules::run('footer/footer/super_user'); ?> 
        </div>
</div>

</body>
<?php echo Modules::run('additional_js/additional_js/super_user'); ?>
</html>