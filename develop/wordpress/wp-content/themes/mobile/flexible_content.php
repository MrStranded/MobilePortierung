<?php

while (has_sub_field('inhalt')) {

    if (get_row_layout() == 'beschreibung') {

        echo '<div class="row-hr"><hr class="dark"></div>';

        echo '<div class="row-nomargin">';

            echo '<div class="col">';

                echo '<h1>' . get_the_title() . '</h1>';

                echo '<div class="info">';
                    echo '<hr class="light">';
                    if (get_sub_field('strasse')) { echo '<p class="info-text">' . get_sub_field('strasse') . '</p>'; };
                    if (get_sub_field('ort')) { echo '<p class="info-text">' . get_sub_field('ort') . '</p>'; };

                    echo '<hr class="light">';
                    if (get_sub_field('telefon')) { echo '<p class="info-text">Tel.: ' . get_sub_field('telefon') . '</p>'; };
                    if (get_sub_field('fax')) { echo '<p class="info-text">Fax: ' . get_sub_field('fax') . '</p>'; };
                    if (get_sub_field('email')) { echo '<p class="info-text">' . get_sub_field('email') . '</p>'; };
                echo '</div>';

                if (get_sub_field('text')) {
                    echo '<hr class="dark">';
                    echo '<p>' . nl2br(get_sub_field('text')) . '</p>';
                };

            echo '</div>'; // /col

            $image_id = get_sub_field('bild');
            if ($image_id) {
                echo '<div class="col">';
                    echo wp_get_attachment_image($image_id, 'large', "", array("class" => "alignright"));
                echo '</div>';
            };

        echo '</div>'; // / row-nomargin

    } elseif (get_row_layout() == 'team') {

        echo '<div class="row-hr"><hr class="dark"></div>';

        echo '<div class="row-team">';

            echo '<h1>Team</h1>';

            while (have_rows('mitarbeiter')) {
                the_row();

                echo '<div class="row-member">';

                    if (get_sub_field('name')) {
                        echo '<div class="col">';
                            echo '<p>' . get_sub_field('name') . '</p>';
                        echo '</div>';
                    };

                    $image_id = get_sub_field('bild');
                    if ($image_id) {
                        echo '<div class="col">';
                            echo wp_get_attachment_image($image_id, 'thumbnail', true, array("class" => "alignright"));
                        echo '</div>';
                    };

                echo '</div>'; // /row-member

            };

        echo '</div>'; // /row-team

    };

};
?>
