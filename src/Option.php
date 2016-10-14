<?php

namespace macrominds\laravel\choice;

class Option
{
    protected $title;
    protected $primary;
    protected $method;
    protected $parameters;
    protected $url;

    protected function __construct($title, $url, $method, $parameters = [], $isPrimary = false)
    {
        $this->title = $title;
        $this->url = $url;
        $this->method = $method;
        $this->parameters = $parameters;
        $this->primary = $isPrimary;
    }
    public static function make($title, $url, $method, $parameters = [], $isPrimary = false)
    {
        return new static($title, $url, $method, $parameters, $isPrimary);
    }
    public static function makeCancel($title, $isPrimary = false)
    {
        return new static($title, url()->previous(), 'GET', [], $isPrimary);
    }

    protected function getNativeMethod()
    {
        switch ($this->method) {
            case 'DELETE':
            case 'PATCH':
            case 'PUT':
                return 'POST';
            default:
                return $this->method;
        }
    }
    /**
     * @param $name
     * @return string
     */
    protected function renderView($name)
    {
        return view($name, [
            'title' => $this->title,
            'url' => $this->url,
            'nativeMethod' => $this->getNativeMethod(),
            'method' => $this->method,
            'parameters' => $this->parameters,
            'isPrimary' => $this->primary,
        ])->render();
    }

    public function __toString()
    {
        return $this->renderView($this->getNativeMethod() === 'GET' ? 'choice::option-link' : 'choice::option-form');
    }
}
