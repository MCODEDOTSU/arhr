<?php get_header(); ?>

    <div class="single-404 page-content fix">

        <h1><?= __('Oh! Page not found.', 'arhr') ?></h1>

        <p><?= __('Nothing was found at this address. Try using the search.', 'arhr') ?></p>

    </div>

    <div class="searchpage page-content fix">

        <?php get_search_form(); ?>

    </div>

<?php get_footer(); ?>