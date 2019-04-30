<?php get_header(); ?>

	<div class="row-nomargin">

        <?php get_sidebar(); ?>

        <div id="content-id" class="content">
            <div class="col">
                <div class="news-title">
                    <h1>News</h1>
                </div>

                <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            // we need the post object to reliably retrieve the post's date
                            $post = get_post(get_the_ID());

                            echo '<div class="row-hr"><hr class="dark"></div>';

                            echo '<div class="news-post">';

                                echo '<div class="news-post-title">';
                                    the_title();
                                echo '</div>';
                                echo '<br>';

                                // categories like "In eigener Sache", "Landart" etc...
                                $categories = get_the_category();

                                // if it is not yet an array, we have to transform it into one, so we can iterate over it
                                if (!acf_is_array($categories)) {
                                    $categories = array($categories);
                                }

                                // printing all the categories
                                foreach ($categories as $category) {
                                    if ($category->name != 'Uncategorized') {
                                        echo '<p class="grey">' . $category->name . '</p>';
                                    }
                                }

                                echo '<p class="grey">' . acf_format_date($post->post_date, "d.m.Y") . '</p>';
                                echo '<br>';

                                echo '<div class="link-text">';
                                    the_content();
                                echo '</div>';

                            echo '</div>'; // /.news-post
                        }
                    }
                ?>
            </div>
        </div>

    </div> <!-- /.row-nomargin -->

<?php get_footer(); ?>