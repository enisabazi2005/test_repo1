<?php  
    $bookmakerCTA = get_field("bookmaker_cta");
    $template = $bookmakerCTA["template"];
    $bookmakerFields = get_field("main_info", $bookmakerCTA["bookmaker"]);
    $offer = [
        "title" => $bookmakerFields["button_text"],
        "url" => $bookmakerFields["link"],
    ];

    if (is_array($bookmakerCTA["offer_url"])) {
        $offer = $bookmakerCTA["offer_url"];
    }

    switch ($template) {
        case "SingleTemplate":
            require("templates/SingleTemplate.php");
            break;
        default :
            require("templates/ListTemplate.php");
    }