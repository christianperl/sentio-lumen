<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    // Get all users with http://localhost:8000/api/users
    $router->get('users', ['uses' => 'UsersController@showAllUsers']);

    // Get user who is requesting with http://localhost:8000/api/users
    $router->get('user', ['uses' => 'UsersController@showOneUser']);

    // Login with http://localhost:8000/api/login
    $router->post('user/login', ['uses' => 'UsersController@login']);

    // Logout with http://localhost:8000/api/login
    $router->post('user/logout', ['uses' => 'UsersController@logout']);

    // Create user with http://localhost:8000/api/users
    $router->post('user/register', ['uses' => 'UsersController@create']);

    // Delete user with http://localhost:8000/api/users/id
    $router->delete('user', ['uses' => 'UsersController@delete']);

    // Update user with http://localhost:8000/api/users/id
    $router->put('user', ['uses' => 'UsersController@update']);


    // Get all households
    $router->get('households', ['uses' => 'HouseholdsController@getAllHouseholds']);

    // Get one household
    $router->get('household/{id}', ['uses' => 'HouseholdsController@getOneHousehold']);

    // Create household
    $router->post('household', ['uses' => 'HouseholdsController@create']);

    // Update household
    $router->put('household', ['uses' => 'HouseholdsController@update']);

    // Delete household
    $router->delete('household', ['uses' => 'HouseholdsController@delete']);

    // Get all households from current user
    $router->get('households/user', ['uses' => 'HouseholdsController@getAllHouseholdsFromCurrentUser']);

    // Get all households from specific user
    $router->get('households/user/{id}', ['uses' => 'HouseholdsController@getAllHouseholdsFromUser']);

    // Get all users from specific household
    $router->get('household/users/{id}', ['uses' => 'HouseholdsController@getAllUsersFromHousehold']);

    // Get all admin from specific household
    $router->get('household/admins/{id}', ['uses' => 'HouseholdsController@getAdminsFromHousehold']);

    // Add admin to household
    $router->post('household/add/admin', ['uses' => 'HouseholdsController@addAdminToHousehold']);

    // Remove admin from household
    $router->delete('household/remove/admin', ['uses' => 'HouseholdsController@removeAdminFromHousehold']);

    // Add user to household
    $router->post('household/add/user', ['uses' => 'HouseholdsController@addUserToHousehold']);

    // Remove user from household
    $router->delete('household/remove/user', ['uses' => 'HouseholdsController@removeUserFromHousehold']);
});
