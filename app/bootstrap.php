<?php

// Load Nette Framework
if (@!include __DIR__ . '/../libs/Nette/loader.php') {
    die('Install Nette using `composer update`');
}

use Nette\Application\Routers\Route,
    Nette\Application\Routers\SimpleRouter;

// Configure application
$configurator = new Nette\Configurator;

// Enable Nette Debugger for error visualisation & logging
$configurator->enableDebugger(__DIR__ . '/../log');
error_reporting(E_ERROR);

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
        ->addDirectory(__DIR__)
        ->register();

$requestFatory = new Nette\Http\RequestFactory;
$request = $requestFatory->createHttpRequest();
$response = new Nette\Http\Response;

$session = new Nette\Http\Session($request, $response);

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/config.neon');

//$configurator->addServices(
//        array(
//            'http.request' => $request,
//            'http.response' => $response,
//            'session.session' => $session,
//));

$container = $configurator->createContainer();


// Setup router using mod_rewrite detection
$router = $container->getService('router');

//require_once 'www/inc/config_ajax.php';
//
//function getSeo($text) {
//    $utf8table = array("," => "-", "\"" => "", "'" => "", " " => "-", "\xc3\xa1" => "a", "\xc3\xa4" => "a", "\xc4\x8d" => "c", "\xc4\x8f" => "d", "\xc3\xa9" => "e", "\xc4\x9b" => "e", "\xc3\xad" => "i", "\xc4\xbe" => "l", "\xc4\xba" => "l", "\xc5\x88" => "n", "\xc3\xb3" => "o", "\xc3\xb6" => "o", "\xc5\x91" => "o", "\xc3\xb4" => "o", "\xc5\x99" => "r", "\xc5\x95" => "r", "\xc5\xa1" => "s", "\xc5\xa5" => "t", "\xc3\xba" => "u", "\xc5\xaf" => "u", "\xc3\xbc" => "u", "\xc5\xb1" => "u", "\xc3\xbd" => "y", "\xc5\xbe" => "z", "\xc3\x81" => "A", "\xc3\x84" => "A", "\xc4\x8c" => "C", "\xc4\x8e" => "D", "\xc3\x89" => "E", "\xc4\x9a" => "E", "\xc3\x8d" => "I", "\xc4\xbd" => "L", "\xc4\xb9" => "L", "\xc5\x87" => "N", "\xc3\x93" => "O", "\xc3\x96" => "O", "\xc5\x90" => "O", "\xc3\x94" => "O", "\xc5\x98" => "R", "\xc5\x94" => "R", "\xc5\xa0" => "S", "\xc5\xa4" => "T", "\xc3\x9a" => "U", "\xc5\xae" => "U", "\xc3\x9c" => "U", "\xc5\xb0" => "U", "\xc3\x9d" => "Y", "\xc5\xbd" => "Z");
//    $text = strtr($text, $utf8table);
//    return $text;
//}
//
//$context = getContext();
//
//$rows = $context->table("tbl_userkennel")->select("id,kennel_name")->fetchAll();
//
//foreach ($rows as $row) {
//    $name = strtolower(getSeo($row->kennel_name));
//    if (strlen($name) > 2) {
//        $router[] = new Route($name, array(
//            'presenter' => 'kennel',
//            'action' => 'kennel_profile_home',
//            'id' => $row->id,
//        ));
//    }
//}
//$router[] = new Route("michal.slepanek", array(
//    'presenter' => 'owner',
//    'action' => 'owner_profile_home',
//    'id' => '300000000',
//        ));

$router[] = new Route('index.php', 'LandingPage:default');
$router[] = new Route('[<lang=en cz|en|de|sk|hu|ru>]', 'LandingPage:default');
$router[] = new Route('payment_return.php', 'LandingPage:payment');
//$router[] = new Route('forgot-password', 'LandingPage:forgot_password');
//$router[] = new Route('reset-password', 'LandingPage:reset_password');
// Base routes
$router[] = new Route('add-photo', 'photo:photo_add');
$router[] = new Route('edit-photo', 'photo:photo_edit');
//---------------------------   Photo / photo list -----------------------------------
$router[] = new Route('photo', array(
    'presenter' => 'photo',
    'action' => 'photo_list',
    'lang' => 'en'));
$router[] = new Route('cz-fotografie', array(
    'presenter' => 'photo',
    'action' => 'photo_list',
    'lang' => 'cz'));
$router[] = new Route('fotos', array(
    'presenter' => 'photo',
    'action' => 'photo_list',
    'lang' => 'de'));
$router[] = new Route('fényképek', array(
    'presenter' => 'photo',
    'action' => 'photo_list',
    'lang' => 'hu'));
$router[] = new Route('Фотографии', array(
    'presenter' => 'photo',
    'action' => 'photo_list',
    'lang' => 'ru'));
$router[] = new Route('sk-fotografie', array(
    'presenter' => 'photo',
    'action' => 'photo_list',
    'lang' => 'sk'));

$router[] = new Route('add-video', 'video:video_add');
$router[] = new Route('edit-video', 'video:video_edit');
//---------------------------   Video / video list -----------------------------------
$router[] = new Route('video', array(
    'presenter' => 'video',
    'action' => 'video_list',
    'lang' => 'en'));
$router[] = new Route('cz-videa', array(
    'presenter' => 'video',
    'action' => 'video_list',
    'lang' => 'cz'));
$router[] = new Route('videos', array(
    'presenter' => 'video',
    'action' => 'video_list',
    'lang' => 'de'));
$router[] = new Route('videók', array(
    'presenter' => 'video',
    'action' => 'video_list',
    'lang' => 'hu'));
$router[] = new Route('Видеозаписи', array(
    'presenter' => 'video',
    'action' => 'video_list',
    'lang' => 'ru'));
$router[] = new Route('sk-videa', array(
    'presenter' => 'video',
    'action' => 'video_list',
    'lang' => 'sk'));
// User routes
//---------------------------   User / switch profile -----------------------------------
$router[] = new Route('switch-profile', 'user:user_create_profile_switcher');
$router[] = new Route('create-profile', 'user:user_create_profile_switcher_new');
//---------------------------   User / premium account -----------------------------------
$router[] = new Route('premium-account', 'user:user_premium');
$router[] = new Route('premium-account-activation', 'user:user_premium_activation');
$router[] = new Route('edit-account', 'user:user_edit_account');
$router[] = new Route('list-of-friends-requests', 'user:user_friend_requests_list');
$router[] = new Route('notification-list', 'user:user_notification_list');
$router[] = new Route('message-list', 'user:user_message_list');
$router[] = new Route('message-compose', 'user:user_message_compose');
$router[] = new Route('premium-new', 'user:user_premium_test');
// Kennel routes
//---------------------------   Kennels / create profile -----------------------------------
$router[] = new Route('kennel-create-profile', 'kennel:kennel_create_profile');
//---------------------------   Kennels / profile home -----------------------------------
$router[] = new Route('kennel-profile', 'kennel:kennel_profile_home');
//---------------------------   Kennels / list of kennels -----------------------------------
$router[] = new Route('kennels', array(
    'presenter' => 'kennel',
    'action' => 'kennel_list',
    'lang' => 'en'));
$router[] = new Route('cz-chovatelske-stanice', array(
    'presenter' => 'kennel',
    'action' => 'kennel_list',
    'lang' => 'cz'));
$router[] = new Route('zwinger', array(
    'presenter' => 'kennel',
    'action' => 'kennel_list',
    'lang' => 'de'));
$router[] = new Route('kennelek', array(
    'presenter' => 'kennel',
    'action' => 'kennel_list',
    'lang' => 'hu'));
$router[] = new Route('Питомники', array(
    'presenter' => 'kennel',
    'action' => 'kennel_list',
    'lang' => 'ru'));
$router[] = new Route('sk-chovatelske-stanice', array(
    'presenter' => 'kennel',
    'action' => 'kennel_list',
    'lang' => 'sk'));

$router[] = new Route('kennel-edit-profile', 'kennel:kennel_edit_profile');
$router[] = new Route('kennel-awards-list', 'kennel:kennel_awards_list');
$router[] = new Route('kennel-awards-add', 'kennel:kennel_awards_add');
$router[] = new Route('kennel-awards-edit', 'kennel:kennel_awards_edit');
$router[] = new Route('kennel-dog-list', 'kennel:kennel_dog_list');
$router[] = new Route('kennel-puppy-list', 'kennel:kennel_puppy_list');
$router[] = new Route('kennel-photogallery', 'kennel:kennel_photogallery');
$router[] = new Route('kennel-videogallery', 'kennel:kennel_videogallery');
$router[] = new Route('kennel-planned-litter-list', 'kennel:kennel_planned_litter_list');
$router[] = new Route('kennel-friends-list', 'kennel:kennel_friends_list');
$router[] = new Route('kennel-followers-list', 'kennel:kennel_followers_list');
$router[] = new Route('kennel-planned-litter-add', 'kennel:kennel_planned_litter_add');
$router[] = new Route('kennel-planned-litter-edit', 'kennel:kennel_planned_litter_edit');
//---------------------------   Kennels / planned litters -----------------------------------
$router[] = new Route('planned-litters', array(
    'presenter' => 'kennel',
    'action' => 'planned_litter_list',
    'lang' => 'en'));
$router[] = new Route('cz-planovane-vrhy', array(
    'presenter' => 'kennel',
    'action' => 'planned_litter_list',
    'lang' => 'cz'));
$router[] = new Route('geplante-wurfe', array(
    'presenter' => 'kennel',
    'action' => 'planned_litter_list',
    'lang' => 'de'));
$router[] = new Route('tervezett-parositasok', array(
    'presenter' => 'kennel',
    'action' => 'planned_litter_list',
    'lang' => 'hu'));
$router[] = new Route('Планируемые-пометы', array(
    'presenter' => 'kennel',
    'action' => 'planned_litter_list',
    'lang' => 'ru'));
$router[] = new Route('sk-planovane-vrhy', array(
    'presenter' => 'kennel',
    'action' => 'planned_litter_list',
    'lang' => 'sk'));
// Handler routes
//---------------------------   Handler / create profile -----------------------------------
$router[] = new Route('handler-create-profile', 'handler:handler_create_profile');
//---------------------------   Handler / profile home -----------------------------------
$router[] = new Route('handler-profile', 'handler:handler_profile_home');
//---------------------------   Handler / list of handlers -----------------------------------
$router[] = new Route('handlers', array(
    'presenter' => 'handler',
    'action' => 'handler_list',
    'lang' => 'en'));
$router[] = new Route('handleri', array(
    'presenter' => 'handler',
    'action' => 'handler_list',
    'lang' => 'cz'));
$router[] = new Route('handler', array(
    'presenter' => 'handler',
    'action' => 'handler_list',
    'lang' => 'de'));
$router[] = new Route('handlerek', array(
    'presenter' => 'handler',
    'action' => 'handler_list',
    'lang' => 'hu'));
$router[] = new Route('Дрессировщики-собак', array(
    'presenter' => 'handler',
    'action' => 'handler_list',
    'lang' => 'ru'));
$router[] = new Route('handlery', array(
    'presenter' => 'handler',
    'action' => 'handler_list',
    'lang' => 'sk'));

$router[] = new Route('handler-edit-profile', 'handler:handler_edit_profile');
$router[] = new Route('handler-handling-breed-list', 'handler:handler_handling_breed_list');
$router[] = new Route('handler-handling-breed-add', 'handler:handler_handling_breed_add');
$router[] = new Route('handler-handling-breed-edit', 'handler:handler_handling_breed_edit');
$router[] = new Route('handler-awards-list', 'handler:handler_awards_list');
$router[] = new Route('handler-awards-add', 'handler:handler_awards_add');
$router[] = new Route('handler-awards-edit', 'handler:handler_awards_edit');
$router[] = new Route('handler-certificates-list', 'handler:handler_certificates_list');
$router[] = new Route('handler-certificates-add', 'handler:handler_certificates_add');
$router[] = new Route('handler-certificates-edit', 'handler:handler_certificates_edit');
$router[] = new Route('handler-show-list', 'handler:handler_show_list');
$router[] = new Route('handler-show-add-name', 'handler:handler_show_add_name');
$router[] = new Route('handler-show-edit-name', 'handler:handler_show_edit_name');
$router[] = new Route('handler-show-add', 'handler:handler_show_add');
$router[] = new Route('handler-show-edit', 'handler:handler_show_edit');
$router[] = new Route('handler-friends-list', 'handler:handler_friends_list');
$router[] = new Route('handler-followers-list', 'handler:handler_followers_list');
$router[] = new Route('handler-photogallery', 'handler:handler_photogallery');
$router[] = new Route('handler-videogallery', 'handler:handler_videogallery');
// Owner routes
//---------------------------   Owner / create profile -----------------------------------
$router[] = new Route('owner-create-profile', 'owner:owner_create_profile');
//---------------------------   Owner / profile home -----------------------------------
$router[] = new Route('owner-profile', 'owner:owner_profile_home');
//---------------------------   Owners / list of owners -----------------------------------
$router[] = new Route('owners-of-purebred-dogs', array(
    'presenter' => 'owner',
    'action' => 'owner_list',
    'lang' => 'en'));
$router[] = new Route('majitele-psu-s-prukazem-puvodu', array(
    'presenter' => 'owner',
    'action' => 'owner_list',
    'lang' => 'cz'));
$router[] = new Route('hundebesitzer-mit-dem-herkunftsnachweis', array(
    'presenter' => 'owner',
    'action' => 'owner_list',
    'lang' => 'de'));
$router[] = new Route('torzskonyves-kutyak-tulajdonosai', array(
    'presenter' => 'owner',
    'action' => 'owner_list',
    'lang' => 'hu'));
$router[] = new Route('Владельцы-собак-с-родословной', array(
    'presenter' => 'owner',
    'action' => 'owner_list',
    'lang' => 'ru'));
$router[] = new Route('majitelia-psov-s-preukazom-povodu', array(
    'presenter' => 'owner',
    'action' => 'owner_list',
    'lang' => 'sk'));

$router[] = new Route('owner-edit-profile', 'owner:owner_edit_profile');
$router[] = new Route('owner-dog-list', 'owner:owner_dog_list');
$router[] = new Route('owner-photogallery', 'owner:owner_photogallery');
$router[] = new Route('owner-videogallery', 'owner:owner_videogallery');
$router[] = new Route('owner-friends-list', 'owner:owner_friends_list');
$router[] = new Route('owner-followers-list', 'owner:owner_followers_list');
$router[] = new Route('owner-photogallery', 'owner:owner_photogallery');
$router[] = new Route('owner-videogallery', 'owner:video_photogallery');
// Dog routes
//---------------------------   Dogs / create profile -----------------------------------
$router[] = new Route('add-dog', 'dog:dog_create_profile');
//---------------------------   Dogs / profile home -----------------------------------
$router[] = new Route('dog', 'dog:dog_profile_home');
//---------------------------   Dogs / list of dogs -----------------------------------
$router[] = new Route('dogs-with-pedigree', array(
    'presenter' => 'dog',
    'action' => 'dog_list',
    'lang' => 'en'));
$router[] = new Route('psi-s-prukazem-puvodu', array(
    'presenter' => 'dog',
    'action' => 'dog_list',
    'lang' => 'cz'));
$router[] = new Route('hunde-mit-herkunftsnachweis', array(
    'presenter' => 'dog',
    'action' => 'dog_list',
    'lang' => 'de'));
$router[] = new Route('torzskonyves-kutyak', array(
    'presenter' => 'dog',
    'action' => 'dog_list',
    'lang' => 'hu'));
$router[] = new Route('Собаки-с-родословной', array(
    'presenter' => 'dog',
    'action' => 'dog_list',
    'lang' => 'ru'));
$router[] = new Route('psy-s-preukazom-povodu', array(
    'presenter' => 'dog',
    'action' => 'dog_list',
    'lang' => 'sk'));
$router[] = new Route('best-in-show', 'dog:dog_list_bestinshow');
//---------------------------   Dogs / Dog for mating list -----------------------------------
$router[] = new Route('stud-dogs', array(
    'presenter' => 'dog',
    'action' => 'dog_for_mating_list',
    'lang' => 'en'));
$router[] = new Route('chovni-psi', array(
    'presenter' => 'dog',
    'action' => 'dog_for_mating_list',
    'lang' => 'cz'));
$router[] = new Route('zuchthunde', array(
    'presenter' => 'dog',
    'action' => 'dog_for_mating_list',
    'lang' => 'de'));
$router[] = new Route('tenyeszkutyak', array(
    'presenter' => 'dog',
    'action' => 'dog_for_mating_list',
    'lang' => 'hu'));
$router[] = new Route('Племенные-собаки', array(
    'presenter' => 'dog',
    'action' => 'dog_for_mating_list',
    'lang' => 'ru'));
$router[] = new Route('chovni-psy', array(
    'presenter' => 'dog',
    'action' => 'dog_for_mating_list',
    'lang' => 'sk'));
//---------------------------   Dogs / Dog best in show list -----------------------------------
$router[] = new Route('en-best-in-show', array(
    'presenter' => 'dog',
    'action' => 'dog_bis_list',
    'lang' => 'en'));
$router[] = new Route('cz-best-in-show', array(
    'presenter' => 'dog',
    'action' => 'dog_bis_list',
    'lang' => 'cz'));
$router[] = new Route('de-best-in-show', array(
    'presenter' => 'dog',
    'action' => 'dog_bis_list',
    'lang' => 'de'));
$router[] = new Route('hu-best-in-show', array(
    'presenter' => 'dog',
    'action' => 'dog_bis_list',
    'lang' => 'hu'));
$router[] = new Route('ru-best-in-show', array(
    'presenter' => 'dog',
    'action' => 'dog_bis_list',
    'lang' => 'ru'));
$router[] = new Route('sk-best-in-show', array(
    'presenter' => 'dog',
    'action' => 'dog_bis_list',
    'lang' => 'sk'));
//---------------------------   Dogs / Dogs with pedigree for sale -----------------------------------
$router[] = new Route('dogs-with-pedigree-for-sale', array(
    'presenter' => 'dog',
    'action' => 'dog_for_sale_list',
    'lang' => 'en'));
$router[] = new Route('psi-s-prukazem-puvodu-na-prodej', array(
    'presenter' => 'dog',
    'action' => 'dog_for_sale_list',
    'lang' => 'cz'));
$router[] = new Route('hunde-mit-herkunftsnachweis-zu-verkaufen', array(
    'presenter' => 'dog',
    'action' => 'dog_for_sale_list',
    'lang' => 'de'));
$router[] = new Route('elado-torzskonyves-kutyak', array(
    'presenter' => 'dog',
    'action' => 'dog_for_sale_list',
    'lang' => 'hu'));
$router[] = new Route('Собаки-с-родословной-для-продажи', array(
    'presenter' => 'dog',
    'action' => 'dog_for_sale_list',
    'lang' => 'ru'));
$router[] = new Route('psy-s-preukazom-povodu-na-predaj', array(
    'presenter' => 'dog',
    'action' => 'dog_for_sale_list',
    'lang' => 'sk'));

$router[] = new Route('dog-profile-edit', 'dog:dog_edit_profile');
$router[] = new Route('dog-championschip-list', 'dog:dog_championschip_list');
$router[] = new Route('dog-championschip-add', 'dog:dog_championschip_add');
$router[] = new Route('dog-championschip-edit', 'dog:dog_championschip_edit');
$router[] = new Route('dog-show-add', 'dog:dog_show_add');
$router[] = new Route('dog-show-edit', 'dog:dog_show_edit');
$router[] = new Route('dog-show-list', 'dog:dog_show_list');
$router[] = new Route('dog-workexam-list', 'dog:dog_workexam_list');
$router[] = new Route('dog-workexam-add', 'dog:dog_workexam_add');
$router[] = new Route('dog-workexam-edit', 'dog:dog_workexam_edit');
$router[] = new Route('dog-health-list', 'dog:dog_health_list');
$router[] = new Route('dog-health-add', 'dog:dog_health_add');
$router[] = new Route('dog-health-edit', 'dog:dog_health_edit');
$router[] = new Route('dog-pedigree', 'dog:dog_pedigree_list');
$router[] = new Route('dog-pedigree-edit', 'dog:dog_pedigree_edit');
$router[] = new Route('dog-mating-list', 'dog:dog_mating_list');
$router[] = new Route('dog-mating-add', 'dog:dog_mating_add');
$router[] = new Route('dog-mating-edit', 'dog:dog_mating_edit');
$router[] = new Route('dog-coowner-list', 'dog:dog_coowner_list');
$router[] = new Route('dog-coowner-add', 'dog:dog_coowner_add');
$router[] = new Route('dog-coowner-edit', 'dog:dog_coowner_edit');
$router[] = new Route('dog-planned-litter-list', 'dog:dog_planned_litter_list');
$router[] = new Route('dog-photogallery', 'dog:dog_photogallery');
$router[] = new Route('dog-videogallery', 'dog:dog_videogallery');
// Puppy routes
//---------------------------   Puppies / Puppy list -----------------------------------
$router[] = new Route('puppies-for-sale', array(
    'presenter' => 'puppy',
    'action' => 'puppy_list',
    'lang' => 'en'));
$router[] = new Route('stenata-na-prodej', array(
    'presenter' => 'puppy',
    'action' => 'puppy_list',
    'lang' => 'cz'));
$router[] = new Route('welpen-zum-verkauf', array(
    'presenter' => 'puppy',
    'action' => 'puppy_list',
    'lang' => 'de'));
$router[] = new Route('elado-kiskutyak', array(
    'presenter' => 'puppy',
    'action' => 'puppy_list',
    'lang' => 'hu'));
$router[] = new Route('Щенки-для-продажи', array(
    'presenter' => 'puppy',
    'action' => 'puppy_list',
    'lang' => 'ru'));
$router[] = new Route('steniatka-na-predaj', array(
    'presenter' => 'puppy',
    'action' => 'puppy_list',
    'lang' => 'sk'));
$router[] = new Route('puppy-profile', 'puppy:puppy_description');
$router[] = new Route('puppy-pedigree', 'puppy:puppy_pedigree_list');
$router[] = new Route('puppy-pedigree-edit', 'puppy:puppy_pedigree_edit');
$router[] = new Route('puppy-create-profile', 'puppy:puppy_create_profile');
$router[] = new Route('puppy-edit-profile', 'puppy:puppy_edit_profile');
$router[] = new Route('puppy-description-add', 'puppy:puppy_description_add');
$router[] = new Route('puppy-description-edit', 'puppy:puppy_description_edit');
$router[] = new Route('puppy-photogallery', 'puppy:puppy_photogallery');
// Pages routes
//---------------------------   Pages / timeline -----------------------------------
$router[] = new Route('timeline-events', array(
    'presenter' => 'timeline',
    'action' => 'timeline_wall',
    'lang' => 'en'));
$router[] = new Route('casova-osa', array(
    'presenter' => 'timeline',
    'action' => 'timeline_wall',
    'lang' => 'cz'));
$router[] = new Route('zeitachse', array(
    'presenter' => 'timeline',
    'action' => 'timeline_wall',
    'lang' => 'de'));
$router[] = new Route('idovonal-esemenyek', array(
    'presenter' => 'timeline',
    'action' => 'timeline_wall',
    'lang' => 'hu'));
$router[] = new Route('Ось-времени', array(
    'presenter' => 'timeline',
    'action' => 'timeline_wall',
    'lang' => 'ru'));
$router[] = new Route('casova-os', array(
    'presenter' => 'timeline',
    'action' => 'timeline_wall',
    'lang' => 'sk'));
//---------------------------   Pages / general terms -----------------------------------
$router[] = new Route('general-terms', array(
    'presenter' => 'pages',
    'action' => 'general_terms',
    'lang' => 'en'));
$router[] = new Route('vseobecne-podminky', array(
    'presenter' => 'pages',
    'action' => 'general_terms',
    'lang' => 'cz'));
$router[] = new Route('allgemeine-bedingungen', array(
    'presenter' => 'pages',
    'action' => 'general_terms',
    'lang' => 'de'));
$router[] = new Route('altalanos-feltetelek', array(
    'presenter' => 'pages',
    'action' => 'general_terms',
    'lang' => 'hu'));
$router[] = new Route('наши-Общие-условия', array(
    'presenter' => 'pages',
    'action' => 'general_terms',
    'lang' => 'ru'));
$router[] = new Route('vseobecne-podmienky', array(
    'presenter' => 'pages',
    'action' => 'general_terms',
    'lang' => 'sk'));
//---------------------------   Pages / cookie policy -----------------------------------
$router[] = new Route('cookie-policy', array(
    'presenter' => 'pages',
    'action' => 'cookie_policy',
    'lang' => 'en'));
$router[] = new Route('cz-politika-cookies', array(
    'presenter' => 'pages',
    'action' => 'cookie_policy',
    'lang' => 'cz'));
$router[] = new Route('die-cookies-politik', array(
    'presenter' => 'pages',
    'action' => 'cookie_policy',
    'lang' => 'de'));
$router[] = new Route('cookie-iranyelv', array(
    'presenter' => 'pages',
    'action' => 'cookie_policy',
    'lang' => 'hu'));
$router[] = new Route('Политика-куки', array(
    'presenter' => 'pages',
    'action' => 'cookie_policy',
    'lang' => 'ru'));
$router[] = new Route('sk-politika-cookies', array(
    'presenter' => 'pages',
    'action' => 'cookie_policy',
    'lang' => 'sk'));

$router[] = new Route('[<lang=en cz|en|de|sk|hu|ru>/]<presenter>/<action>', "LandingPage:default");
//$router[] = new Route('<presenter>/<action>[/<id>]', 'LandingPage:default');
//$router[] = new Route('en/<presenter>/<action>[/<id>]', array(
//    'presenter' => 'LandingPage',
//    'action' => 'default',
//    'lang' => 'en'));
//$router[] = new Route('cz/<presenter>/<action>[/<id>]', array(
//    'presenter' => 'LandingPage',
//    'action' => 'default',
//    'lang' => 'cz'));
//$router[] = new Route('de/<presenter>/<action>[/<id>]', array(
//    'presenter' => 'LandingPage',
//    'action' => 'default',
//    'lang' => 'de'));
//$router[] = new Route('hu/<presenter>/<action>[/<id>]', array(
//    'presenter' => 'LandingPage',
//    'action' => 'default',
//    'lang' => 'hu'));
//$router[] = new Route('ru/<presenter>/<action>[/<id>]', array(
//    'presenter' => 'LandingPage',
//    'action' => 'default',
//    'lang' => 'ru'));
//$router[] = new Route('sk/<presenter>/<action>[/<id>]', array(
//    'presenter' => 'LandingPage',
//    'action' => 'default',
//    'lang' => 'sk'));
// routy
//$cache = Nette\Environment::getCache();
//$cache->clean(array(\Nette\Caching\Cache::ALL => true));

return $container;
