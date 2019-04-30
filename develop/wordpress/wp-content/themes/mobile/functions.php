<?php
/**
 * Created by PhpStorm.
 * User: Michael PLüss
 * Date: 04.04.2019
 * Time: 13:55
 */



/**
 * Called from header.php
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

$custom_shortcode_counter = 0; // this counter ensures that all spoilers have different id's, even if none is provided
$custom_shortcode_current_parent = ''; // we always need to know the parent spoiler of sub spoilers, because we have to close all other sub-spoilers if opening one

/**
 * Registering the custom short codes in the word press environment.
 */
function initializeShortCode() {
    add_shortcode('mobile_accordeon', 'mobileAccordeon');
    add_shortcode('mobile_sub_accordeon', 'mobileSubAccordeon');
}

/**
 * Helper function to call the base function with more arguments.
 * @param $atts
 * @param string $content
 * @return string
 */
function mobileAccordeon($atts, $content = "") {
    return mobileAccordeonBase($atts, $content, 0);
}
/**
 * Helper function to call the base function with more arguments.
 * @param $atts
 * @param string $content
 * @return string
 */
function mobileSubAccordeon($atts, $content = "") {
    return mobileAccordeonBase($atts, $content, 1);
}

/**
 * This base function handles both sub and super spoilers. The two kinds are distinguished by the $level parameter.
 * @param $atts
 * @param $content
 * @param $level 0: parent-spoiler, 1: child-spoiler
 * @return string
 */
function mobileAccordeonBase($atts, $content, $level) {
    // defining default attributes
    $attributes = shortcode_atts(
        array(
            'id' => 'shortCode_' . $GLOBALS['custom_shortcode_counter'],
            'title' => 'Accordeon',
            'open' => 'no',
            'separator' => 'yes',
        ),
        $atts
    );

    // all spoiler on the top level have the same class
    $spoilerLevelClass = 'mobile-shortcodes-toplevel';
    // set current spoiler as parent, if on upper most level. Otherwise correct parent spoiler
    if ($level == 0) {
        $GLOBALS['custom_shortcode_current_parent'] = $attributes['id'];
    } else {
        $spoilerLevelClass = 'sub_' . $GLOBALS['custom_shortcode_current_parent'];
    }

    // increase id counter so ids stay unique
    $GLOBALS['custom_shortcode_counter'] = $GLOBALS['custom_shortcode_counter'] + 1;

    // specific level-dependant parameters
    $prefix = "";
    if ($level == 1) { $prefix = json_decode('"\uf8ff"'); }

    // initially open or closed?
    $initialStyle = 'display: none;';
    $initialTitleClass = '';
    if ($attributes['open'] == 'yes') {
        $initialStyle = '';
        $initialTitleClass = 'mobile-shortcodes-title-open';
    }

    // first spoiler has no hr (horizontal separator)
    if ($attributes['separator'] == 'no') {
        $initialTitleClass .= ' mobile-shortcodes-title-no-separator';
    }

    // building the output html code
    $output = "";
    $output .= '<div>';
        // title
        $output .= '<div id="' . $attributes['id'] . '_title" class="' . $spoilerLevelClass . '-title mobile-shortcodes-title ' . $initialTitleClass . '" onclick="changeDivVisibility(\'' . $attributes['id'] . '\',\'' . $spoilerLevelClass . '\');">';
            $output .= '<p>' . $prefix . ' ' . $attributes['title'] . '</p>';
        $output .='</div>';
        // content
        $output .= '<div id="' . $attributes['id'] . '" class="' . $spoilerLevelClass . ' mobile-shortcodes-content" style="' . $initialStyle . '">' . do_shortcode($content) . '</div>';
    $output .= '</div>';
    return $output;
}



?>