<?php $list = get_field('list_highlights'); ?>

<ul class="custom-list-highlights">
    <?php foreach ($list as $row) : ?>
        <?php if (!empty($row['row'])) : ?>
            <li><?= $row['row']; ?></li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>