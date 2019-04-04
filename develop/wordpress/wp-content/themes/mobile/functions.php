<?php
/**
 * Created by PhpStorm.
 * User: Michael PLüss
 * Date: 04.04.2019
 * Time: 13:55
 */

function loadJavaScriptFiles() {
    $script = 'sidebar';
    wp_enqueue_script($script, get_template_directory_uri() . '/js/' . $script . '.js');
    $params = array('template_uri' => get_template_directory_uri());
    wp_localize_script($script, 'params', $params);
    wp_enqueue_script($script);

    $script = 'topbar';
    wp_enqueue_script($script, get_template_directory_uri() . '/js/' . $script . '.js');
    $params = array('template_uri' => get_template_directory_uri());
    wp_localize_script($script, 'params', $params);
    wp_enqueue_script($script);
}



?>