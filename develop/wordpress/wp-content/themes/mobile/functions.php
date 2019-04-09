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

$custom_shortcode_counter = 0;

function initializeShortCode() {
    add_shortcode('customAccordeon', 'customAccordeon');
    add_shortcode('customSubAccordeon', 'customSubAccordeon');
}

function customAccordeon($atts, $content = "") {
    return customAccordeonBase($atts, $content, 0);
}
function customSubAccordeon($atts, $content = "") {
    return customAccordeonBase($atts, $content, 1);
}

function customAccordeonBase($atts, $content, $level) {
    // defining default attributes
    $attributes = shortcode_atts(
        array(
            'id' => 'shortCode_' . $GLOBALS['custom_shortcode_counter'],
            'title' => 'Accordeon',
        ),
        $atts
    );

    // increase id counter so ids stay unique
    $GLOBALS['custom_shortcode_counter'] = $GLOBALS['custom_shortcode_counter'] + 1;

    // specific level-dependant parameters
    $prefix = "";
    if ($level == 1) { $prefix = json_decode('"\uf8ff"'); }

    $titleClass = "mobile-shortcodes-title";
    if ($level == 1) { $titleClass .= " mobile-shortcodes-title-hidden mobile-shortcodes-title-sub"; }

    $divDisplay = "";
    if ($level == 1) { $divDisplay = "none"; }

    // building the output html code
    $output = "";
    $output .= '<div>';
        $output .= '<div class="mobile-shortcodes-default" onclick="changeDivVisibility(\'' . $attributes['id'] . '\');">';
            $output .= '<p class="' . $titleClass . '" id="' . $attributes['id'] . '_title' . '">' . $prefix . ' ' . $attributes['title'] . '</p>';
        $output .='</div>';
        $output .= '<div class="mobile-shortcodes-accordeon" id="' . $attributes['id'] . '" style="display: ' . $divDisplay . ';">' . do_shortcode($content) . '</div>';
    $output .= '</div>';
    return $output;
}



?>