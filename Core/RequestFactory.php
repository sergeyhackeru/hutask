<?php

namespace Core;
class RequestFactory
{
    public static function fromGlobals(array $query = null, array $body = null, $requestMethod = null, $requestQueryString = null): Request
    {
        return (new Request())
            ->withQueryParams($query ?: $_GET)
            ->withParsedBody($body ?: $_POST)
            ->withRequestMethod($requestMethod ?: $_SERVER['REQUEST_METHOD'])
            ->withRequestQueryString($requestQueryString ?: $_SERVER['QUERY_STRING']);
    }
}