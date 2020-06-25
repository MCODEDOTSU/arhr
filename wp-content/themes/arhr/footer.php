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

<?php wp_footer(); ?>

</body>
</html>