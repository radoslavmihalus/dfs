<?php

//CONFIGURATION for SmartAdmin UI
//ribbon breadcrumbs config
//array("Display Name" => "URL");
$breadcrumbs = array(
    "Admin" => APP_URL
);

/* navigation array config

  ex:
  "dashboard" => array(
  "title" => "Display Title",
  "url" => "http://yoururl.com",
  "url_target" => "_self",
  "icon" => "fa-home",
  "label_htm" => "<span>Add your custom label/badge html here</span>",
  "sub" => array() //contains array of sub items with the same format as the parent
  )

 */
$page_nav = array(
    "dashboard" => array(
        "title" => "Dashboard",
        "url" => APP_URL,
        "icon" => "fa-home"
    ),
    "users" => array(
        "title" => "Users",
        "icon" => "fa-users",
        "sub" => array(
            "registrations" => array(
                "title" => "Registrations",
                "url" => APP_URL . '/registrations.php'
            ),
        )
    ),
    "profiles" => array(
        "title" => "Profiles",
        "icon" => "fa-user",
        "sub" => array(
            "Kennels" => array(
                "title" => "Kennels",
                "url" => APP_URL . '/kennels_list.php'
            ),
            "Owners" => array(
                "title" => "Owners",
                "url" => APP_URL . ''
            ),
            "Handlers" => array(
                "title" => "Handlers",
                "url" => APP_URL . ''
            ),
            "Dogs" => array(
                "title" => "Dogs",
                "url" => APP_URL . ''
            ),
            "Puppies" => array(
                "title" => "Puppies",
                "url" => APP_URL . ''
            ),
        )
    ),
    "pageevents" => array(
        "title" => "Page events",
        "icon" => "fa-desktop",
        "sub" => array(
            "premium" => array(
                "title" => "Premium hits",
                "url" => APP_URL . ''
            ),
            "timeline" => array(
                "title" => "Timeline events",
                "url" => APP_URL . ''
            ),
            "messages" => array(
                "title" => "Messages",
                "url" => APP_URL . ''
            ),
            "comments" => array(
                "title" => "Comments",
                "url" => APP_URL . ''
            ),
            "likes" => array(
                "title" => "Likes",
                "url" => APP_URL . ''
            ),
        )
    ),
    "payments" => array(
        "title" => "Payments",
        "icon" => "fa-eur",
        "sub" => array(
            "summary" => array(
                "title" => "Summary",
                "url" => APP_URL . ''
            ),
        )
    ),
    "translate" => array(
        "title" => "Translate",
        "icon" => "fa-exchange",
        "sub" => array(
            "summary" => array(
                "title" => "Phrases",
                "url" => APP_URL . ''
            ),
        )
    ),
    
);

//configuration variables
$page_title = "";
$page_css = array();
$no_main_header = false; //set true for lock.php and login.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>
?>