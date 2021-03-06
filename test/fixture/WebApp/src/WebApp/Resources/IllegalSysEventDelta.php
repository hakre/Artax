<?php

namespace WebApp\Resources;

use Artax\Http\StdRequest,
    Artax\Framework\Http\ObservableResponse,
    Artax\Events\Mediator,
    Artax\Framework\Events\SystemEventDeltaException;


class IllegalSysEventDelta {
    
    private $request;
    private $response;
    private $mediator;
    
    public function __construct(StdRequest $request, ObservableResponse $response, Mediator $mediator) {
        $this->request = $request;
        $this->response = $response;
        $this->mediator = $mediator;
    }
    
    public function get() {
        try {
            $this->mediator->push('__sys.exception', function(){});
        } catch (SystemEventDeltaException $e) {
            $this->response->setStatusCode(500);
            $this->response->setStatusDescription('Internal Server Error');
            $this->response->setBody('illegal sysevent delta');
            
            $this->response->send();
        }
    }

}
