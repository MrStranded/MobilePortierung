<?php

echo '<div class="row-nomargin">';
    echo '<div class="col">';

        // it is necessary to build the content string in this way because we use shortcodes that we have to run through
        // the do_shortcode($content) command to parse them
        $content = '';

        $content .= '[su_accordion class="spoiler-content"]';

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

                        if (get_sub_field('strasse') || get_sub_field('ort') || get_sub_field('telefon') || get_sub_field('fax') || get_sub_field('email')) {
                            $content .= '<div class="info-block-first">';
                        };

                        if (get_sub_field('strasse') || get_sub_field('ort')) {
                            $content .= '<hr class="light">';
                            $content .= '<div class="info-block">';
                        };
                        if (get_sub_field('strasse') && get_sub_field('ort')) {
                            $hadPreviousContent = true;

                            $map_url = 'https://www.google.com/maps/search/?api=1&query=';
                            $map_url = $map_url . urlencode_deep(get_sub_field('ort'));
                            $map_url = $map_url . '+' . urlencode_deep(get_sub_field('strasse'));

                            $content .= '<a class="info-link" target="_blank" href="' . $map_url . '"><p>' . get_sub_field('strasse') . '</p>';
                            $content .= '<p>' . get_sub_field('ort') . '</p></a>';
                        } else {
                            if (get_sub_field('strasse')) {
                                $hadPreviousContent = true;

                                $content .= '<p class="info-text">' . get_sub_field('strasse') . '</p>';
                            };
                            if (get_sub_field('ort')) {
                                $hadPreviousContent = true;

                                $content .= '<p class="info-text">' . get_sub_field('ort') . '</p>';
                            };
                        };
                        if (get_sub_field('strasse') || get_sub_field('ort')) {
                            $content .= '</div>';
                        };

                        if (get_sub_field('telefon') || get_sub_field('fax') || get_sub_field('email')) {
                            $hadPreviousContent = true;
                            $content .= '<hr class="light">';
                            $content .= '<div class="info-block">';
                        };
                        if (get_sub_field('telefon')) {
                            $telnr = get_sub_field('telefon');
                            if (mb_substr($telnr, 0, 1) == '0') {
                                $telnr = '+41' . mb_substr($telnr, 1);
                            }
                            $content .= '<a class="info-link" href="tel:' . $telnr . '"><p>Tel.: ' . get_sub_field('telefon') . '</p></a>';
                        };
                        if (get_sub_field('fax')) { $content .= '<p class="info-text">Fax: ' . get_sub_field('fax') . '</p>'; };
                        if (get_sub_field('email')) { $content .= '<a class="info-link" href="mailto: ' . get_sub_field('email') . '"><p>' . get_sub_field('email') . '</p></a>'; };
                        if (get_sub_field('telefon') || get_sub_field('fax') || get_sub_field('email')) {
                            $content .= '</div>';
                        };

                        if (get_sub_field('strasse') || get_sub_field('ort') || get_sub_field('telefon') || get_sub_field('fax') || get_sub_field('email')) {
                            $content .= '</div>';
                        };

                    $content .= '</div>'; // info

                    if (get_sub_field('text')) {
                        //if ($hadPreviousContent) {
                            $content .= '<hr class="dark">';
                        //};
                        $content .= '<div class="info-block">';
                            $content .= '<p>' . nl2br(get_sub_field('text')) . '</p>';
                        $content .= '</div>'; // / info-block
                    };

                $content .= '</div>'; // / row-sub-section

            } elseif (get_row_layout() == 'team') {

                $content .= '<div class="row-hr"><hr class="dark"></div>';

                $content .= '[su_spoiler class="spoiler" title="' . 'Team' . '" open="no" icon="chevron"]';
                $content .= '<div class="row-sub-section">';

                    while (have_rows('mitarbeiter')) {
                        the_row();

                            $content .= '<div class="row-member">';

                                $content .= '<div class="col-image">';
                                $image_id = get_sub_field('bild');
                                if ($image_id) {
                                    $content .= wp_get_attachment_image($image_id, 'thumbnail', true, array("class" => "alignright"));
                                };
                            $content .= '</div>';

                            $content .= '<div class="col">';
                                if (get_sub_field('name')) {
                                    $content .= '<p>' . get_sub_field('name') . '</p>';
                                };
                                    if (get_sub_field('position')) {
                                        $content .= '<p>' . get_sub_field('position') . '</p>';
                                };
                                if (get_sub_field('email')) {
                                    $content .= '<a class="info-link" href="mailto: ' . get_sub_field('email') . '">' . get_sub_field('email') . '</a>';
                                };
                            $content .= '</div>';

                        $content .= '</div>'; // /row-member

                    };

                $content .= '</div>'; // /row-sub-section
                $content .= '[/su_spoiler]';

            } elseif (get_row_layout() == 'links') {

                $content .= '<div class="row-hr"><hr class="dark"></div>';

                $content .= '[su_spoiler class="spoiler" title="' . 'Links' . '" open="no" icon="chevron"]';
                $content .= '<div class="row-sub-section">';

                while (have_rows('link')) {
                    the_row();

                    $content .= '<div class="row-sub-section">';

                    if (get_sub_field('beschreibung')) {
                        $content .= '<p>' . nl2br(get_sub_field('beschreibung')) . '</p>';
                    };
                    $content .= '<a class="info-link" href="' . get_sub_field('url') . '">' . get_sub_field('name') . '</a>';

                    $content .= '</div>'; // /row-link

                };

                $content .= '</div>'; // /row-sub-section
                $content .= '[/su_spoiler]';

            } elseif (get_row_layout() == 'kategorie') {

                $content .= '<div class="row-hr"><hr class="dark"></div>';

                //$content .= '[su_spoiler class="spoiler" title="' . get_sub_field('titel') . '" open="no" icon="chevron"]';
                $content .= '[customAccordeon title="' . get_sub_field('titel') . '"]';
                $content .= '<div class="row-sub-section">';
                //$content .= '[_su_accordion class="spoiler-content"]';

                while (have_rows('unterkategorie')) {
                    the_row();

                    $content .= '<div class="row-hr"><hr class="light"></div>';

                    $content .= '[customSubAccordeon title="' . get_sub_field('ueberschrift') . '"]';
                    //$content .= '[_su_spoiler class="spoiler" title="' . get_sub_field('ueberschrift') . '" open="no" icon="caret"]';
                    $content .= '<div class="row-sub-section">';

                    if (get_sub_field('text')) {
                        $content .= '<p>' . nl2br(get_sub_field('text')) . '</p>';
                    };

                    $content .= '</div>'; // /row-sub-section
                    //$content .= '[_/su_spoiler]';
                    $content .= '[/customSubAccordeon]';

                };

                //$content .= '[_/su_accordion]';
                $content .= '</div>'; // /row-sub-section
                //$content .= '[/su_spoiler]';
                $content .= '[/customAccordeon]';

            };

        }; // while

        $content .= '[/su_accordion]';

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
