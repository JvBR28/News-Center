<?php get_header(); ?>

<div class="container mx-auto px-4 py-8">
  <div class="bg-white p-6 rounded-lg shadow-lg">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>

      <div class="text-gray-500 mb-4">
        Publicado em <?php echo get_the_date(); ?> em
        <?php the_category(', '); ?>
      </div>

      <?php if (has_post_thumbnail()) : ?>
        <div class="mb-6">
          <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="w-full h-auto object-cover rounded-lg">
        </div>
      <?php endif; ?>

      <div class="text-gray-700 leading-relaxed">
        <?php the_content(); ?>
      </div>

      <div class="flex justify-between mt-8">
        <div class="text-left">
          <?php previous_post_link('%link', '← Notícia Anterior'); ?>
        </div>
        <div class="text-right">
          <?php next_post_link('%link', 'Próxima Notícia →'); ?>
        </div>
      </div>

    <?php endwhile; endif; ?>
  </div>
</div>

<?php get_footer(); ?>
