<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/api' => [[['_route' => 'api_index', '_controller' => 'App\\Controller\\ApiController::index'], null, null, null, false, false, null]],
        '/api/quote' => [[['_route' => 'api_quote', '_controller' => 'App\\Controller\\ApiController::quote'], null, null, null, false, false, null]],
        '/api/library/books' => [[['_route' => 'api_books', '_controller' => 'App\\Controller\\ApiController::getBooks'], null, null, null, false, false, null]],
        '/api/deck' => [[['_route' => 'api_deck', '_controller' => 'App\\Controller\\ApiDeckController::getDeck'], null, ['GET' => 0], null, false, false, null]],
        '/api/deck/shuffle' => [[['_route' => 'api_deck_shuffle', '_controller' => 'App\\Controller\\ApiDeckController::shuffleDeck'], null, ['POST' => 0], null, false, false, null]],
        '/api/game' => [[['_route' => 'api_game', '_controller' => 'App\\Controller\\ApiDeckController::getGameStatus'], null, ['GET' => 0], null, false, false, null]],
        '/card' => [
            [['_route' => 'card_index', '_controller' => 'App\\Controller\\CardController::index'], null, null, null, false, false, null],
            [['_route' => 'cards', '_controller' => 'App\\Controller\\HomeController::card'], null, null, null, false, false, null],
        ],
        '/card/deck' => [[['_route' => 'card_deck', '_controller' => 'App\\Controller\\CardController::deck'], null, null, null, false, false, null]],
        '/card/deck/shuffle' => [[['_route' => 'card_deck_shuffle', '_controller' => 'App\\Controller\\CardController::shuffle'], null, null, null, false, false, null]],
        '/card/draw-many' => [[['_route' => 'card_draw_many', '_controller' => 'App\\Controller\\CardController::drawManyForm'], null, null, null, false, false, null]],
        '/game' => [[['_route' => 'game_landing', '_controller' => 'App\\Controller\\GameController::gameLanding'], null, null, null, false, false, null]],
        '/game/doc' => [[['_route' => 'game_doc', '_controller' => 'App\\Controller\\GameController::gameDoc'], null, null, null, false, false, null]],
        '/game/blackjack' => [[['_route' => 'game_blackjack', '_controller' => 'App\\Controller\\GameController::gameBlackjack'], null, null, null, false, false, null]],
        '/game/clear' => [[['_route' => 'game_clear', '_controller' => 'App\\Controller\\GameController::gameClear'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\HomeController::index'], null, null, null, false, false, null]],
        '/about' => [[['_route' => 'about', '_controller' => 'App\\Controller\\HomeController::about'], null, null, null, false, false, null]],
        '/report' => [[['_route' => 'report', '_controller' => 'App\\Controller\\HomeController::report'], null, null, null, false, false, null]],
        '/lucky' => [[['_route' => 'lucky', '_controller' => 'App\\Controller\\HomeController::lucky'], null, null, null, false, false, null]],
        '/metrics' => [[['_route' => 'metrics', '_controller' => 'App\\Controller\\HomeController::metrics'], null, null, null, false, false, null]],
        '/library' => [[['_route' => 'app_library', '_controller' => 'App\\Controller\\LibraryController::index'], null, null, null, false, false, null]],
        '/library/add' => [[['_route' => 'app_library_add', '_controller' => 'App\\Controller\\LibraryController::add'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/library/books' => [[['_route' => 'app_library_books', '_controller' => 'App\\Controller\\LibraryController::viewBooks'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/api/(?'
                    .'|library/book/([^/]++)(*:198)'
                    .'|deck/draw(?:/(\\d+))?(*:226)'
                .')'
                .'|/card/deck/draw/([^/]++)(*:259)'
                .'|/game/blackjack/([^/]++)(*:291)'
                .'|/library/(?'
                    .'|book/(?'
                        .'|([^/]++)(?'
                            .'|(*:330)'
                            .'|/edit(*:343)'
                        .')'
                        .'|redirect(*:360)'
                    .')'
                    .'|delete/([^/]++)(*:384)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        198 => [[['_route' => 'api_book', '_controller' => 'App\\Controller\\ApiController::getBookByIsbn'], ['isbn'], null, null, false, true, null]],
        226 => [[['_route' => 'api_deck_draw', 'number' => 1, '_controller' => 'App\\Controller\\ApiDeckController::drawCards'], ['number'], ['POST' => 0], null, false, true, null]],
        259 => [[['_route' => 'card_deck_draw', '_controller' => 'App\\Controller\\CardController::draw'], ['count'], null, null, false, true, null]],
        291 => [[['_route' => 'game_blackjack_action', '_controller' => 'App\\Controller\\GameController::gameBlackjackAction'], ['action'], null, null, false, true, null]],
        330 => [[['_route' => 'app_library_book', '_controller' => 'App\\Controller\\LibraryController::viewBook'], ['id'], ['GET' => 0], null, false, true, null]],
        343 => [[['_route' => 'app_library_book_edit', '_controller' => 'App\\Controller\\LibraryController::update'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        360 => [[['_route' => 'app_library_book_redirect', '_controller' => 'App\\Controller\\LibraryController::redirectBook'], [], ['POST' => 0], null, false, false, null]],
        384 => [
            [['_route' => 'app_library_delete', '_controller' => 'App\\Controller\\LibraryController::delete'], ['id'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
