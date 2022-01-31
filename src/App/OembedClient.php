<?php

namespace Src\App;

use Embed\Embed;
use Embed\Http\CurlDispatcher;

class OembedClient {

    public static $adapterData = [
        'title',
        'description',
        'url',
        'type',
        'tags',
        'image',
        'imageWidth',
        'imageHeight',
        'images',
        'code',
        'feeds',
        'width',
        'height',
        'aspectRatio',
        'authorName',
        'authorUrl',
        'providerIcon',
        'providerIcons',
        'providerName',
        'providerUrl',
        'publishedTime',
        'license',
    ];

    public function __invoke($url)
    {
        $dispatcher = new CurlDispatcher();
        $info = Embed::create($url, null, $dispatcher);
        return $info;
    }

}