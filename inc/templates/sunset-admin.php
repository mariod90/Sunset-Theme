<div class="wrap">
    <h1>Sunset Theme Options</h1>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php
        settings_fields('sunset-setting-group');
        do_settings_sections('sunset_theme');
        submit_button();
        ?>
    </form>
</div>