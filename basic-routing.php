<?php declare(strict_types=1) ?>

<!DOCTYPE html>
<head><title>Basic routing</title></head>
<body>
    <h1>Basic routing</h1>
    
    <?php
        // in order to work, this file needs to be in the server root; 
        // not to be used in production; assumed that all requests are 'GET'

        class Router{

            protected array $routes;

            public function register(string $route, callable | array $action): self{ // union types require php8
                $this->routes[$route] = $action; // array destructuring              
                return $this;
            }

            public function resolve(string $requestUri){                
                $route = explode('?', $requestUri)[0];
                $action = $this->routes[$route] ?? null;
                
                if(!$action){                
                    throw new RouteNotFoundException();
                }

                if(is_callable($action)){
                    return call_user_func($action);
                }

                if(is_array($action)){
                    [$class, $method] = $action;

                    if(class_exists($class)){
                        $class = new $class;

                        if(method_exists($class, $method)){
                            return call_user_func_array([$class, $method], []); // 2nd parameter can accept a number of arguments
                        }
                    }
                }
                throw new RouteNotFoundException();               
            }
        }

        class Home{
            public function index(){
                return 'Home';
            }
        }

        class Invoice{
            public function index(){
                return 'Invoice';
            }

            public function create(){
                return 'Create invoice';
            }
        }

        class RouteNotFoundException extends Exception{
            protected $message = 'Route not found!';
        }

        $router = new Router();
        // inefficient way of routing
        // $router->register('/home', function(){ echo "Home"; });
        // $router->register('/invoices', function(){ echo "Invoices"; });
        
        // efficient way of routing...similarly used by e.g. laravel
        $router
        ->register('/', [Home::class, 'index'])
        ->register('/invoices', [Invoice::class, 'index'])
        ->register('/invoices/create', [Invoice::class, 'create']);
        
        echo $router->resolve($_SERVER['REQUEST_URI']);

        
    ?>
</body>
</html>