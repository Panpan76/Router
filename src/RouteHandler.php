<?php

namespace Router;

class RouteHandler{
  private $routes;

  public function __construct(){

  }

  public function addRoute(Route $route){
    $this->routes[$route->getPattern()] = $route;
  }

  public function findRouteByPattern(string $pattern){
    foreach($this->routes as $route){
      if(preg_match($route->getPattern(), $pattern)){
        return $route;
      }
    }
    throw new \Exception('Pas de route');
  }

  public function findRouteByName(string $name){
    foreach($this->routes as $route){
      if($route->getName() == $name){
        return $route;
      }
    }
    throw new \Exception('Pas de route');
  }
}
