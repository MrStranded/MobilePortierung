<?php
/**
 * Created by PhpStorm.
 * User: Michael PLüss
 * Date: 04.04.2019
 * Time: 13:55
 */



function initialize() {
    loadJavaScriptFiles();
    initializeShortCode();
}

/**
 * If we want to use a javascript file in the Mobile theme, we have to load it here.
 */
function loadJavaScriptFiles() {
    loadScriptFile('shortcode');
    loadScriptFile('sidebar');
    loadScriptFile('topbar');
}

/**
 * We use this script loading method because we want to register certain wordpress parameters (namely the site url)
 * in the javascript files for us to use there.
 * @param $script File name of the javascript file in the /js folder
 */
function loadScriptFile($script) {
    wp_enqueue_script("mobile_theme_" . $script, get_template_directory_uri() . '/js/' . $script . '.js');
    $params = array('template_uri' => get_template_directory_uri());
    wp_localize_script($script, 'params', $params);
    wp_enqueue_script($script);
}

// ---------------------------------------------------------------------------------------------------------------------
// |                                           Custom Mobile Short Codes                                               |
// ---------------------------------------------------------------------------------------------------------------------

function initializeShortCode() {
    add_shortcode('customAccordeon', 'customAccordeon');
}

function customAccordeon($atts, $content = "") {
    $attributes = shortcode_atts(
        array(
            'id' => 'shortCodeNoID',
            'text' => 'Accordeon',
            'class' => 'mobile-shortcodes-default',
        ),
        $atts
    );

    $output = "";
    $output .= '<div>';
    $output .= '<div class="' . $attributes['class'] . '" onclick="changeDivVisibility(\'' . $attributes['id'] . '\');">';
    $output .= json_decode('"\uf8ff"') . ' ' . $attributes['text'] . '</div>';
    $output .= '<div id="' . $attributes['id'] . '">' . $content . '</div>';
    $output .= '</div>';
    return $output;
}



?>