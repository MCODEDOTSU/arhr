</div>

<footer>

    <div class="fix">

        <div class="footer-1">
            <?php
            if (function_exists('dynamic_sidebar')) {
                dynamic_sidebar('footer-1');
            }
            ?>
        </div>

        <div class="footer-2">
            <?php
            if (function_exists('dynamic_sidebar')) {
                dynamic_sidebar('footer-2');
            }
            ?>
        </div>

        <div class="footer-3">
            <?php
            if (function_exists('dynamic_sidebar')) {
                dynamic_sidebar('footer-3');
            }
            ?>
        </div>

        <div class="footer-4">
            <?php
            if (function_exists('dynamic_sidebar')) {
                dynamic_sidebar('footer-4');
            }
            ?>
        </div>

    </div>


</footer>

<div id="mobile-panel">
    <ul class="menu">
        <li>
            <a class="btn mobile-btn">
                <i class="fa fa-bars"></i>
            </a>
        </li>
        <?php pll_the_languages(); ?>
        <li><a href="/wp-login"><i class="fa fa-user"></i></a></li>
    </ul>
</div>

<div id="mobile-menu">
    <nav class="mobile-menu">

        <ul class="menu social-menu">
            <li><a href="<?= get_theme_mod('facebook_link', '#') ?>" class="facebook" target="_blank"></a></li>
            <li><a href="<?= get_theme_mod('vkontakte_link', '#') ?>" class="vkontakte" target="_blank"></a></li>
            <li><a href="<?= get_theme_mod('youtube_link', '#') ?>" class="youtube" target="_blank"></a></li>
            <li><a href="<?= get_theme_mod('instagram_link', '#') ?>" class="instagram" target="_blank"></a></li>
            <li><a href="<?= get_theme_mod('linkedin_link', '#') ?>" class="linkedin" target="_blank"></a></li>
        </ul>
        
        <?php wp_nav_menu(['theme_location' => 'header', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>

    </nav>
</div>

<?php wp_footer(); ?>

</body>
</html>