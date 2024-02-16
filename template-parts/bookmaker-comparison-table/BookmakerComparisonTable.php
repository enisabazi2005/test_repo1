<?php
    $table_row = get_field("table_bookmakers_comparison");
?>
<div class="custom-table-compare">
    <table>
        <tbody>
            <?php if(is_array($table_row)): ?>
                <?php foreach($table_row as $key => $data): 
                    $bookmaker_compare = $data["bookmakers"]?>
                    <tr>
                        <?php if($key === 0): ?>
                            <td></td>
                        <?php else: ?>
                            <td>
                                <?= wp_get_attachment_image($data["icon"]); ?>
                                <span>
                                    <?= $data["icon_text"]; ?>
                                </span>
                            </td>
                        <?php endif; ?>
                        <td>
                            <?= $bookmaker_compare["first_bookmaker"]; ?>
                        </td>
                        <td>
                            <?= $bookmaker_compare["second_bookmaker"]; ?>
                        </td>
                        <td>
                            <?= $bookmaker_compare["third_bookmaker"]; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>