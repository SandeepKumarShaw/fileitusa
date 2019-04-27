<?php

/*C R E A T E     A  Package Selection    P A G E*/
    global $wpdb;

    $the_page_title = 'Package Selection';
    $the_page_name = 'package-selection';

    // the menu entry...
    delete_option("my_plugin_page_title");
    add_option("my_plugin_page_title", $the_page_title, '', 'yes');
    // the slug...
    delete_option("my_plugin_page_name");
    add_option("my_plugin_page_name", $the_page_name, '', 'yes');
    // the id...
    delete_option("my_plugin_page_id");
    add_option("my_plugin_page_id", '0', '', 'yes');

    $the_page = get_page_by_title( $the_page_title );
    if ( ! $the_page ) {

        // Create post object
        $_p = array();
        $_p['post_title'] = $the_page_title;
        $_p['post_content'] = "[WP_FIUPS_shortcode]";
        $_p['post_status'] = 'publish';
        $_p['post_type'] = 'page';
        $_p['comment_status'] = 'closed';
        $_p['ping_status'] = 'closed';
        $_p['post_category'] = array(1); // the default 'Uncatrgorised'

        // Insert the post into the database
        $the_page_id = wp_insert_post( $_p );

    }
    else {
        // the plugin may have been previously active and the page may just be trashed...

        $the_page_id = $the_page->ID;

        //make sure the page is not trashed...
        $the_page->post_status = 'publish';
        $the_page_id = wp_update_post( $the_page );

    }
/*  E N D  */



    delete_option( 'my_plugin_page_id' );
    add_option( 'my_plugin_page_id', $the_page_id );



/*C R E A T E     A    Package Selection Payment    P A G E*/
   // global $wpdb;

    $the_page_vo_title = 'Package Selection Payment';
    $the_page_vo_name = 'package-selection-payment';

    // the menu entry...
    delete_option("my_plugin_page_title");
    add_option("my_plugin_page_title", $the_page_vo_title, '', 'yes');
    // the slug...
    delete_option("my_plugin_page_name");
    add_option("my_plugin_page_name", $the_page_vo_name, '', 'yes');
    // the id...
    delete_option("my_plugin_page_id");
    add_option("my_plugin_page_id", '0', '', 'yes');

    $the_page = get_page_by_title( $the_page_vo_title );
    if ( ! $the_page ) {

        // Create post object
        $_p = array();
        $_p['post_title'] = $the_page_vo_title;
        $_p['post_content'] = "[WP_FIUMS_shortcode]";
        $_p['post_status'] = 'publish';
        $_p['post_type'] = 'page';
        $_p['comment_status'] = 'closed';
        $_p['ping_status'] = 'closed';
        $_p['post_category'] = array(1); // the default 'Uncatrgorised'

        // Insert the post into the database
        $the_page_id = wp_insert_post( $_p );

    }
    else {
        // the plugin may have been previously active and the page may just be trashed...

        $the_page_id = $the_page->ID;

        //make sure the page is not trashed...
        $the_page->post_status = 'publish';
        $the_page_id = wp_update_post( $the_page );

    }
/*  E N D  */



    delete_option( 'my_plugin_page_id' );
    add_option( 'my_plugin_page_id', $the_page_id );    


?>