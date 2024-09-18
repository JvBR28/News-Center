<?php get_header(); ?>

<main class="bg-gray-100 text-gray-900">

  <section class="py-8">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold mb-6">Notícias Principais</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        $main_query = new WP_Query(array(
          'posts_per_page' => 5,
          'meta_key' => 'destaque',
          'meta_value' => '1',
          'orderby' => 'date',
          'order' => 'DESC'
        ));
        
        if ($main_query->have_posts()) :
          while ($main_query->have_posts()) : $main_query->the_post(); ?>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg">
              <a href="<?php the_permalink(); ?>" class="block">
                <?php if (has_post_thumbnail()) : ?>
                  <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="w-full h-48 object-cover rounded-lg mb-4">
                <?php endif; ?>
                <h3 class="text-xl font-semibold"><?php the_title(); ?></h3>
                <p class="text-gray-600 mt-2"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
              </a>
            </div>
          <?php endwhile;
          wp_reset_postdata();
        else : ?>
          <p><?php _e('Nenhuma notícia encontrada.'); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="py-8 bg-gray-200">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold mb-6">Categorias</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        $categories = get_categories();
        foreach ($categories as $category) : ?>
          <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg">
            <h3 class="text-xl font-semibold mb-4"><?php echo esc_html($category->name); ?></h3>
            <?php
            $category_query = new WP_Query(array(
              'cat' => $category->term_id,
              'posts_per_page' => 3,
              'orderby' => 'date',
              'order' => 'DESC'
            ));
            
            if ($category_query->have_posts()) :
              while ($category_query->have_posts()) : $category_query->the_post(); ?>
                <div class="mb-4">
                  <a href="<?php the_permalink(); ?>" class="block">
                    <?php if (has_post_thumbnail()) : ?>
                      <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="<?php the_title(); ?>" class="w-full h-32 object-cover rounded-lg mb-2">
                    <?php endif; ?>
                    <h4 class="text-lg font-semibold"><?php the_title(); ?></h4>
                  </a>
                </div>
              <?php endwhile;
              wp_reset_postdata();
            else : ?>
              <p><?php _e('Nenhuma notícia encontrada nesta categoria.'); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>