<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use Router\Route;

class RouteTest extends TestCase{

  /**
   * @dataProvider providerForTestPattern
   * @covers Router\Route::__construct
   * @covers Router\Route::clearPattern
   * @covers Router\Route::getPattern
   * @covers Router\Route::getName
   * @covers Router\Route::getArgs
   */
  public function testPattern($pattern, $expected, $args){
    $route = new Route('user', $pattern, 'Controllers\User', 'user', $args);
    $this->assertEquals($expected, $route->getPattern());
    $this->assertEquals('user', $route->getName());
    $this->assertEquals($args, $route->getArgs());
  }

  /**
   * @dataProvider providerForTestCall
   * @covers Router\Route::call
   */
  public function testcall($route, $expected, $args){
    $this->assertEquals($expected, $route->call($args));
  }

  public function call($args = array()){
    return implode(', ', $args);
  }

  public function providerForTestPattern(){
    return array(
      array('/user/{$user}', '/^\/user\/(.*)\/?$/', array('int')),
      array('/user/{$userSource}/{$userCible}', '/^\/user\/(.*)\/(.*)\/?$/', array('int', 'int')),
    );
  }

  public function providerForTestCall(){
    return array(
      array(new Route('Route 1', '/route1', 'Tests\RouteTest', 'call'), '', array()),
      array(new Route('Route 2', '/route2', 'Tests\RouteTest', 'call'), 'Hello, World', array(array('Hello', 'World'))),
    );
  }
}
