<?php get_header(); ?>

<main class="bg-gray-100 text-gray-900">
  <section class="py-8">
    <div class="container mx-auto">

      <h2 class="text-3xl font-bold mb-6">Notícias Principais</h2>
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <?php
        $queried_object = get_queried_object();
        $current_taxonomy = isset($queried_object->term_id) ? 'category' : 'post_tag';

        $latest_posts_query = new WP_Query(array(
          'posts_per_page' => 3,
          'orderby' => 'date',
          'order' => 'DESC',
          'tax_query' => array(
            array(
              'taxonomy' => $current_taxonomy,
              'field'    => 'term_id',
              'terms'    => $queried_object->term_id,
            ),
          ),
        ));

        if ($latest_posts_query->have_posts()) :
          $post_count = 0;

          while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post();
            $post_count++;
            
            if ($post_count === 1) : ?>
              <div class="lg:col-span-2 row-span-2 bg-white p-4 rounded-lg shadow-md hover:shadow-lg">
                <a href="<?php the_permalink(); ?>" class="block">
                  <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="w-full h-72 object-cover rounded-lg mb-4">
                  <?php endif; ?>
                  <h3 class="text-2xl font-semibold"><?php the_title(); ?></h3>
                </a>
                <p class="text-gray-700 mt-2"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                <a href="<?php the_permalink(); ?>" class="text-blue-500 hover:text-blue-700 font-bold mt-4 block">
                  Ler mais →
                </a>
              </div>

            <?php else : ?>
              <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg">
                <a href="<?php the_permalink(); ?>" class="block">
                  <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="w-full h-48 object-cover rounded-lg mb-4">
                  <?php endif; ?>
                  <h3 class="text-xl font-semibold"><?php the_title(); ?></h3>
                </a>
                <p class="text-gray-700 mt-2"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                <a href="<?php the_permalink(); ?>" class="text-blue-500 hover:text-blue-700 font-bold mt-4 block">
                  Ler mais →
                </a>
              </div>

            <?php endif;
          endwhile;

          wp_reset_postdata();
        else : ?>
          <p><?php _e('Nenhuma notícia encontrada.'); ?></p>
        <?php endif; ?>
      </div>

      <h2 class="text-3xl font-bold mb-6 mt-8">Ultimas Noticias</h2>
      <div class="news-list">
        <?php
        $all_posts_query = new WP_Query(array(
          'posts_per_page' => -1, 
          'orderby' => 'date',
          'order' => 'DESC',
          'post__not_in' => wp_list_pluck($latest_posts_query->posts, 'ID'),  
          'tax_query' => array(
            array(
              'taxonomy' => $current_taxonomy,
              'field'    => 'term_id',
              'terms'    => $queried_object->term_id,
            ),
          ),
        ));

        if ($all_posts_query->have_posts()) : 
          while ($all_posts_query->have_posts()) : $all_posts_query->the_post(); ?>
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl mb-8 flex">
              <?php if (has_post_thumbnail()) : ?>
                <div class="w-1/4">
                  <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="w-64 h-52 object-cover object-center rounded-lg">
                </div>
              <?php endif; ?>
              <div class="ml-6 flex-grow">
                <a href="<?php the_permalink(); ?>" class="block">
                  <h3 class="text-xl font-semibold"><?php the_title(); ?></h3>
                </a>
                <p class="text-gray-700 mt-2"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                <a href="<?php the_permalink(); ?>" class="text-blue-500 hover:text-blue-700 font-bold mt-4 block">
                  Ler mais →
                </a>
                <p class="text-sm text-gray-500 mt-2">
                  <i class="far fa-clock"></i> <?php echo get_the_date(); ?>
                </p>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

        <div class="pagination mt-6">
          <?php 
          the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => __('« Anterior', 'textdomain'),
            'next_text' => __('Próximo »', 'textdomain'),
          )); 
          ?>
        </div>

      <?php else : ?>
        <p><?php _e('Nenhuma nova notícia encontrada.', 'textdomain'); ?></p>
      <?php endif; ?>

    </div>
  </section>

</main>

<?php get_footer(); ?>
