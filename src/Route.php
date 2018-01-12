<?php

namespace Router;

class Route{
  private $name;
  private $pattern;
  private $controller;
  private $method;
  private $args;

  public function __construct(string $name, string $pattern, string $controller, string $method, array $args = array()){
    $this->name       = $name;
    $this->pattern    = $this->clearPattern($pattern);
    $this->controller = $controller;
    $this->method     = $method;
    $this->args       = $args;
  }

  /**
   * [clearPattern description]
   * @param  [type] $pattern [description]
   * @return [type]          [description]
   */
  private function clearPattern($pattern){
    $str = trim($pattern, '/');
    $str = preg_replace('/{.*}/U', '(.*)', $str);
    $str = str_replace('/', '\/', $str);
    return "/^\/$str\/?$/";
  }


  public function call(array $params){
    return call_user_func_array(array(new $this->controller, $this->method), $params);
  }

  /**
   * Get the value of Name
   *
   * @return string
   */
  public function getName():string{
    return $this->name;
  }

  /**
   * Get the value of Pattern
   *
   * @return string
   */
  public function getPattern():string{
    return $this->pattern;
  }

  /**
   * Get the value of Args
   *
   * @return array
   */
  public function getArgs():array{
    return $this->args;
  }

}
