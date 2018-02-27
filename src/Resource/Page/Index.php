<?php
namespace KSeta\CarCatalog\Resource\Page;

use BEAR\Resource\Annotation\Embed;
use BEAR\Resource\ResourceObject;

class Index extends ResourceObject
{
    public function onGet() : ResourceObject
    {
        $this->body = [
            'greeting' => 'Hello BEAR.Sunday',
        ];

        return $this;
    }
}
