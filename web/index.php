<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array (
        'driver'    => 'pdo_mysql',
        'host'      => 'db4free.net',
        'port'		=> '3306',
        'dbname'    => 'silex_rest_api',
        'user'      => 'silex_rest_api',
        'password'  => 'silex_rest_api'
    ),
));
 
$app->get('/api/mensagens/', function() use ($app) {

	$mensagens = $app['db']->fetchAll('SELECT * FROM mensagens');

	return $app->json($mensagens);
});

$app->post('/api/mensagens/', function(Request $request) use ($app) {

	if (!$request->get('text')) {

		return new Response('The parameter "text" is required.', 422);
	}

	$app['db']->insert('mensagens', array('text' => $request->get('text')));;

	return new Response('Message created!', 201);
});

 
$app->get('/api/mensagens/{id}', function ($id) use ($app) {

	$mensagem = $app['db']->fetchAssoc('SELECT * FROM mensagens WHERE id = ?', array($id));

	if (!$mensagem) {

		$error = array('message' => 'The ID was not found.');

        return $app->json($error, 404);
	}

	return $app->json($mensagem);
});
$app->run();