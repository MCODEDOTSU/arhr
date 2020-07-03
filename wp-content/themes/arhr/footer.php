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

<?php $homepage = get_locale() == 'ru_RU' ? '/' : '/en'; ?>

<div id="mobile-panel">

    <a href="<?= $homepage ?>" class="logo" title="<?= bloginfo('name') ?>"></a>

    <div class="contacts">
        <a class="phone" href="tel:<?= get_theme_mod('phone_header', '') ?>">
            <?= get_theme_mod('phone_header', '') ?>
        </a>
        <a class="email" href="mailto:<?= get_theme_mod('email_header', '') ?>">
            <?= get_theme_mod('email_header', '') ?>
        </a>
    </div>

    <button class="btn mobile-btn mobile-btn-open"></button>
    
</div>

<div id="mobile-menu">

    <div class="mobile-menu">

        <a href="<?= $homepage ?>" class="logo" title="<?= bloginfo('name') ?>"></a>

        <div class="contacts">
            <a class="phone" href="tel:<?= get_theme_mod('phone_header', '') ?>">
                <?= get_theme_mod('phone_header', '') ?>
            </a>
            <a class="email" href="mailto:<?= get_theme_mod('email_header', '') ?>">
                <?= get_theme_mod('email_header', '') ?>
            </a>
        </div>

        <button class="btn mobile-btn mobile-btn-close"></button>

        <nav>
            <?php wp_nav_menu(['theme_location' => 'header', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
        </nav>

        <a class="btn btn-write-us" href="<?= get_theme_mod('write_link_' . get_locale(), '#') ?>">
            <?= __('Write to us', 'arhr') ?>
        </a>

        <nav class="languages-menu">
            <ul class="menu">
                <?php pll_the_languages(); ?>
            </ul>
        </nav>

        <a href="/wp-login" class="account-link"><?= __('Account', 'arhr') ?></a>

    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>