<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Transfer\Business\Model\Generator;

use RuntimeException;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class DataBuilderClassGenerator implements GeneratorInterface
{
    /**
     * @var string
     */
    public const TWIG_TEMPLATES_LOCATION = '/../../../../../../../templates/generator/';

    /**
     * @var string
     */
    protected string $targetDirectory;

    /**
     * @var \Twig\Environment
     */
    protected Environment $twig;

    /**
     * @param string $targetDirectory
     *
     * @throws \RuntimeException
     */
    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;

        $path = realpath(__DIR__ . DIRECTORY_SEPARATOR . static::TWIG_TEMPLATES_LOCATION);
        if (!$path) {
            throw new RuntimeException(sprintf('Cannot find templates path `%s`', __DIR__ . DIRECTORY_SEPARATOR . static::TWIG_TEMPLATES_LOCATION));
        }
        $loader = new FilesystemLoader($path);
        $this->twig = new Environment($loader, []);
    }

    /**
     * @param \Spryker\Zed\Transfer\Business\Model\Generator\DataBuilderDefinitionInterface $definition
     *
     * @return string
     */
    public function generate(DefinitionInterface $definition): string
    {
        $twigData = $this->getTwigData($definition);
        $fileName = $definition->getName() . '.php';
        $fileContent = $this->twig->render('builder.php.twig', $twigData);

        if (!is_dir($this->targetDirectory)) {
            mkdir($this->targetDirectory, 0775, true);
        }

        file_put_contents($this->targetDirectory . $fileName, $fileContent);

        return $fileName;
    }

    /**
     * @param \Spryker\Zed\Transfer\Business\Model\Generator\DataBuilderDefinitionInterface $dataBuilderDefinition
     *
     * @return array
     */
    public function getTwigData(DataBuilderDefinitionInterface $dataBuilderDefinition): array
    {
        return [
            'className' => $dataBuilderDefinition->getName(),
            'transferName' => $dataBuilderDefinition->getTransferName(),
            'rules' => $dataBuilderDefinition->getRules(),
            'dependencies' => $dataBuilderDefinition->getDependencies(),
        ];
    }
}
