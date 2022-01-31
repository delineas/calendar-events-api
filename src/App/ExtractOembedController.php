<?php

namespace Src\App;

use Embed\Embed;
use Src\Core\Request;
use Src\Core\Container;
use Src\App\EventResource;
use Embed\Http\CurlDispatcher;

class ExtractOembedController
{
    public function __construct()
    {
        $this->response = Container::get('response');
    }

    public function extract($url)
    {
        if(!is_local()) {
            $url = str_replace('https:/', 'https://', $url);
            $url = str_replace('http:/', 'https://', $url);
        }
        
        if(!filter_var($url, FILTER_VALIDATE_URL)) {
            return $this->response->sendError('Invalid url', 400);
        }

        $info = (new OembedClient)($url);

        $adapterData = OembedClient::$adapterData;

        $data = [];
        foreach($adapterData as $name) {
            $data[$name] = $info->$name;
        }

        foreach ($info->getProviders() as $providerName => $provider) {
            $data[$providerName] = $provider->getBag()->getAll();
        }

        return is_null($info) 
            ? $this->response->sendError('not found', 404) 
            : $this->response->sendMessage(['data' => $data]);
    }

}
