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

<?php wp_footer(); ?>

</body>
</html>