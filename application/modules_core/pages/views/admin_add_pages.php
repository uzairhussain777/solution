<?php echo Modules::run('header/Header/admin'); ?>
<body class="pace-done mini-navbar">
<div id="wrapper">
	<?php echo Modules::run('left_sidebar/left_sidebar/admin'); ?>
        <div id="page-wrapper" class="gray-bg">
        	<?php echo Modules::run('top_menu/top_menu/admin'); ?>
            <?php echo Modules::run('pages_content/pages_content/super_user_add_pages_view'); ?> 
            <?php echo Modules::run('footer/footer/super_user'); ?> 
        </div>
</div>

</body>
<?php echo Modules::run('additional_js/additional_js/admin'); ?>
</html>