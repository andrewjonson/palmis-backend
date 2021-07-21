<?php

function resource($uri, $controller, $router)
{
	$version = config('app.version');
	$router->get($uri, 'ApiService\\'.$version.'\\'.$controller.'@index');
	$router->post($uri, 'ApiService\\'.$version.'\\'.$controller.'@store');
	$router->put($uri.'/{id}', 'ApiService\\'.$version.'\\'.$controller.'@update');
	$router->delete($uri.'/{id}', 'ApiService\\'.$version.'\\'.$controller.'@destroy');
    $router->put($uri.'/restore/{id}', 'ApiService\\'.$version.'\\'.$controller.'@restore');
    $router->get($uri.'/onlyTrashed', 'ApiService\\'.$version.'\\'.$controller.'@onlyTrashed');
    $router->delete($uri.'/force-delete/{id}', 'ApiService\\'.$version.'\\'.$controller.'@forceDelete');
}