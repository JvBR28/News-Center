<?php get_header(); ?>

<div class="container mx-auto py-8">
  <h1 class="text-3xl font-bold mb-4">Resultados da busca para: <?php echo get_search_query(); ?></h1>

  <?php if ( have_posts() ) : ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php while ( have_posts() ) : the_post(); ?>
        <div class="bg-white shadow p-4">
          <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover mb-4']); ?>
            </a>
          <?php endif; ?>

          <h2 class="text-xl font-semibold mb-2">
            <a href="<?php the_permalink(); ?>" class="text-blue-500 hover:underline"><?php the_title(); ?></a>
          </h2>
          
          <p><?php echo wp_trim_words( get_the_content(), 20 ); ?></p>
        </div>
      <?php endwhile; ?>
    </div>
    
    <div class="mt-6">
      <?php
        // Paginação
        the_posts_pagination([
          'prev_text' => __('Anterior'),
          'next_text' => __('Próxima'),
        ]);
      ?>
    </div>

  <?php else : ?>
    <p>Nenhum resultado encontrado para sua busca.</p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
