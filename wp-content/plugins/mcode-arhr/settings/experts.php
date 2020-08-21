<div class="wrap mcode-arhr mcode-arhr-experts" data-type="experts">

    <h1>Эксперты <a href="#add" class="page-title-action add-item">Добавить нового</a></h1>

    <div class="error notice">
        <p></p>
    </div>

    <div class="updated notice">
        <p></p>
    </div>

    <table class="wp-list-table widefat fixed striped posts items-list" role="presentation">

        <thead>
        <tr>
            <th class="manage-column column-cb">ФИО</th>
            <th class="manage-column column-title column-primary">Должность</th>
            <th class="manage-column column-title">Язык</th>
        </tr>
        </thead>

        <tbody>

        <?php foreach ($experts as $i => $expert): ?>

            <tr class="short-item-data">

                <td class="title column-title has-row-actions column-primary page-title">
                    <strong><?= $expert['lastname'] ?> <?= $expert['firstname'] ?> <?= $expert['middlename'] ?></strong>
                    <div class="row-actions">
                        <span class="edit"><a data-id="<?= $expert['id'] ?>" href="#edit" aria-label="Редактировать «<?= $expert['lastname'] ?> <?= $expert['firstname'] ?> <?= $expert['middlename'] ?>»">Изменить</a> | </span>
                        <span class="delete"><a data-id="<?= $expert['id'] ?>" href="#delete" aria-label="Удалить «<?= $expert['lastname'] ?> <?= $expert['firstname'] ?> <?= $expert['middlename'] ?>»">Удалить</a></span>
                    </div>
                </td>
                <td class="title column-title"><?= $expert['post'] ?></td>
                <td class="title column-title"><?= $expert['lang'] ?></td>

            </tr>

            <tr class="item-dialog" id="item-dialog-<?= $expert['id'] ?>">

                <td class="title column-title has-row-actions column-primary page-title" colspan="3">

                    <table width="100%" class="wp-list-table widefat fixed striped posts item-data">
                        <tr>
                            <td rowspan="3" class="item-image-container">

                                <div class="image-container-list">

                                    <?php if (!empty($expert['photo'])): ?>

                                        <?php $url = wp_get_attachment_url($expert['photo']); ?>

                                        <div class="image-container image">
                                            <img src="<?= $url ?>" class="item-image"/>
                                            <button class="delete-image page-title-action">Удалить</button>
                                        </div>

                                    <?php endif; ?>
                                </div>

                                <div class="add-image page-title-action">Выбрать</div>

                                <input class="images-text-list item-field" name="photo" type="hidden" value="<?= $expert['photo'] ?>" data-save="<?= $expert['photo'] ?>"  />
                                <input name="photo-url" class="image-url" type="hidden" value="<?= $url ?>"  />

                            </td>
                            <td>Фамилия: *</td>
                            <td class="input">
                                <input type="text" name="lastname" value="<?= $expert['lastname'] ?>" data-save="<?= $expert['lastname'] ?>" class="item-field" />
                            </td>
                        </tr>
                        <tr>
                            <td>Имя: *</td>
                            <td class="input">
                                <input type="text" name="firstname" value="<?= $expert['firstname'] ?>" data-save="<?= $expert['firstname'] ?>"  class="item-field" />
                            </td>
                        </tr>
                        <tr>
                            <td>Отчество:</td>
                            <td class="input">
                                <input type="text" name="middlename" value="<?= $expert['middlename'] ?>" data-save="<?= $expert['middlename'] ?>"  class="item-field" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Должность:</td>
                            <td class="input">
                                <input type="text" name="post" value="<?= $expert['post'] ?>" data-save="<?= $expert['post'] ?>"  class="item-field" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Описание:</td>
                            <td class="input">
                                <textarea name="description" data-save="<?= $expert['description'] ?>" class="item-field"><?= $expert['description'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Язык:</td>
                            <td class="input">
                                <select name="lang" data-save="<?= $expert['lang'] ?>" class="item-field">
                                    <?php foreach ($languages as $lang): ?>
                                        <option value="<?= $lang ?>" <?= selected($expert['lang'], $lang); ?>><?= $lang ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td align="right">
                                <a href="#cansel" class="page-title-action button-cansel">Закрыть без сохранения</a>
                                <a href="#ok" class="page-title-action button-primary button-ok">Сохранить</a>
                                <input type="hidden" name="id" value="<?= $expert['id'] ?>"/>
                            </td>
                        </tr>
                    </table>

                </td>

            </tr>

        <?php endforeach; ?>

        <tr class="item-dialog" id="item-dialog-0">

            <td class="title column-title has-row-actions column-primary page-title" colspan="3">

                <table width="100%" class="wp-list-table widefat fixed striped posts item-data">
                    <tr>
                        <td rowspan="3" class="item-image-container">

                            <div class="image-container-list"></div>

                            <div class="add-image page-title-action">Выбрать</div>

                            <input class="images-text-list item-field" name="photo" type="hidden" data-save=""  />
                            <input name="photo-url" type="hidden" />

                        </td>
                        <td>Фамилия: *</td>
                        <td class="input">
                            <input type="text" name="lastname" data-save="" class="item-field" />
                        </td>
                    </tr>
                    <tr>
                        <td>Имя: *</td>
                        <td class="input">
                            <input type="text" name="firstname" data-save=""  class="item-field" />
                        </td>
                    </tr>
                    <tr>
                        <td>Отчество:</td>
                        <td class="input">
                            <input type="text" name="middlename" data-save=""  class="item-field" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Должность:</td>
                        <td class="input">
                            <input type="text" name="post" data-save=""  class="item-field" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Описание:</td>
                        <td class="input">
                            <textarea name="description" data-save="" class="item-field"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Язык:</td>
                        <td class="input">
                            <select name="lang" data-save="<?= $languages[0] ?>" class="item-field">
                                <?php foreach ($languages as $lang): ?>
                                    <option value="<?= $lang ?>"><?= $lang ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td align="right">
                            <a href="#cansel" class="page-title-action button-cansel">Закрыть без сохранения</a>
                            <a href="#ok" class="page-title-action button-primary button-ok">Сохранить</a>
                            <input type="hidden" name="id" value="0"/>
                        </td>
                    </tr>
                </table>

            </td>

        </tr>

        </tbody>

    </table>
    <input type="hidden" name="table" value="experts"/>

</div>