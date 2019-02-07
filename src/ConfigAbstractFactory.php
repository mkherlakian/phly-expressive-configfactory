<?php
/**
 * @see       https://github.com/phly/phly-expressive-configfactory for the canonical source repository
 * @copyright Copyright (c) Matthew Weier O'Phinney (https://mwop.net)
 * @license   https://github.com/phly/phly-expresive-configfactory/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Phly\Expressive;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class ConfigAbstractFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName) : bool
    {
        return (bool) preg_match('/^config-/i', $requestedName);
    }

    /**
     * @return array|\ArrayObject
     * @throws InvalidServiceNameException if $serviceName does not begin with "config-"
     * @throws ConfigKeyNotFoundException if $returnArrayForUnfoundKey is false and the key is not found
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->getRequestedConfig($container, $requestedName);
    }
}
