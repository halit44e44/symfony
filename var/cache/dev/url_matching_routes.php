<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/user' => [[['_route' => 'app_user', '_controller' => 'App\\Controller\\UserController::index'], null, null, null, false, false, null]],
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
        '/api/user' => [[['_route' => 'user', '_controller' => 'App\\Controller\\UserController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/getAllOrders' => [[['_route' => 'getAllOrders', '_controller' => 'App\\Controller\\OrderController::getAllOrders'], null, ['GET' => 0], null, false, false, null]],
        '/api/createOrder' => [[['_route' => 'createOrder', '_controller' => 'App\\Controller\\OrderController::createOrder'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|getOrder/([^/]++)(*:67)'
                    .'|updateOrder/([^/]++)(*:94)'
                    .'|shippingUpdate/([^/]++)(*:124)'
                    .'|deleteOrder/([^/]++)(*:152)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        67 => [[['_route' => 'getOrder', '_controller' => 'App\\Controller\\OrderController::getOrder'], ['orderCode'], ['GET' => 0], null, false, true, null]],
        94 => [[['_route' => 'updateOrder', '_controller' => 'App\\Controller\\OrderController::updateOrder'], ['orderCode'], ['PUT' => 0], null, false, true, null]],
        124 => [[['_route' => 'shippingUpdate', '_controller' => 'App\\Controller\\OrderController::shippingUpdate'], ['orderCode'], ['PATCH' => 0], null, false, true, null]],
        152 => [
            [['_route' => 'deleteOrder', '_controller' => 'App\\Controller\\OrderController::deleteOrder'], ['orderCode'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
