<?php

use Artax\Framework\Http\ObservableResponse;

class ObservableResponseTest extends PHPUnit_Framework_TestCase {
    
    /**
     * @covers Artax\Framework\Http\ObservableResponse::__construct
     * @covers Artax\Framework\Http\ObservableResponse::notify
     */
    public function testConstructorNotifiesListeners() {
        $mediator = $this->getMock('Artax\\Events\\Mediator');
        
        $mediator->expects($this->once())
                 ->method('notify')
                 ->with('__sys.response.new');
        
        $response = new ObservableResponse($mediator);
    }
    
    /**
     * @covers Artax\Framework\Http\ObservableResponse::setHttpVersion
     * @covers Artax\Framework\Http\ObservableResponse::notify
     */
    public function testHttpVersionSetterNotifiesListeners() {
        $mediator = $this->getMock('Artax\\Events\\Mediator');
        
        $response = new ObservableResponse($mediator);
        
        $mediator->expects($this->once())
                 ->method('notify')
                 ->with('__sys.response.setHttpVersion');
        
        $response->setHttpVersion('1.1');
    }
    
    /**
     * @covers Artax\Framework\Http\ObservableResponse::setStatusCode
     * @covers Artax\Framework\Http\ObservableResponse::notify
     */
    public function testStatusCodeSetterNotifiesListeners() {
        $mediator = $this->getMock('Artax\\Events\\Mediator');
        
        $response = new ObservableResponse($mediator);
        
        $mediator->expects($this->once())
                 ->method('notify')
                 ->with('__sys.response.setStatusCode');
        
        $response->setStatusCode(200);
    }
    
    /**
     * @covers Artax\Framework\Http\ObservableResponse::setStatusDescription
     * @covers Artax\Framework\Http\ObservableResponse::notify
     */
    public function testStatusDescriptionSetterNotifiesListeners() {
        $mediator = $this->getMock('Artax\\Events\\Mediator');
        
        $response = new ObservableResponse($mediator);
        
        $mediator->expects($this->once())
                 ->method('notify')
                 ->with('__sys.response.setStatusDescription');
        
        $response->setStatusDescription('OK');
    }
    
    /**
     * @covers Artax\Framework\Http\ObservableResponse::setHeader
     * @covers Artax\Framework\Http\ObservableResponse::notify
     */
    public function testHeaderSetterNotifiesListeners() {
        $mediator = $this->getMock('Artax\\Events\\Mediator');
        
        $response = new ObservableResponse($mediator);
        
        $mediator->expects($this->once())
                 ->method('notify')
                 ->with('__sys.response.setHeader');
        
        $response->setHeader('Content-Type', 'text/html');
    }
    
    /**
     * @covers Artax\Framework\Http\ObservableResponse::setBody
     * @covers Artax\Framework\Http\ObservableResponse::notify
     */
    public function testBodySetterNotifiesListeners() {
        $mediator = $this->getMock('Artax\\Events\\Mediator');
        
        $response = new ObservableResponse($mediator);
        
        $mediator->expects($this->once())
                 ->method('notify')
                 ->with('__sys.response.setBody');
        
        $response->setBody('Body text');
    }
    
    /**
     * @covers Artax\Framework\Http\ObservableResponse::removeHeader
     * @covers Artax\Framework\Http\ObservableResponse::notify
     */
    public function testRemoveHeaderNotifiesListeners() {
        $mediator = $this->getMock('Artax\\Events\\Mediator');
        
        $response = new ObservableResponse($mediator);
        
        $response->setHeader('Content-Type', 'text/html');
        
        $mediator->expects($this->once())
                 ->method('notify')
                 ->with('__sys.response.removeHeader');
        
        $response->removeHeader('Content-Type');
        $this->assertFalse($response->hasHeader('Content-Type'));
    }
    
    /**
     * @covers Artax\Framework\Http\ObservableResponse::send
     * @covers Artax\Framework\Http\ObservableResponse::notify
     * @runInSeparateProcess
     */
    public function testSendNotifiesListenersBeforeAndAfterOutput() {
        $mediator = $this->getMock('Artax\\Events\\Mediator');
        $response = new ObservableResponse($mediator);
        $response->setStatusCode(200);
        
        $mediator->expects($this->exactly(2))
                 ->method('notify')
                 ->with($this->logicalOr('__sys.response.beforeSend', '__sys.response.afterSend'));
        
        $response->send();
    }
}
