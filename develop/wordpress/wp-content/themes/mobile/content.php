<!--<div class="row-hr"><hr class="dark"></div>-->

<div class="news-post">

    <div class="row-news-post-info">
        <?php
            $categories = get_the_category();

            if (!acf_is_array($categories)) {
                $categories = array($categories);
            }

            foreach ($categories as $category) {
                if ($category->name != 'Uncategorized') {
                    echo '<p class="news-post-title">' . $category->name . '</p>';
                }
            }
        ?>
        <p class="news-post-text"><?php the_date('d.m.Y') ?></p>
    </div>

    <div class="row-news-post-separator"></div>

    <div class="row-news-post-content">
        <p class="news-post-title"><?php the_title(); ?></p>
        <br>
        <p class="news-post-text"><?php the_content(); ?></p>
    </div>

</div><!-- /.news -->

<br><br>