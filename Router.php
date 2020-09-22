<?php 

class Router
{
    private $request;
    private $supportedHttpMethods = ["GET", "POST"];

    public function __construct(IRequest $iRequest)
    {
        $this->request = $iRequest;
    }

    public function __call($name, $args)
    {
        list($route, $function) = $args;

        if (!in_array(strtoupper($name), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }

        $this->{strtolower($name)}[$this->formatRoute($route)] = $function;
    }

    private function formatRoute($route)
    {
        $result = rtrim($route, '/');
        if ($result === '') {
            return '/';
        }

        return $route;
    }

    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    function resolve()
    {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $formatedRoute = $this->formatRoute($this->request->requestUri);
        $method = $methodDictionary[$formatedRoute];

        if(is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

        echo call_user_func_array($method, array($this->request));
    }

    function __destruct()
    {
        $this->resolve();
    }
}