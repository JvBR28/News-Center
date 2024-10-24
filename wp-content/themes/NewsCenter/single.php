<?php get_header(); ?>

<div class="container mx-auto p-4">
    <header class="mb-8">
        <h1 class="text-5xl font-bold mb-4 text-center">
            <?php 
            $custom_title = get_field('custom_title');
            if ($custom_title) {
                echo esc_html($custom_title);
            } else {
                the_title();
            }
            ?>
        </h1>

        <div class="flex items-center text-lg text-gray-500">
            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-red-500 mr-4">
                <?php echo get_avatar(get_the_author_meta('ID'), 48); ?>
            </div>
            
            <div class="flex flex-col">
                <span class="font-bold text-black">
                    <?php 
                    $custom_author = get_field('custom_author');
                    if ($custom_author) {
                        echo esc_html($custom_author);
                    } else {
                        echo get_the_author_meta('display_name');
                    }
                    ?>
                </span>
                
                <span class="text-sm text-gray-500">
                    <?php 
                    $custom_date = get_field('custom_date');
                    if ($custom_date) {
                        echo esc_html($custom_date);
                    } else {
                        echo get_the_date() . ' às ' . get_the_time();
                    }

                    if (get_the_modified_date() !== get_the_date()) {
                        echo ' | Atualizado ' . get_the_modified_date() . ' às ' . get_the_modified_time();
                    }
                    ?>
                </span>
            </div>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row gap-12">
        <div class="flex-1">
            <?php if (has_post_thumbnail()): ?>
                <div class="mb-6">
                    <img class="w-full h-auto rounded-lg" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                </div>
            <?php endif; ?>

            <article class="prose max-w-none text-xl space-y-6">
                <?php the_content(); ?>
            </article>
        </div>

        <aside class="w-full lg:w-1/3 lg:pl-8">
            <h2 class="text-2xl font-bold mb-4">
                Mais Lidas de <?php
                    $category = get_the_terms(get_queried_object_id(), 'category'); 
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
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category', 
                                'field'    => 'term_id',
                                'terms'    => $category_id, 
                            ),
                        ),
                        'posts_per_page' => 5, 
                        'orderby' => 'comment_count', 
                    );
                    $noticias_populares = new WP_Query($args);
                    if ($noticias_populares->have_posts()):
                        while ($noticias_populares->have_posts()): $noticias_populares->the_post(); ?>
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
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <?php
            $related_posts = get_field('related_posts');
            if ($related_posts):
                foreach ($related_posts as $post):
                    setup_postdata($post); ?>
                    <div class="border p-4 rounded-lg">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="mb-4">
                                    <img class="w-full h-40 object-cover rounded-lg" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                </div>
                            <?php endif; ?>
                            <h3 class="text-xl font-bold mb-2"><?php the_title(); ?></h3>
                            <p class="text-gray-500"><?php echo get_the_date(); ?></p>
                        </a>
                    </div>
                <?php endforeach;
                wp_reset_postdata();
            else: ?>
                <p>Nenhum post relacionado encontrado.</p>
            <?php endif; ?>
        </div>
</section>

</div>

<?php get_footer(); ?>
