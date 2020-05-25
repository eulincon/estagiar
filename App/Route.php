<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['autenticar2'] = array(
			'route' => '/autenticar2',
			'controller' => 'AuthController',
			'action' => 'autenticar2'
		);

		$routes['inscreverseAluno'] = array(
			'route' => '/inscreverseAluno',
			'controller' => 'indexController',
			'action' => 'inscreverseAluno'
		);

		$routes['registrar'] = array(
			'route' => '/registrarAluno',
			'controller' => 'indexController',
			'action' => 'registrarAluno'
		);

		$routes['timeline'] = array(
			'route' => '/timeline',
			'controller' => 'AppController',
			'action' => 'timeline'
		);

		$routes['curriculo'] = array(
			'route' => '/curriculo',
			'controller' => 'AppController',
			'action' => 'curriculo'
		);

		$routes['teste'] = array(
			'route' => '/teste',
			'controller' => 'IndexController',
			'action' => 'teste'
		);

		$routes['testeAuth'] = array(
			'route' => '/testeAuthAjax',
			'controller' => 'AuthController',
			'action' => 'testeAuthAjax'
		);

		$this->setRoutes($routes);
	}

}

?>