<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use Router\RouteHandler;
use Router\Route;

class RouteHandlerTest extends TestCase{

  /**
   * @dataProvider providerForFindByNameOk
   * @covers Router\RouteHandler::__construct
   * @covers Router\RouteHandler::addRoute
   * @covers Router\RouteHandler::findRouteByName
   */
  public function testFindByNameOk($routes, $name, $expected){
    $handler = new RouteHandler();
    foreach($routes as $route){
      $handler->addRoute($route);
    }
    $this->assertEquals($expected, $handler->findRouteByName($name));
  }


  /**
   * @dataProvider providerForFindByNameFail
   * @covers Router\RouteHandler::__construct
   * @covers Router\RouteHandler::addRoute
   * @covers Router\RouteHandler::findRouteByName
   */
  public function testFindByNameFail($routes, $name){
    $handler = new RouteHandler();
    foreach($routes as $route){
      $handler->addRoute($route);
    }
    try{
      $handler->findRouteByName($name);
    }catch(\Exception $e){
      $this->assertInstanceOf(\Exception::class, $e);
    }
  }

  /**
   * @dataProvider providerForFindByPatternOk
   * @covers Router\RouteHandler::__construct
   * @covers Router\RouteHandler::addRoute
   * @covers Router\RouteHandler::findRouteByPattern
   */
  public function testFindByPatternOk($routes, $pattern, $expected){
    $handler = new RouteHandler();
    foreach($routes as $route){
      $handler->addRoute($route);
    }
    $this->assertEquals($expected, $handler->findRouteByPattern($pattern));
  }


  /**
   * @dataProvider providerForFindByPatternFail
   * @covers Router\RouteHandler::__construct
   * @covers Router\RouteHandler::addRoute
   * @covers Router\RouteHandler::findRouteByPattern
   */
  public function testFindByPatternFail($routes, $pattern){
    $handler = new RouteHandler();
    foreach($routes as $route){
      $handler->addRoute($route);
    }
    try{
      $handler->findRouteByPattern($pattern);
    }catch(\Exception $e){
      $this->assertInstanceOf(\Exception::class, $e);
    }
  }


  public function providerForFindByNameOk(){
    $route1 = new Route('Route 1', '/route1', 'Tests\RouteTest', 'call');
    $route2 = new Route('Route 2', '/route2', 'Tests\RouteTest', 'call');
    $route3 = new Route('Route 3', '/route3', 'Tests\RouteTest', 'call');
    return array(
      array(array($route1, $route2, $route3), 'Route 2', $route2)
    );
  }


  public function providerForFindByNameFail(){
    $route1 = new Route('Route 1', '/route1', 'Tests\RouteTest', 'call');
    $route2 = new Route('Route 2', '/route2', 'Tests\RouteTest', 'call');
    $route3 = new Route('Route 3', '/route3', 'Tests\RouteTest', 'call');
    return array(
      array(array($route1, $route2, $route3), 'Route', $route2)
    );
  }


  public function providerForFindByPatternOk(){
    $route1 = new Route('Route 1', '/toto/{$test}', 'Tests\RouteTest', 'call');
    $route2 = new Route('Route 2', '/user/{$user}', 'Tests\RouteTest', 'call');
    $route3 = new Route('Route 3', '/tata/{$tata}', 'Tests\RouteTest', 'call');
    return array(
      array(array($route1, $route2, $route3), '/user/3', $route2)
    );
  }


  public function providerForFindByPatternFail(){
    $route1 = new Route('Route 1', '/toto/{$test}', 'Tests\RouteTest', 'call');
    $route2 = new Route('Route 2', '/user/{$user}', 'Tests\RouteTest', 'call');
    $route3 = new Route('Route 3', '/tata/{$tata}', 'Tests\RouteTest', 'call');
    return array(
      array(array($route1, $route2, $route3), '/user', $route2)
    );
  }
}
