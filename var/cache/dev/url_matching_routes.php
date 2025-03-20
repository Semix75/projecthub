<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_wdt/styles' => [[['_route' => '_wdt_stylesheet', '_controller' => 'web_profiler.controller.profiler::toolbarStylesheetAction'], null, null, null, false, false, null]],
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin' => [[['_route' => 'admin', '_controller' => 'App\\Controller\\Admin\\DashboardController::index'], null, null, null, false, false, null]],
        '/generate-groups' => [[['_route' => 'app_generate_groups', '_controller' => 'App\\Controller\\AttributionController::generateGroups'], null, null, null, false, false, null]],
        '/friends' => [[['_route' => 'app_friends_list', '_controller' => 'App\\Controller\\FriendshipController::listFriends'], null, null, null, false, false, null]],
        '/friend-requests' => [[['_route' => 'app_friend_requests', '_controller' => 'App\\Controller\\FriendshipController::listFriendRequests'], null, null, null, false, false, null]],
        '/friends/blocked' => [[['_route' => 'app_list_block_friend', '_controller' => 'App\\Controller\\FriendshipController::listBlockedFriends'], null, ['GET' => 0], null, false, false, null]],
        '/friends/add' => [[['_route' => 'app_add_friend', '_controller' => 'App\\Controller\\FriendshipController::addFriend'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/groups' => [[['_route' => 'app_groups_list', '_controller' => 'App\\Controller\\GroupController::listGroups'], null, null, null, false, false, null]],
        '/' => [
            [['_route' => 'app_home_page', '_controller' => 'App\\Controller\\HomePageController::index'], null, null, null, false, false, null],
            [['_route' => 'home', '_controller' => 'App\\Controller\\HomePageController::index'], null, null, null, false, false, null],
        ],
        '/profil' => [[['_route' => 'app_profil', '_controller' => 'App\\Controller\\ProfilController::index'], null, null, null, false, false, null]],
        '/projets' => [[['_route' => 'projets_index', '_controller' => 'App\\Controller\\ProjetController::index'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\RegistrationController::register'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
        '/voeux' => [[['_route' => 'app_voeux', '_controller' => 'App\\Controller\\VoeuxController::new'], null, null, null, false, false, null]],
        '/voeux/edit' => [[['_route' => 'app_voeux_edit', '_controller' => 'App\\Controller\\VoeuxController::edit'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/api(?'
                    .'|/(?'
                        .'|\\.well\\-known/genid/([^/]++)(*:46)'
                        .'|validation_errors/([^/]++)(*:79)'
                    .')'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:115)'
                    .'|/(?'
                        .'|docs(?:\\.([^/]++))?(*:146)'
                        .'|con(?'
                            .'|texts/([^.]+)(?:\\.(jsonld))?(*:188)'
                            .'|versations(?'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(*:235)'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:261)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:299)'
                                .')'
                            .')'
                        .')'
                        .'|errors/(\\d+)(?:\\.([^/]++))?(*:337)'
                        .'|validation_errors/([^/]++)(?'
                            .'|(*:374)'
                        .')'
                        .'|friendships(?'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(*:423)'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:449)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:487)'
                            .')'
                        .')'
                        .'|messages(?'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(*:534)'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:560)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:598)'
                            .')'
                        .')'
                    .')'
                .')'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:641)'
                    .'|wdt/([^/]++)(*:661)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:703)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:740)'
                                .'|router(*:754)'
                                .'|exception(?'
                                    .'|(*:774)'
                                    .'|\\.css(*:787)'
                                .')'
                            .')'
                            .'|(*:797)'
                        .')'
                    .')'
                .')'
                .'|/friend(?'
                    .'|\\-requests/(?'
                        .'|accept/([^/]++)(*:847)'
                        .'|decline/([^/]++)(*:871)'
                    .')'
                    .'|s/(?'
                        .'|remove/([^/]++)(*:900)'
                        .'|block/([^/]++)(*:922)'
                        .'|unblock/([^/]++)(*:946)'
                    .')'
                .')'
                .'|/pro(?'
                    .'|file/([^/]++)(*:976)'
                    .'|jet/([^/]++)(*:996)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        46 => [[['_route' => 'api_genid', '_controller' => 'api_platform.action.not_exposed', '_api_respond' => 'true'], ['id'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        79 => [[['_route' => 'api_validation_errors', '_controller' => 'api_platform.action.not_exposed'], ['id'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        115 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        146 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        188 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        235 => [[['_route' => '_api_/conversations/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Conversation', '_api_operation_name' => '_api_/conversations/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        261 => [
            [['_route' => '_api_/conversations{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Conversation', '_api_operation_name' => '_api_/conversations{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/conversations{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Conversation', '_api_operation_name' => '_api_/conversations{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        299 => [
            [['_route' => '_api_/conversations/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Conversation', '_api_operation_name' => '_api_/conversations/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/conversations/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Conversation', '_api_operation_name' => '_api_/conversations/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        337 => [[['_route' => '_api_errors', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\State\\ApiResource\\Error', '_api_operation_name' => '_api_errors'], ['status', '_format'], ['GET' => 0], null, false, true, null]],
        374 => [
            [['_route' => '_api_validation_errors_problem', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_problem'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_validation_errors_hydra', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_hydra'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_validation_errors_jsonapi', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_jsonapi'], ['id'], ['GET' => 0], null, false, true, null],
        ],
        423 => [[['_route' => '_api_/friendships/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Friendship', '_api_operation_name' => '_api_/friendships/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        449 => [
            [['_route' => '_api_/friendships{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Friendship', '_api_operation_name' => '_api_/friendships{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/friendships{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Friendship', '_api_operation_name' => '_api_/friendships{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        487 => [
            [['_route' => '_api_/friendships/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Friendship', '_api_operation_name' => '_api_/friendships/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/friendships/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Friendship', '_api_operation_name' => '_api_/friendships/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        534 => [[['_route' => '_api_/messages/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Message', '_api_operation_name' => '_api_/messages/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        560 => [
            [['_route' => '_api_/messages{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Message', '_api_operation_name' => '_api_/messages{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/messages{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Message', '_api_operation_name' => '_api_/messages{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        598 => [
            [['_route' => '_api_/messages/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Message', '_api_operation_name' => '_api_/messages/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/messages/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Message', '_api_operation_name' => '_api_/messages/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        641 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        661 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        703 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        740 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        754 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        774 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        787 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        797 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        847 => [[['_route' => 'app_accept_friend', '_controller' => 'App\\Controller\\FriendshipController::acceptFriendRequest'], ['id'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        871 => [[['_route' => 'app_decline_friend', '_controller' => 'App\\Controller\\FriendshipController::declineFriendRequest'], ['id'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        900 => [[['_route' => 'app_remove_friend', '_controller' => 'App\\Controller\\FriendshipController::removeFriend'], ['userId'], ['POST' => 0], null, false, true, null]],
        922 => [[['_route' => 'app_block_friend', '_controller' => 'App\\Controller\\FriendshipController::blockFriend'], ['userId'], ['POST' => 0], null, false, true, null]],
        946 => [[['_route' => 'app_unblock_friend', '_controller' => 'App\\Controller\\FriendshipController::unblockFriend'], ['id'], ['POST' => 0], null, false, true, null]],
        976 => [[['_route' => 'app_user_profile', '_controller' => 'App\\Controller\\FriendshipController::userProfile'], ['id'], null, null, false, true, null]],
        996 => [
            [['_route' => 'projet_detail', '_controller' => 'App\\Controller\\ProjetController::detail'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
