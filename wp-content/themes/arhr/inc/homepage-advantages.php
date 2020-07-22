<?php $home_count_blocks = get_theme_mod('home_count_blocks', 4); ?>

<div class="arhr-advantages fix">

    <h2 class="title">Наши преимущества</h2>

    <div class="items">

        <?php for ($i = 0; $i < $home_count_blocks; $i++) : ?>

            <?php $block_number = $i + 1; ?>

            <div class="arhr-advantages-item">

                <div class="container animate">

                    <?php
                    $icon = get_theme_mod("home_advantages_{$block_number}_svg", '');
                    if (empty($icon)) {
                        $icon = get_theme_mod("home_advantages_{$block_number}_icon", '');
                        $icon = "<img src='$icon' alt='' />";
                    }
                    ?>

                    <?= $icon ?>
                    <h2><?= get_theme_mod("home_advantages_{$block_number}_title", '') ?></h2>
                    <h3><?= get_theme_mod("home_advantages_{$block_number}_description", '') ?></h3>

                </div>

            </div>

        <?php endfor; ?>

    </div>

</div>
