<?php

/*
@package sunset-theme

===========================
    ADMIN PAGE
===========================
*/

function sunset_add_admin_page()
{
    //Generate Sunset Admin Page
    add_menu_page('Sunset Theme Options', 'Sunset', 'manage_options', 'sunset_theme', 'sunset_theme_create_page', get_template_directory_uri() . '/img/sunset-icon.png', 110);

    //Generate Sunset Admin Subpage
    add_submenu_page('sunset_theme', 'Sunset Sidebar Options', 'Sidebar', 'manage_options', 'sunset_theme', 'sunset_theme_create_page');
    add_submenu_page('sunset_theme', 'Sunset CSS Options', 'Custom CSS', 'manage_options', 'sunset_theme_css', 'sunset_theme_settings_page');
    add_submenu_page('sunset_theme', 'Sunset Theme Options', 'Theme Options', 'manage_options', 'sunset_theme_options', 'sunset_theme_support_page');

    //Activate custom settings
    add_action('admin_init', 'sunset_custom_settings');
}
add_action('admin_menu', 'sunset_add_admin_page');

function sunset_custom_settings()
{
    //Sidebar Options
    register_setting('sunset-setting-group', 'profile_picture');
    register_setting('sunset-setting-group', 'first_name');
    register_setting('sunset-setting-group', 'last_name');
    register_setting('sunset-setting-group', 'user_description');
    register_setting('sunset-setting-group', 'twitter_handler', 'sunset_sanitize_twitter_handler');
    register_setting('sunset-setting-group', 'facebook_handler');
    register_setting('sunset-setting-group', 'gplus_handler');

    add_settings_section('sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'sunset_theme');

    add_settings_field('sidebar-profile-picture', 'Profile Picture', 'sunset_sidebar_profile', 'sunset_theme', 'sunset-sidebar-options');
    add_settings_field('sidebar-name', 'Full Name', 'sunset_sidebar_name', 'sunset_theme', 'sunset-sidebar-options');
    add_settings_field('sidebar-description', 'Description', 'sunset_sidebar_description', 'sunset_theme', 'sunset-sidebar-options');
    add_settings_field('sidebar-twitter', 'Twitter handler', 'sunset_sidebar_twitter', 'sunset_theme', 'sunset-sidebar-options');
    add_settings_field('sidebar-facebook', 'Facebook handler', 'sunset_sidebar_facebook', 'sunset_theme', 'sunset-sidebar-options');
    add_settings_field('sidebar-gplus', 'Google+ handler', 'sunset_sidebar_gplus', 'sunset_theme', 'sunset-sidebar-options');

    //Theme Support
    register_setting('sunset-theme-support', 'post_formats', 'sunset_post_formats_callback');

    add_settings_section('sunset-theme-options', 'Theme Options', 'sunset_theme_options', 'section_sunset_theme_support');

    add_settings_field('post-formats', 'Post Formats', 'sunset_post_formats', 'section_sunset_theme_support', 'sunset-theme-options');
}
//Posts Formats Callback Function
function sunset_post_formats_callback($input)
{
    return $input;
}
function sunset_theme_options()
{
    echo "Activate and Deactivate specific Theme Support Options";
}
function sunset_post_formats()
{
    $options = get_option('post_formats');
    $formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
    $output = '';
    foreach ($formats as $format) {
        $checked = (@$options[$format] == 1) ? 'checked' : '';
        $output .= '<label><input type="checkbox" id="' . $format . '" name="post_formats[' . $format . ']" value="1" ' . $checked . ' />' . $format . '</label><br>';
    }
    echo $output;
}

//Sidebar Options Functions
function sunset_sidebar_options()
{
    echo "Customize your Sidebar Information";
}
function sunset_sidebar_profile()
{
    $picture = esc_attr(get_option('profile_picture'));
    echo "<input type='button' class='button button-secondary' value='Upload Profile Picture' id='upload-button' /><input type='hidden' id='profile-picture' name='profile_picture' value='$picture' placeholder='First Name' />";
}
function sunset_sidebar_name()
{
    $first_name = esc_attr(get_option('first_name'));
    $last_name = esc_attr(get_option('last_name'));
    echo "<input type='text' name='first_name' value='$first_name' placeholder='First Name' /> <input type='text' name='last_name' value='$last_name' placeholder='Last Name' />";
}
function sunset_sidebar_description()
{
    $description = esc_attr(get_option('user_description'));
    echo "<input type='text' name='user_description' value='$description' placeholder='Description' /><p class='description'>Write something smart.</p>";
}
function sunset_sidebar_twitter()
{
    $twitter = esc_attr(get_option('twitter_handler'));
    echo "<input type='text' name='twitter_handler' value='$twitter' placeholder='Twitter handler' /><p class='description'>Input your Twitter username without @ character.</p>";
}
function sunset_sidebar_facebook()
{
    $facebook = esc_attr(get_option('facebook_handler'));
    echo "<input type='text' name='facebook_handler' value='$facebook' placeholder='Facebook handler' />";
}
function sunset_sidebar_gplus()
{
    $gplus = esc_attr(get_option('gplus_handler'));
    echo "<input type='text' name='gplus_handler' value='$gplus' placeholder='Google+ handler' />";
}

//Sanitization settings
function sunset_sanitize_twitter_handler($input)
{
    $output = sanitize_text_field($input);
    $output = str_replace('@', '', $output);
    return $output;
}
//Template submenu functions
function sunset_theme_create_page()
{
    require_once(get_template_directory() . '/inc/templates/sunset-admin.php');
}
function sunset_theme_support_page()
{
    require_once(get_template_directory() . '/inc/templates/sunset-theme-support.php');
}
function sunset_theme_settings_page()
{
    echo '<h1>Sunset Custom CSS</h1>';
}
