<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('-'); ?></title>
    <?php wp_head(); ?>
</head>

<body class="bg-gray-50 text-gray-800">

<header class="bg-gray-700 text-gray-200">
  <div class="container mx-auto flex items-center justify-between py-4">
    <div class="text-2xl font-bold">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-blue-400"><?php bloginfo('name'); ?></a>
    </div>

    <nav class="hidden lg:flex">
      <?php wp_nav_menu([
          'theme_location' => 'menu-principal',
          'menu_class'     => 'flex space-x-6',
          'container'      => false,
          'items_wrap'     => '<ul class="flex space-x-6">%3$s</ul>',
          'link_before'    => '<span class="hover:text-blue-300">',
          'link_after'     => '</span>'
      ]); ?>
    </nav>

    <div class="relative hidden lg:block">
      <input type="text" placeholder="Buscar..." class="p-2 pl-10 rounded bg-gray-200 text-gray-800 focus:outline-none focus:bg-gray-300">
      <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M14 10a4 4 0 1 0-8 0 4 4 0 0 0 8 0z"></path>
      </svg>
    </div>

    <div class="block lg:hidden">
      <button id="menu-btn" class="p-2 text-gray-200 hover:bg-gray-600 rounded">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </button>
    </div>
  </div>
</header>

<nav id="mobile-menu" class="lg:hidden hidden absolute bg-gray-600 w-full ">
  <?php wp_nav_menu([
      'theme_location' => 'menu-principal',
      'menu_class'     => 'flex flex-col items-center',
      'container'      => false,
      'items_wrap'     => '<ul class="flex flex-col items-center">%3$s</ul>',
      'link_before'    => '<span class="block p-4 text-gray-200 hover:bg-gray-500">',
      'link_after'     => '</span>'
  ]); ?>
</nav>

<script>
  document.getElementById('menu-btn').addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
  });
</script>