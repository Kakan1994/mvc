<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    'api_index' => [[], ['_controller' => 'App\\Controller\\ApiController::index'], [], [['text', '/api']], [], [], []],
    'api_quote' => [[], ['_controller' => 'App\\Controller\\ApiController::quote'], [], [['text', '/api/quote']], [], [], []],
    'api_books' => [[], ['_controller' => 'App\\Controller\\ApiController::getBooks'], [], [['text', '/api/library/books']], [], [], []],
    'api_book' => [['isbn'], ['_controller' => 'App\\Controller\\ApiController::getBookByIsbn'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/api/library/book']], [], [], []],
    'api_deck' => [[], ['_controller' => 'App\\Controller\\ApiDeckController::getDeck'], [], [['text', '/api/deck']], [], [], []],
    'api_deck_shuffle' => [[], ['_controller' => 'App\\Controller\\ApiDeckController::shuffleDeck'], [], [['text', '/api/deck/shuffle']], [], [], []],
    'api_deck_draw' => [['number'], ['number' => 1, '_controller' => 'App\\Controller\\ApiDeckController::drawCards'], ['number' => '\\d+'], [['variable', '/', '\\d+', 'number', true], ['text', '/api/deck/draw']], [], [], []],
    'api_game' => [[], ['_controller' => 'App\\Controller\\ApiDeckController::getGameStatus'], [], [['text', '/api/game']], [], [], []],
    'card_index' => [[], ['_controller' => 'App\\Controller\\CardController::index'], [], [['text', '/card']], [], [], []],
    'card_deck' => [[], ['_controller' => 'App\\Controller\\CardController::deck'], [], [['text', '/card/deck']], [], [], []],
    'card_deck_shuffle' => [[], ['_controller' => 'App\\Controller\\CardController::shuffle'], [], [['text', '/card/deck/shuffle']], [], [], []],
    'card_deck_draw' => [['count'], ['_controller' => 'App\\Controller\\CardController::draw'], [], [['variable', '/', '[^/]++', 'count', true], ['text', '/card/deck/draw']], [], [], []],
    'card_draw_many' => [[], ['_controller' => 'App\\Controller\\CardController::drawManyForm'], [], [['text', '/card/draw-many']], [], [], []],
    'game_landing' => [[], ['_controller' => 'App\\Controller\\GameController::gameLanding'], [], [['text', '/game']], [], [], []],
    'game_doc' => [[], ['_controller' => 'App\\Controller\\GameController::gameDoc'], [], [['text', '/game/doc']], [], [], []],
    'game_blackjack' => [[], ['_controller' => 'App\\Controller\\GameController::gameBlackjack'], [], [['text', '/game/blackjack']], [], [], []],
    'game_blackjack_action' => [['action'], ['_controller' => 'App\\Controller\\GameController::gameBlackjackAction'], [], [['variable', '/', '[^/]++', 'action', true], ['text', '/game/blackjack']], [], [], []],
    'game_clear' => [[], ['_controller' => 'App\\Controller\\GameController::gameClear'], [], [['text', '/game/clear']], [], [], []],
    'home' => [[], ['_controller' => 'App\\Controller\\HomeController::index'], [], [['text', '/']], [], [], []],
    'about' => [[], ['_controller' => 'App\\Controller\\HomeController::about'], [], [['text', '/about']], [], [], []],
    'report' => [[], ['_controller' => 'App\\Controller\\HomeController::report'], [], [['text', '/report']], [], [], []],
    'lucky' => [[], ['_controller' => 'App\\Controller\\HomeController::lucky'], [], [['text', '/lucky']], [], [], []],
    'cards' => [[], ['_controller' => 'App\\Controller\\HomeController::card'], [], [['text', '/card']], [], [], []],
    'metrics' => [[], ['_controller' => 'App\\Controller\\HomeController::metrics'], [], [['text', '/metrics']], [], [], []],
    'app_library' => [[], ['_controller' => 'App\\Controller\\LibraryController::index'], [], [['text', '/library']], [], [], []],
    'app_library_add' => [[], ['_controller' => 'App\\Controller\\LibraryController::add'], [], [['text', '/library/add']], [], [], []],
    'app_library_book' => [['id'], ['_controller' => 'App\\Controller\\LibraryController::viewBook'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/library/book']], [], [], []],
    'app_library_books' => [[], ['_controller' => 'App\\Controller\\LibraryController::viewBooks'], [], [['text', '/library/books']], [], [], []],
    'app_library_book_edit' => [['id'], ['_controller' => 'App\\Controller\\LibraryController::update'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/library/book']], [], [], []],
    'app_library_delete' => [['id'], ['_controller' => 'App\\Controller\\LibraryController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/library/delete']], [], [], []],
    'app_library_book_redirect' => [[], ['_controller' => 'App\\Controller\\LibraryController::redirectBook'], [], [['text', '/library/book/redirect']], [], [], []],
];
