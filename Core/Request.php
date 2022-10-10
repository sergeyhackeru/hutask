<?php

namespace Core;

class Request
{
    private $queryParams;
    private $parsedBody;
    private $requestMethod;
    private $requestQueryString;

    public function __construct(array $queryParams = [], $parsedBody = null, $requestMethod = null, $requestQueryString = null)
    {
        $this->queryParams = $queryParams;
        $this->parsedBody = $parsedBody;
        $this->requestMethod = $requestMethod;
        $this->requestQueryString = $requestQueryString;
    }

    public function test(){
        echo ('Request ELISD');
      }
  

    //getters
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getParsedBody()
    {
        return $this->parsedBody;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function getRequestQueryString()
    {
        return $this->requestQueryString;
    }

    //mutators immutable
    public function withQueryParams(array $query): self
    {
        $new = clone $this;
        $new->queryParams = $query;
        return $new;
    }

    public function withParsedBody($data): self
    {
        $new = clone $this;
        $new->parsedBody = $data;
        return $new;
    }

    public function withRequestMethod($data): self
    {
        $new = clone $this;
        $new->requestMethod = $data;
        return $new;
    }

    public function withRequestQueryString($data): self
    {
        $new = clone $this;
        $new->requestQueryString = $data;
        return $new;
    }

    public function testRequestGlobals()
    {
        echo 'query params: ' . var_dump ( $this->queryParams);
        echo '<br>';
        echo 'parsed body: ' . var_dump ($this->parsedBody);
        echo '<br>';
        echo 'request method: ' . $this->requestMethod;
        echo '<br>';
        echo 'query string :' . $this->requestQueryString;
    }


}
