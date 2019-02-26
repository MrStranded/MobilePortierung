<?php

echo '<div class="row-nomargin">';
    echo '<div class="col">';

        $content = '';

        $content .= '<div class="row-hr"><hr class="dark"></div>';
        $content .= '<h1>' . get_the_title() . '</h1>';

        $content .= '[su_accordion]';

        while (have_rows('inhalt')) {
            the_row();

            if (get_row_layout() == 'beschreibung') {

                $content .= '<div class="row-hr"><hr class="dark"></div>';
                //$content .= '[su_spoiler title="' . get_the_title() . '" open="yes"]';

                $content .= '<div class="row-content">';

                    $content .= '<div class="info">';

                        if (get_sub_field('strasse') && get_sub_field('ort')) {
                            //$content .= '<hr class="light">';

                            $map_url = 'https://www.google.com/maps/search/?api=1&query=';
                            $map_url = $map_url . urlencode_deep(get_sub_field('ort'));
                            $map_url = $map_url . '+' . urlencode_deep(get_sub_field('strasse'));

                            $content .= '<a class="info-text" target="_blank" href="' . $map_url . '"><p>' . get_sub_field('strasse') . '</p>';
                            $content .= '<p>' . get_sub_field('ort') . '</p></a>';
                        } else {
                            if (get_sub_field('strasse')) {
                                //$content .= '<hr class="light">';

                                $content .= '<p class="info-text">' . get_sub_field('strasse') . '</p>';
                            };
                            if (get_sub_field('ort')) {
                                //$content .= '<hr class="light">';

                                $content .= '<p class="info-text">' . get_sub_field('ort') . '</p>';
                            };
                        };

                        if (get_sub_field('telefon') || get_sub_field('fax') || get_sub_field('email')) {
                            $content .= '<hr class="light">';
                        };
                        if (get_sub_field('telefon')) { $content .= '<p class="info-text">Tel.: ' . get_sub_field('telefon') . '</p>'; };
                        if (get_sub_field('fax')) { $content .= '<p class="info-text">Fax: ' . get_sub_field('fax') . '</p>'; };
                        if (get_sub_field('email')) { $content .= '<a class="info-text" href="mailto: ' . get_sub_field('email') . '">' . get_sub_field('email') . '</a>'; };
                    $content .= '</div>'; // info

                    if (get_sub_field('text')) {
                        $content .= '<hr class="dark">';
                        $content .= '<p>' . nl2br(get_sub_field('text')) . '</p>';
                    };

                $content .= '</div>'; // / row-content

                //$content .= '[/su_spoiler]';

            } elseif (get_row_layout() == 'team') {

                $content .= '<div class="row-hr"><hr class="dark"></div>';
                $content .= '[su_spoiler title="' . 'Team' . '" open="no"]';

                $content .= '<div class="row-team">';

                    $content .= '<h1>Team</h1>';

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
                                    $content .= '<a href="mailto: ' . get_sub_field('email') . '">' . get_sub_field('email') . '</a>';
                                };
                            $content .= '</div>';

                        $content .= '</div>'; // /row-member

                    };

                $content .= '</div>'; // /row-team

                $content .= '[/su_spoiler]';

            };

        }; // while

        $content .= '[/su_accordion]';

        echo do_shortcode($content);

    echo '</div>'; // /col

    if (!wp_is_mobile()) {
        $images = get_field('bilder');
        if ($images) {
            echo '<div class="col-image">';
            foreach ($images as $image) :
                echo '<a href="' . $image['url'] . '">';
                echo '<img border="0" style="max-width: 100%;" src="' . wp_get_attachment_image_url($image['ID'], 'large') . '" />';
                echo '</a>';
            endforeach;
            echo '</div>';
        };
    };

echo '</div>'; // / row-nomargin

?>
