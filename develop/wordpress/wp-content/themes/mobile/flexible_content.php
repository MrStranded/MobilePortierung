<?php

while (has_sub_field('inhalt')) {

    if (get_row_layout() == 'beschreibung') {

        echo '<h1>' . get_the_title() . '</h1>';

        // get image id
        $image_id = get_sub_field('bild');

        if ($image_id) {

            // text output
            if (get_sub_field('text')) {
                echo '<p>' . get_sub_field('text') . '</p>';
            };

            // image output
            echo wp_get_attachment_image($image_id, 'medium', "", array("class" => "alignright"));

        } else {

            // text output
            if (get_sub_field('text')) {
                echo '<p>' . get_sub_field('text') . '</p>';
            };

        };

    } elseif (get_row_layout() == 'team') {

        echo '<div class="row-team">';

        echo '<h1>Team</h1>';

        while (have_rows('mitarbeiter')) {
            the_row();

            echo '<div class="col">';

            // Setup
            $image_id = get_sub_field('bild');

            // Output
            if ($image_id) {
                $alt = trim($image_id['alt']);
                $size = 'mitarbeiter';

                echo '<img src="' . $image_id['sizes'][$size] . '" width="' . $image_id['sizes'][$size . '-width'] . '" height="' . $image_id['sizes'][$size . '-height'] . '"';
                if ($alt) {
                    echo ' alt="' . $alt . '"';
                };
                echo '>';

            };

            echo '<p>' . get_sub_field('name') . '</p>';

            echo '</div>';

        };

        echo '</div>';

    };

};
?>
