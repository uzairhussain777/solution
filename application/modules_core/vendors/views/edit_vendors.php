<?php echo Modules::run('header/header/admin'); ?>
<?php echo Modules::run('additional_js/additional_js/admin'); ?>

<body class="pace-done mini-navbar">
<div id="wrapper">
		<?php echo Modules::run('left_sidebar/left_sidebar/admin'); ?>

        <div id="page-wrapper" class="gray-bg">
        	<?php echo Modules::run('top_menu/top_menu/admin'); ?>
            <?php echo Modules::run('vendors_content/vendors_content/admin_edit_vendors'); ?> 
            <?php echo Modules::run('footer/footer/admin'); ?> 
        </div>
        
</div>
</body>
</html>
