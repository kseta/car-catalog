<?php
namespace MyVendor\MyProject\Resource\App;

use BEAR\Resource\ResourceObject;

class Index extends ResourceObject
{
    public $body = [
        'message' => 'Welcome!',
        '_links' => [
            'self' => [
                'href' => '/',
            ],
            'curies' => [
                'href' => 'http://localhost:8081/rels/{?rel}',
                'name' => 'pt',
                'templated' => true,
            ],
            'pt:weekday' => [
                'href' => '/weekday',
                'title' => 'todo item',
                'templated' => true,
            ],
        ],
    ];

    public function onGet()
    {
        return $this;
    }
}
