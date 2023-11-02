<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
}


add_filter( 'wp_nav_menu_items', 'add_admin_link', 10, 2 );

function add_admin_link( $items, $args ) {
    if (is_user_logged_in() && $args->theme_location == 'primary') {
        // Trouver le premier élément <li> dans $items
        preg_match('/<li.*?<\/li>/', $items, $matches);
        $first_li = $matches[0];

        // Créer le nouveau lien admin
        $admin_link = '<li class="admin"><a href="'. get_admin_url() .'">Admin</a></li>';

        // Insérer le lien admin après le premier élément <li>
        $items = preg_replace('/'.preg_quote($first_li, '/').'/', $first_li . $admin_link, $items, 1);
    }
    return $items;
}