<?php get_header(); ?>

	<div class="row-nomargin">

        <?php get_sidebar(); ?>

        <div id="content-id" class="content">
            <div class="col">
                <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();

                            echo '<div class="news-post">';

                                echo '<div class="row-news-post-info">';
                                        // categories like "In eigener Sache", "Landart" etc...
                                        $categories = get_the_category();

                                        // if it is not yet an array, we have to transform it into one, so we can iterate over it
                                        if (!acf_is_array($categories)) {
                                            $categories = array($categories);
                                        }

                                        // printing all the categories
                                        foreach ($categories as $category) {
                                            if ($category->name != 'Uncategorized') {
                                                echo '<p class="news-post-title">' . $category->name . '</p>';
                                            }
                                        }
                                    echo '<p class="link-text">' . the_date('d.m.Y') . '</p>';
                                echo '</div>';

                                echo '<div class="row-news-post-separator"></div>';

                                    echo '<div class="row-news-post-content">';
                                        echo '<p class="news-post-title">' . the_title() . '</p>';
                                        echo '<br>';
                                        echo '<p class="link-text">' . the_content() . '</p>';
                                    echo '</div>';

                                echo '</div>'; // /.news

                            echo '<br><br>';
                        }
                    }
                ?>
            </div>
        </div>

    </div> <!-- /.row-nomargin -->

<?php get_footer(); ?>