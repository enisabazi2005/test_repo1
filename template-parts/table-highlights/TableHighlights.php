<?php
$table_row = get_field("table_highlights");
?>
<table class="custom-table-highlights">
    <tbody>
        <?php if(is_array($table_row)): 
            foreach($table_row as $data): ?>
                <tr>
                    <td>
                        <?= wp_get_attachment_image($data["icon"]); ?>
                        <span>
                            <?= $data["icon_text"] ?>
                        </span>
                    </td>
                    <?php 
                    $type = $data["table_select"];
                    $return_value = match(true){
                        $type === "link" && 
                            is_array($data["link"]) =>  
                                        "<td>
                                            <a href=\"" . $data["link"]["url"] . "\"> "
                                                . $data["link"]["title"] . 
                                            "</a>
                                        </td>",
                        $type === "button" &&
                            is_array($data["button"])    => 
                                        "<td>
                                            <span>
                                                <a href=\"" . $data["button"]["url"]  . "\">" 
                                                    . $data["button"]["title"] . 
                                                "</a>
                                            </span>
                                        </td>",
                        $type === "text" => "<td>" . $data["text"] . "</td>",
                        $type === "text-link" =>  "<td>" . $data["text_and_link"] . "</td>",
                        default => ""
                    };
                    echo $return_value;?>
                </tr>
            <?php endforeach;
        endif;?>
    </tbody>
</table>