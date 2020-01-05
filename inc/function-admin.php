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
    add_submenu_page('sunset_theme', 'Sunset Theme Options', 'General', 'manage_options', 'sunset_theme', 'sunset_theme_create_page');
    add_submenu_page('sunset_theme', 'Sunset CSS Options', 'Custom CSS', 'manage_options', 'sunset_theme_css', 'sunset_theme_settings_page');

    //Activate custom settings
    add_action('admin_init', 'sunset_custom_settings');
}
add_action('admin_menu', 'sunset_add_admin_page');

function sunset_custom_settings()
{
    register_setting('sunset-setting-group', 'first_name');
    register_setting('sunset-setting-group', 'last_name');
    register_setting('sunset-setting-group', 'twitter_handler', 'sunset_sanitize_twitter_handler');
    register_setting('sunset-setting-group', 'facebook_handler');
    register_setting('sunset-setting-group', 'gplus_handler');

    add_settings_section('sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'sunset_theme');
    add_settings_field('sidebar-name', 'Full Name', 'sunset_sidebar_name', 'sunset_theme', 'sunset-sidebar-options');
    add_settings_field('sidebar-twitter', 'Twitter handler', 'sunset_sidebar_twitter', 'sunset_theme', 'sunset-sidebar-options');
    add_settings_field('sidebar-facebook', 'Facebook handler', 'sunset_sidebar_facebook', 'sunset_theme', 'sunset-sidebar-options');
    add_settings_field('sidebar-gplus', 'Google+ handler', 'sunset_sidebar_gplus', 'sunset_theme', 'sunset-sidebar-options');
}
function sunset_sidebar_options()
{
    echo "Customize your Sidebar Information";
}
function sunset_sidebar_name()
{
    $first_name = esc_attr(get_option('first_name'));
    $last_name = esc_attr(get_option('last_name'));
    echo "<input type='text' name='first_name' value='$first_name' placeholder='First Name' /> <input type='text' name='last_name' value='$last_name' placeholder='Last Name' />";
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

function sunset_theme_create_page()
{
    //generation of our admin page    
    require_once(get_template_directory() . '/inc/templates/sunset-admin.php');
}
function sunset_theme_settings_page()
{
    //generation of our admin page    
}
