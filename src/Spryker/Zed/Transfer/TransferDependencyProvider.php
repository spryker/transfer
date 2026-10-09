<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Transfer;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Transfer\Dependency\Facade\TransferToPropelFacadeBridge;
use Spryker\Zed\Transfer\Dependency\Service\TransferToUtilGlobServiceBridge;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * @method \Spryker\Zed\Transfer\TransferConfig getConfig()
 */
class TransferDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_UTIL_GLOB = 'util glob service';

    public const string SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @var string
     */
    public const SYMFONY_FILE_SYSTEM = 'symfony_file_system';

    /**
     * @var string
     */
    public const SYMFONY_FINDER = 'symfony_finder';

    /**
     * @var string
     */
    public const FACADE_PROPEL = 'FACADE_PROPEL';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container->set(static::SYMFONY_FILE_SYSTEM, function () {
            return new Filesystem();
        });

        $container->set(static::SYMFONY_FINDER, function () {
            return new Finder();
        });

        $container = $this->addUtilGlobService($container);
        $container = $this->addUtilEncodingService($container);
        $container = $this->addPropelFacade($container);

        return $container;
    }

    protected function addPropelFacade(Container $container): Container
    {
        $container->set(static::FACADE_PROPEL, function (Container $container) {
            return new TransferToPropelFacadeBridge(
                $container->getLocator()->propel()->facade(),
            );
        });

        return $container;
    }

    protected function addUtilEncodingService(Container $container): Container
    {
        $container->set(static::SERVICE_UTIL_ENCODING, function (Container $container) {
            return $container->getLocator()->utilEncoding()->service();
        });

        return $container;
    }

    protected function addUtilGlobService(Container $container): Container
    {
        $container->set(static::SERVICE_UTIL_GLOB, function (Container $container) {
            return new TransferToUtilGlobServiceBridge(
                $container->getLocator()->utilGlob()->service(),
            );
        });

        return $container;
    }
}
