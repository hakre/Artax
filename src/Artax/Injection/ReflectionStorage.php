<?php
/**
 * ReflectionStorage Interface File
 * 
 * @category    Artax
 * @package     Injection
 * @author      Daniel Lowrey <rdlowrey@gmail.com>
 * @license     All code subject to the terms of the LICENSE file in the project root
 * @version     ${project.version}
 */
namespace Artax\Injection;

use ReflectionParameter;

/**
 * Defines an interface for caching/pooling reflection objects
 * 
 * @category    Artax
 * @package     Injection
 * @author      Daniel Lowrey <rdlowrey@gmail.com>
 */
interface ReflectionStorage {
    
    /**
     * Retrieves and caches the ReflectionClass objects
     * 
     * @param string $className The class we want to reflect
     */
    function getClass($className);
    
    /**
     * Retrieves and caches the class's constructor ReflectionMethod
     * 
     * @param string $className The class whose constructor we want to reflect
     */
    function getConstructor($className);
    
    /**
     * Retrieves and caches constructor parameters for the given class name
     * 
     * @param string $className The name of the class whose constructor 
     *                          parameters we'd like to retrieve
     */
    function getConstructorParameters($className);
    
    /**
     * Retrieves the class typehint from a given ReflectionParameter
     * 
     * There is no way to directly access a parameter's typehint without
     * instantiating a new ReflectionClass instance and calling its getName()
     * method. This method stores the results of this approach so that if
     * the same parameter typehint or ReflectionClass is needed again we
     * already have it cached.
     * 
     * @param ReflectionParameter $reflParam a ReflectionParameter object
     */
    function getTypehint(ReflectionParameter $reflParam);
}
