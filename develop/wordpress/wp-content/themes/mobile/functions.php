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
    loadScript('sidebar');
    loadScript('topbar');
    loadScript('shortcode');
}

/**
 * We use this script loading method because we want to register certain wordpress parameters (namely the site url)
 * in the javascript files for us to use there.
 * @param $script File name of the javascript file in the /js folder
 */
function loadScript($script) {
    wp_enqueue_script($script, get_template_directory_uri() . '/js/' . $script . '.js');
    $params = array('template_uri' => get_template_directory_uri());
    wp_localize_script($script, 'params', $params);
    wp_enqueue_script($script);
}

// ---------------------------------------------------------------------------------------------------------------------
// |                                           Custom Mobile Short Codes                                               |
// ---------------------------------------------------------------------------------------------------------------------

function initializeShortCode() {
    add_shortcode('helloworld', 'testShortCode');
    add_shortcode('customAccordeon', 'customAccordeon');
}

function testShortCode($atts) {
    $attributes = shortcode_atts(
        array('name' => 'world'),
        $atts
    );
    return 'Hello ' . $attributes['name'];
}

function customAccordeon($atts, $content = "") {
    $attributes = shortcode_atts(
        array(
            'id' => 'shortCodeNoID',
            'text' => 'Accordeon'
        ),
        $atts
    );

    $output = "";
    $output .= '<div>';
    $output .= '<div class="csct" onclick="changeDivVisibility(\'' . $attributes['id'] . '\');">';
    //$output .= '<div class="csct" onclick="alert(\'test\')");">';
    $output .= $attributes['text'] . '</div>';
    $output .= '<div class="cscc" id="' . $attributes['id'] . '">' . $content . '</div>';
    $output .= '</div>';
    return $output;
}



?>