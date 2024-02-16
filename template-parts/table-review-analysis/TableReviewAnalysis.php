<?php
$table_row = get_field("table_review_analysis");
?>
<table class="custom-table-review">
    <tbody>
        <?php foreach($table_row as $data): ?>
            <tr class='rows'>
                <td class='icon_description'>
                    <?= wp_get_attachment_image($data["icon"]); ?>
                    <span>
                        <?= $data["description"] ?>
                    </span>
                </td>
                <td class='rating'>
                    <?= $data["rating"] ?> / 5
                </td>
                <td class='stars'>
                    <?= $data["stars"] ?>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>