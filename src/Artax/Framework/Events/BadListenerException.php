<?php
/**
 * BadListenerException class file
 * 
 * @category    Artax
 * @package     Framework
 * @subpackage  Events
 * @author      Daniel Lowrey <rdlowrey@gmail.com>
 * @license     All code subject to the terms of the LICENSE file in the project root
 * @version     ${project.version}
 */
namespace Artax\Framework\Events;

use RuntimeException;

/**
 * Exception thrown on lazy class listener instantiation or invocation failure
 * 
 * @category    Artax
 * @package     Framework
 * @subpackage  Events
 * @author      Daniel Lowrey <rdlowrey@gmail.com>
 */
class BadListenerException extends RuntimeException {}
