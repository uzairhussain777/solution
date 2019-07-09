<?php echo Modules::run('header/Header/homepage'); ?>
<body>
<div class="wrapper">
    <header class="header categories-banner">
        <?php echo Modules::run('top_menu/top_menu/homepage'); ?>
        <?php echo Modules::run('categories_content/categories_content/viewstorydetails'); ?>
        <?php echo Modules::run('footer/footer/homepage'); ?>

</div>
<?php echo Modules::run('additional_js/additional_js/homepage'); ?>
</body>