<?php
namespace Ew_Product_Countdown\Helpers;

if ( ! defined( 'ABSPATH' ) ) {
    exit();
}
class Functions
{

    public static function get_authors() {
        $authors = get_users(array(
            'role__in' => array('author', 'administrator', 'editor', 'contributor')
        ));
        $options = array();
        foreach ($authors as $author) {
            $options[$author->ID] = $author->display_name;
        }
        return $options;
    }
}


