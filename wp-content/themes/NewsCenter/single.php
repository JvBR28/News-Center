<?php get_header(); ?>

<div class="container mx-auto p-4">

    <header class="mb-8 text-center">
        <h1 class="text-5xl font-bold mb-4"><?php the_title(); ?></h1>
        <div class="text-gray-500 text-lg">
            <span><?php echo get_the_author_meta('display_name'); ?></span> | 
            <span><?php echo get_the_date(); ?></span> | 
            <span><?php echo get_the_modified_date(); ?></span>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row gap-12">
        <div class="flex-1">
            <?php if (has_post_thumbnail()): ?>
                <div class="mb-6">
                    <img class="w-full h-auto rounded-lg" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                </div>
            <?php endif; ?>

            <article class="prose max-w-none text-xl">
                <?php the_content(); ?>
            </article>
        </div>

        <aside class="w-full lg:w-1/3 lg:pl-8">
            <h2 class="text-2xl font-bold mb-4">
                Mais Lidas de <?php
                    $category = get_the_category();
                    if (!empty($category)) {
                        echo esc_html($category[0]->name);
                    }
                ?>
            </h2>
            <ul class="space-y-4">
                <?php
                if (!empty($category)) {
                    $category_id = $category[0]->term_id;
                    $args = array(
                        'cat' => $category_id,
                        'posts_per_page' => 5,
                        'orderby' => 'comment_count'
                    );
                    $popular_posts = new WP_Query($args);
                    if ($popular_posts->have_posts()):
                        while ($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                            <li class="flex items-center space-x-4">
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="w-24 h-24 overflow-hidden rounded-lg">
                                        <a href="<?php the_permalink(); ?>">
                                            <img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="flex-1">
                                    <a href="<?php the_permalink(); ?>" class="text-red-600 hover:text-red-800 font-semibold">
                                        <?php the_title(); ?>
                                    </a>
                                    <p class="text-sm text-gray-500">
                                        <?php echo get_the_date(); ?>
                                    </p>
                                </div>
                            </li>
                        <?php endwhile;
                        wp_reset_postdata();
                    endif;
                }
                ?>
            </ul>
        </aside>
    </div>

    <section class="mt-12">
        <h2 class="text-2xl font-bold mb-4">Posts Relacionados</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php
            ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>
