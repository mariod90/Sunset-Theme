<div class="wrap">
    <h1>Sunset Sidebar Options</h1>
    <?php
    settings_errors();

    $picture = esc_attr(get_option('profile_picture'));
    $first_name = esc_attr(get_option('first_name'));
    $last_name = esc_attr(get_option('last_name'));
    $full_name = $first_name . ' ' . $last_name;
    $description = esc_attr(get_option('user_description'));
    ?>
    <div class="sunset-sidebar-preview">
        <div class="sunset-sidebar">
            <div class="image-container">
                <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);"></div>
            </div>
            <h1 class="sunset-username"><?php print $full_name; ?></h1>
            <h2 class="sunset-description"><?php print $description; ?></h2>
            <div class="icon-wrapper"></div>
        </div>
    </div>
    <form action="options.php" method="post" class="sunset-general-form">
        <?php
        settings_fields('sunset-setting-group');
        do_settings_sections('sunset_theme');
        submit_button('Save Changes', 'primary', 'btnSubmit');
        ?>
    </form>
</div>