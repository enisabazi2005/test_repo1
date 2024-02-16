<?php 
    $heading = get_field("entry_gate_strings", "option")["heading"];
    $age_restriction = get_field("entry_gate_strings", "option")["age_restriction_message"];
    $age_denial = get_field("entry_gate_strings", "option")["age_restriction_denial_message"];
?>
<div class="entrypop-layout">  
    <div class="entrypop">
        <p class='entry-heading'><?= $heading ?></p>
        <p class='entry-message'><?= $age_restriction ?></p>
        <p class='entry-challenge'><?= $age_denial ?></p>
        <button id="close-entrypop"><?php _e('YES', 'bettingpro') ?></button>
        <button id="show-message"><?php _e('NO', 'bettingpro') ?></button>
    </div>
</div> 