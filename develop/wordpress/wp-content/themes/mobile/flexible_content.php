<?php

echo '<div class="row-nomargin">';
    echo '<div class="col">';

        // it is necessary to build the content string in this way because we use shortcodes that we have to run through
        // the do_shortcode($content) command to parse them
        $content = '';

        while (have_rows('inhalt')) {
            the_row();

            if (get_row_layout() == 'beschreibung') {

                // if there is no content in the description, then we do not draw a horizontal line. that's why we need this boolean
                $hadPreviousContent = false;

                $content .= '<div class="row-hr"><hr class="dark"></div>';

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

                    if (get_sub_field('text')) {
                        //if ($hadPreviousContent) {
                            $content .= '<hr class="dark">';
                        //};
                        $content .= '<div class="info-block link-text">';
                            $content .= '<p>' . nl2br(get_sub_field('text')) . '</p>';
                        $content .= '</div>'; // / info-block
                    };

                $content .= '</div>'; // / row-sub-section

            } elseif (get_row_layout() == 'team') {

                $content .= '<div class="row-hr"><hr class="dark"></div>';

                $content .= '[customAccordeon title="' . 'Team' . '"]';
                $content .= '<div class="row-sub-section">';

                    $membersOnRow = 0;

                    while (have_rows('mitarbeiter')) {
                        the_row();

                        $membersOnRow = $membersOnRow + 1;
                        if ($membersOnRow == 1) {
                            $content .= '<div class="row-member">';
                        };
                        $content .= '<div class="col-member">';

                            $content .= '<div class="row-thumbnail">';
                                $image_id = get_sub_field('bild');
                                if ($image_id) {
                                    $content .= wp_get_attachment_image($image_id, 'thumbnail', true, array("class" => "alignright"));
                                };
                            $content .= '</div>';

                            $content .= '<div class="row-info">';
                                if (get_sub_field('name')) {
                                    $content .= '<p>' . get_sub_field('name') . '</p>';
                                };
                                    if (get_sub_field('position')) {
                                        $content .= '<p>' . get_sub_field('position') . '</p>';
                                };
                                if (get_sub_field('email')) {
                                    $content .= '<a class="link-button" href="mailto: ' . get_sub_field('email') . '">' . get_sub_field('email') . '</a>';
                                };
                            $content .= '</div>';

                        $content .= '</div>'; // /col-member
                        if ($membersOnRow == 2) {
                            $content .= '</div>'; // /row-member
                            $membersOnRow = 0;
                        };

                    };

                    if ($membersOnRow != 0) {
                        $content .= '</div>'; // /row-member
                    }

                $content .= '</div>'; // /row-sub-section
                $content .= '[/customAccordeon]';

            } elseif (get_row_layout() == 'links') {

                $content .= '<div class="row-hr"><hr class="dark"></div>';

                $content .= '[customAccordeon title="' . 'Links' . '"]';
                $content .= '<div class="row-sub-section">';

                while (have_rows('link')) {
                    the_row();

                    $content .= '<div class="row-sub-section">';

                    if (get_sub_field('beschreibung')) {
                        $content .= '<p>' . nl2br(get_sub_field('beschreibung')) . '</p>';
                    };
                    $content .= '<a class="link-button" href="' . get_sub_field('url') . '">' . get_sub_field('name') . '</a>';

                    $content .= '</div>'; // /row-link

                };

                $content .= '</div>'; // /row-sub-section
                $content .= '[/customAccordeon]';

            } elseif (get_row_layout() == 'kategorie') {

                $content .= '<div class="row-hr"><hr class="dark"></div>';

                $content .= '[customAccordeon title="' . get_sub_field('titel') . '"]';
                $content .= '<div class="row-sub-section">';

                while (have_rows('unterkategorie')) {
                    the_row();

                    $content .= '<div class="row-hr"><hr class="light"></div>';

                    $content .= '[customSubAccordeon title="' . get_sub_field('ueberschrift') . '"]';
                    $content .= '<div class="row-sub-section link-text">';

                    if (get_sub_field('text')) {
                        $content .= '<p>' . nl2br(get_sub_field('text')) . '</p>';
                    };

                    $content .= '</div>'; // /row-sub-section
                    $content .= '[/customSubAccordeon]';

                };

                $content .= '</div>'; // /row-sub-section
                $content .= '[/customAccordeon]';

            };

        }; // while

        echo do_shortcode($content);

    echo '</div>'; // /col

    $images = get_field('bilder');
    if ($images) {
        echo '<div class="col-image">';
        foreach ($images as $image) :
            echo '<img border="0" style="max-width: 100%;" src="' . wp_get_attachment_image_url($image['ID'], 'large') . '" />';
        endforeach;
        echo '</div>';
    };

echo '</div>'; // / row-nomargin

?>
