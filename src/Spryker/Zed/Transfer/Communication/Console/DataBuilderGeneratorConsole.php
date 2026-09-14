<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Transfer\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Spryker\Zed\Transfer\Business\TransferFacadeInterface getFacade()
 * @method \Spryker\Zed\Transfer\Communication\TransferCommunicationFactory getFactory()
 */
class DataBuilderGeneratorConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'transfer:databuilder:generate';

    /**
     * @var string
     */
    public const COMMAND_DESCRIPTION = 'Generates data builders from databuilder XML definition files';

    protected function configure(): void
    {
        parent::configure();
        $this
            ->setName(static::COMMAND_NAME)
            ->setDescription(static::COMMAND_DESCRIPTION)
            ->setHelp('<info>' . static::COMMAND_NAME . ' -h</info>');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $facade = $this->getFacade();
        $messenger = $this->getMessenger();

        $facade->deleteGeneratedDataBuilderObjects();
        $facade->generateDataBuilders($messenger);

        return static::CODE_SUCCESS;
    }
}
