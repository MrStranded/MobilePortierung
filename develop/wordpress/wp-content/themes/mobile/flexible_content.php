<?php

/*
 * The flexible_content.php file builds up the part of the website which is defined as the custom fields on the
 * wordpress admin page.
 * author: Michael Plüss
 */

echo '<div class="row-nomargin">';
    echo '<div class="col">';

        // it is necessary to build the content string in this way because we use shortcodes that we have to run through
        // the do_shortcode($content) command to parse them
        $content = '';

        // if there is no content in the description, then we do not draw a horizontal line. that's why we need this boolean
        // secondly we use it to decide whether custom spoilers should be opened or not
        $hadPreviousContent = false;

        // iterating over all custom fields
        while (have_rows('inhalt')) {
            the_row();

            // ---------------------------------------------------------------------------------------------------------
            // --------------------------------------------------------------------------- Beschreibung
            if (get_row_layout() == 'beschreibung') {

                $content .= '<div class="row-sub-section">';

                    $content .= '<div class="info">';

                        $content .= '<div class="row-title">';
                            $content .= '<h1>' . get_the_title() . '</h1>';
                        $content .= '</div>';

                        // we need to know what kinds of info there are in order to group them accordingly
                        $hasLocationInfo = (get_sub_field('strasse') || get_sub_field('ort'));
                        $hasContactInfo = (get_sub_field('telefon') || get_sub_field('fax') || get_sub_field('email'));
                        $hasInfo = ($hasLocationInfo || $hasContactInfo);

                        // --------------------------- any info at all
                        if ($hasInfo) {
                            $content .= '<div class="info-block-first">';
                        };

                        // --------------------------- location info
                        if ($hasLocationInfo) {
                            $content .= '<hr class="light">';
                            $content .= '<div class="info-block">';
                        };
                        // when we have both (street and city) then we can create a google maps query
                        if (get_sub_field('strasse') && get_sub_field('ort')) {
                            $hadPreviousContent = true;

                            $map_url = 'https://www.google.com/maps/search/?api=1&query=';
                            $map_url = $map_url . urlencode_deep(get_sub_field('ort'));
                            $map_url = $map_url . '+' . urlencode_deep(get_sub_field('strasse'));

                            $content .= '<a class="link-button" target="_blank" href="' . $map_url . '"><p>' . get_sub_field('strasse') . '</p>';
                            $content .= '<p>' . get_sub_field('ort') . '</p></a>';
                        } else {
                            if (get_sub_field('strasse')) {
                                $hadPreviousContent = true;

                                $content .= '<p class="grey">' . get_sub_field('strasse') . '</p>';
                            };
                            if (get_sub_field('ort')) {
                                $hadPreviousContent = true;

                                $content .= '<p class="grey">' . get_sub_field('ort') . '</p>';
                            };
                        };
                        if ($hasLocationInfo) {
                            $content .= '</div>';
                        };

                        // --------------------------- contact info
                        if ($hasContactInfo) {
                            $hadPreviousContent = true;
                            $content .= '<hr class="light">';
                            $content .= '<div class="info-block">';
                        };
                        if (get_sub_field('telefon')) {
                            // we possibly have to replace the zero in the beginning of the telephone number with the country code
                            $telnr = get_sub_field('telefon');
                            if (mb_substr($telnr, 0, 1) == '0') {
                                $telnr = '+41' . mb_substr($telnr, 1);
                            }
                            $content .= '<a class="link-button" href="tel:' . $telnr . '"><p>Tel.: ' . get_sub_field('telefon') . '</p></a>';
                        };
                        if (get_sub_field('fax')) { $content .= '<p class="grey">Fax: ' . get_sub_field('fax') . '</p>'; };
                        if (get_sub_field('email')) { $content .= '<a class="link-button" href="mailto: ' . get_sub_field('email') . '"><p>' . get_sub_field('email') . '</p></a>'; };
                        if ($hasContactInfo) {
                            $content .= '</div>';
                        };

                        // --------------------------- /any info at all
                        if ($hasInfo) {
                            $content .= '</div>';
                        };

                    $content .= '</div>'; // info

                    // --------------------------- actual description
                    if (get_sub_field('text')) {
                        $hadPreviousContent = true;
                        $content .= '<hr class="dark">';
                        $content .= '<div class="info-block link-text">';
                            $content .= '<p>' . nl2br(get_sub_field('text')) . '</p>';
                            //$content .= get_sub_field('text');
                        $content .= '</div>'; // / info-block
                    };

                $content .= '</div>'; // / row-sub-section

            // ---------------------------------------------------------------------------------------------------------
            // --------------------------------------------------------------------------- Team
            } elseif (get_row_layout() == 'team') {

                // the first element on the page does not have a horizontal separator
                $open = $hadPreviousContent ? '' : 'open="yes" separator="no"';
                $hadPreviousContent = true;

                $teamName = 'Team';
                if (get_sub_field('teamName')) {
                    $teamName = get_sub_field('teamName');
                }

                $content .= '[mobile_accordeon title="' . $teamName . '" ' . $open . ']';
                $content .= '<div class="row-sub-section">';

                    $membersOnRow = 0; // this value is one for the first member in a row and two for the second
                    $hadPreviousMembers = false; // between two rows of members, we put a little space, but not before the first

                    while (have_rows('mitarbeiter')) {
                        the_row();

                        $membersOnRow = $membersOnRow + 1;
                        if ($membersOnRow == 1) {
                            if ($hadPreviousMembers) {
                                $content .= '<div class="row-member-separation"></div>';
                            }
                            $content .= '<div class="row-member">';
                        };
                        $hadPreviousMembers = true;

                        $content .= '<div class="col-member">';

                            // the image
                            $content .= '<div class="row-thumbnail">'; // this div also scales the image down to the appropriate size
                                $image_id = get_sub_field('bild');
                                if ($image_id) {
                                    $content .= wp_get_attachment_image($image_id, 'thumbnail', true, array("class" => "alignright"));
                                };
                            $content .= '</div>';

                            // info about the team member
                            $content .= '<div class="row-info">';
                                if (get_sub_field('name')) { // the name is turned into a  link to the email, if this info is available
                                    if (get_sub_field('email')) {
                                        $content .= '<a class="link-button" href="mailto: ' . get_sub_field('email') . '">' . get_sub_field('name') . '</a>';
                                    } else {
                                        $content .= '<p>' . get_sub_field('name') . '</p>';
                                    };
                                };
                                if (get_sub_field('position')) {
                                    $content .= '<p>' . get_sub_field('position') . '</p>';
                                };
                            $content .= '</div>';

                        $content .= '</div>'; // /col-member
                        if ($membersOnRow == 3) {
                            $content .= '</div>'; // /row-member
                            $membersOnRow = 0;
                        };

                    };

                    if ($membersOnRow != 0) {
                        $content .= '</div>'; // /row-member
                    }

                $content .= '</div>'; // /row-sub-section
                $content .= '[/mobile_accordeon]';

            // ---------------------------------------------------------------------------------------------------------
            // --------------------------------------------------------------------------- Links
            } elseif (get_row_layout() == 'links') {

                // the first element on the page does not have a horizontal separator
                $open = $hadPreviousContent ? '' : 'open="yes" separator="no"';
                $hadPreviousContent = true;

                $content .= '[mobile_accordeon title="' . 'Informationen' . '" ' . $open . ']';
                $content .= '<div class="row-sub-section">';

                while (have_rows('link')) {
                    the_row();

                    $content .= '<div class="row-sub-section">';

                    if (get_sub_field('beschreibung')) {
                        $content .= '<p>' . nl2br(get_sub_field('beschreibung')) . '</p>';
                    };
                    $content .= '<a class="link-button" target="_blank" href="' . get_sub_field('url') . '">' . get_sub_field('name') . '</a>';

                    $content .= '</div>'; // /row-link

                };

                $content .= '</div>'; // /row-sub-section
                $content .= '[/mobile_accordeon]';

            // ---------------------------------------------------------------------------------------------------------
            // --------------------------------------------------------------------------- Kategorie
            } elseif (get_row_layout() == 'kategorie') {

                // the first element on the page does not have a horizontal separator
                $open = $hadPreviousContent ? '' : 'open="yes" separator="no"';
                $hadPreviousContent = true;

                $content .= '[mobile_accordeon title="' . get_sub_field('titel') . '" ' . $open . ']';
                $content .= '<div class="row-sub-section">';

                // optional text of category
                if (get_sub_field('text')) {
                    $content .= '<div class="link-text">';
                    $content .= '<p>' . nl2br(get_sub_field('text')) . '</p>';
                    $content .= '</div>';
                };

                while (have_rows('unterkategorie')) {
                    the_row();

                    $content .= '[mobile_sub_accordeon title="' . get_sub_field('ueberschrift') . '"]';
                    $content .= '<div class="row-sub-section link-text">';

                    if (get_sub_field('text')) {
                        $content .= '<p>' . nl2br(get_sub_field('text')) . '</p>';
                    };

                    $content .= '</div>'; // /row-sub-section
                    $content .= '[/mobile_sub_accordeon]';

                };

                $content .= '</div>'; // /row-sub-section
                $content .= '[/mobile_accordeon]';

            };

        }; // while

        echo do_shortcode($content);

    echo '</div>'; // /col

    // finally, we add the pictures of the page, provided there are some
    $images = get_field('bilder');
    if ($images) {
        echo '<div class="col-image">';
        foreach ($images as $image) :
            echo '<img border="0" class="row-image" src="' . wp_get_attachment_image_url($image['ID'], 'large') . '" />';
        endforeach;
        echo '</div>';
    };

echo '</div>'; // / row-nomargin

?>
