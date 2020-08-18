<div class="wrap">

    <h1 class="wp-heading-inline"><?= __('Calendar settings', 'mcode-calendar') ?></h1>

    <form method="POST">

        <table class="form-table" role="presentation">
            <tbody>

                <tr>
                    <th scope="row"><?= __('Categories for calendar events', 'mcode-calendar') ?></th>
                    <td>
                        <fieldset>

                            <select name="mcode_calendar_category">

                            <?php foreach ($categories as $category) : ?>

                                <?php if (pll_get_term_language($category->cat_ID, 'locale') != get_locale()) continue;  ?>

                                <option value="<?= $category->cat_ID ?>" <?= $category->cat_ID == $mcode_calendar_category ? 'selected' : '' ?>><?= $category->name ?></option>

                            <?php endforeach; ?>

                            </select>

                        </fieldset>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?= __('The name of the additional field that stores the date and time of the event start', 'mcode-calendar') ?></th>
                    <td>
                        <fieldset>
                            <input type="text" name="mcode_calendar_field_start" value="<?= $mcode_calendar_field_start ?>" />
                        </fieldset>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?= __('The name of the additional field, which stores the date and time of the end of the event', 'mcode-calendar') ?></th>
                    <td>
                        <fieldset>
                            <input type="text" name="mcode_calendar_field_finish" value="<?= $mcode_calendar_field_finish ?>" />
                        </fieldset>
                    </td>
                </tr>

            </tbody>
        </table>

        <p class="submit">

            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?= __('Save changes', 'mcode-calendar') ?>">

        </p>

    </form>

</div>