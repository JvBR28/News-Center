<?php get_header(); ?>

<main class="bg-gray-100 text-gray-900">

  <section class="py-8">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold mb-6">Notícias Principais</h2>
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <?php
        $main_query = new WP_Query(array(
          'post_type' => 'noticias',
          'posts_per_page' => 3,
          'meta_key' => 'destaque',
          'meta_value' => '1',
          'orderby' => 'date',
          'order' => 'DESC'
        ));

        if ($main_query->have_posts()) :
          $post_count = 0;
          while ($main_query->have_posts()) : $main_query->the_post();
            $post_count++;
            if ($post_count === 1) : ?>
              <div class="lg:col-span-2 row-span-2 transition duration-300">
                <a href="<?php the_permalink(); ?>" class="block">
                  <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="w-full h-64 object-cover mb-4">
                  <?php endif; ?>
                  <h3 class="text-2xl font-semibold transition duration-300 hover:text-blue-500"><?php the_title(); ?></h3>
                </a>
              </div>
            <?php else : ?>
              <div class="transition duration-300">
                <a href="<?php the_permalink(); ?>" class="block">
                  <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="w-full h-40 object-cover mb-4">
                  <?php endif; ?>
                  <h3 class="text-xl font-semibold transition duration-300 hover:text-blue-500"><?php the_title(); ?></h3>
                </a>
              </div>
            <?php endif;
          endwhile;
          wp_reset_postdata();
        else : ?>
          <p><?php _e('Nenhuma notícia encontrada.'); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold mb-6">Categorias</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        $categories = get_terms(array(
          'taxonomy' => 'category',
          'post_type' => 'noticias',
          'hide_empty' => false,
        ));

        $category_count = 0;
        foreach ($categories as $category) :
          $category_count++;
        ?>
          <div>
            <h3 class="text-xl font-semibold mb-4"><?php echo esc_html($category->name); ?></h3>
            <?php
            $category_query = new WP_Query(array(
              'post_type' => 'noticias',
              'cat' => $category->term_id,
              'posts_per_page' => 5,
              'orderby' => 'date',
              'order' => 'DESC'
            ));

            if ($category_query->have_posts()) :
              $post_count = 0;
              while ($category_query->have_posts()) : $category_query->the_post();
                $post_count++;
                if ($post_count === 1) : ?>
                  <div class="mb-4 transition duration-300">
                    <a href="<?php the_permalink(); ?>" class="block">
                      <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="w-full h-40 object-cover mb-4">
                      <?php endif; ?>
                      <h4 class="text-xl font-bold transition duration-300 hover:text-blue-500"><?php the_title(); ?></h4>
                    </a>
                    <hr class="my-4 border-gray-300">
                  </div>
                <?php else : ?>
                  <div class="flex mb-4 items-center transition duration-300">
                    <?php if (has_post_thumbnail()) : ?>
                      <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="<?php the_title(); ?>" class="w-20 h-20 object-cover rounded-lg mr-4">
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>" class="block">
                      <h4 class="text-md font-semibold transition duration-300 hover:text-blue-500"><?php the_title(); ?></h4>
                    </a>
                  </div>
                <?php endif;
              endwhile;
              wp_reset_postdata();
            else : ?>
              <p><?php _e('Nenhuma notícia encontrada nesta categoria.'); ?></p>
            <?php endif; ?>
            
            <div class="mt-4">
              <a href="<?php echo get_category_link($category->term_id); ?>" class="text-blue-500 hover:text-blue-700 font-bold">
                Ver mais de <?php echo esc_html($category->name); ?> →
              </a>
            </div>
          </div>

          <?php if ($category_count % 3 === 0) : ?>
            <div class="col-span-full">
              <hr class="my-6 border-t-2 border-gray-300">
            </div>
          <?php endif; ?>

        <?php endforeach; ?>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
