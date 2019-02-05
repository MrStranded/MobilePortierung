<?php

echo '<div class="row-nomargin">';
    echo '<div class="col">';

        while (have_rows('inhalt')) {
            the_row();

            if (get_row_layout() == 'beschreibung') {

                echo '<div class="row-hr"><hr class="dark"></div>';

                echo '<div class="row-content">';

                    echo '<h1>' . get_the_title() . '</h1>';

                    echo '<div class="info">';
                        echo '<hr class="light">';
                        if (get_sub_field('strasse') && get_sub_field('ort')) {
                            $map_url = 'https://www.google.com/maps/search/?api=1&query=';
                            $map_url = $map_url . urlencode_deep(get_sub_field('ort'));
                            $map_url = $map_url . '+' . urlencode_deep(get_sub_field('strasse'));

                            echo '<a class="info-text" target="_blank" href="' . $map_url . '"><p>' . get_sub_field('strasse') . '</p></a>';
                            echo '<a class="info-text" target="_blank" href="' . $map_url . '"><p>' . get_sub_field('ort') . '</p></a>';
                        } else {
                            if (get_sub_field('strasse')) {
                                echo '<p class="info-text">' . get_sub_field('strasse') . '</p>';
                            };
                            if (get_sub_field('ort')) {
                                echo '<p class="info-text">' . get_sub_field('ort') . '</p>';
                            };
                        };

                        echo '<hr class="light">';
                        if (get_sub_field('telefon')) { echo '<p class="info-text">Tel.: ' . get_sub_field('telefon') . '</p>'; };
                        if (get_sub_field('fax')) { echo '<p class="info-text">Fax: ' . get_sub_field('fax') . '</p>'; };
                        if (get_sub_field('email')) { echo '<a class="info-text" href="mailto: ' . get_sub_field('email') . '">' . get_sub_field('email') . '</a>'; };
                    echo '</div>';

                    if (get_sub_field('text')) {
                        echo '<hr class="dark">';
                        echo '<p>' . nl2br(get_sub_field('text')) . '</p>';
                    };

                echo '</div>'; // / row-content

            } elseif (get_row_layout() == 'team') {

                echo '<div class="row-hr"><hr class="dark"></div>';

                echo '<div class="row-team">';

                    echo '<h1>Team</h1>';

                    while (have_rows('mitarbeiter')) {
                        the_row();

                        echo '<div class="row-member">';

                            echo '<div class="col-image">';
                                $image_id = get_sub_field('bild');
                                if ($image_id) {
                                    echo wp_get_attachment_image($image_id, 'thumbnail', true, array("class" => "alignright"));
                                };
                            echo '</div>';

                            echo '<div class="col">';
                                if (get_sub_field('name')) {
                                    echo '<p>' . get_sub_field('name') . '</p>';
                                };
                                    if (get_sub_field('position')) {
                                    echo '<p>' . get_sub_field('position') . '</p>';
                                };
                                if (get_sub_field('email')) {
                                    echo '<a href="mailto: ' . get_sub_field('email') . '">' . get_sub_field('email') . '</a>';
                                };
                            echo '</div>';

                        echo '</div>'; // /row-member

                    };

                echo '</div>'; // /row-team

            };

        };

    echo '</div>'; // /col

    $images = get_field('bilder');
    if ($images) {
        echo '<div class="col-image">';
        foreach( $images as $image ) :
            echo '<a href="' . $image['url'] . '">';
            echo '<img border="0" style="max-width: 100%;" src="' . wp_get_attachment_image_url($image['ID'], 'large') . '" />';
            echo '</a>';
        endforeach;
        echo '</div>';
    };

echo '</div>'; // / row-nomargin

?>
