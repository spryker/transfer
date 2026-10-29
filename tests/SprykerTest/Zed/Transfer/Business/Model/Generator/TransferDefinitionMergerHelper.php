<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\Transfer\Business\Model\Generator;

class TransferDefinitionMergerHelper
{
    public function getTransferDefinition1(): array
    {
        return [
            'name' => 'Transfer',
            'entity-namespace' => null,
            'property' => [
                [
                    'name' => 'propertyA',
                    'type' => 'string',
                    'bundles' => [
                        'Bundle1',
                    ],
                    'dataBuilderRule' => 'shuffle(array("test"))',
                ],
            ],
        ];
    }

    public function getTransferDefinition2(): array
    {
        return [
            'name' => 'Transfer',
            'entity-namespace' => null,
            'property' => [
                [
                    'name' => 'propertyA',
                    'type' => 'string',
                    'bundles' => [
                        'Bundle2',
                    ],
                    'dataBuilderRule' => 'shuffle(array("test"))',
                ],
                [
                    'name' => 'propertyB',
                    'type' => 'int',
                    'bundles' => [
                        'Bundle2',
                    ],
                ],
            ],
        ];
    }

    public function getExpectedTransfer(): array
    {
        return [
            'name' => 'Transfer',
            'entity-namespace' => null,
            'deprecated' => null,
            'property' => [
                'propertyA' => [
                    'name' => 'propertyA',
                    'type' => 'string',
                    'bundles' => [
                        'Bundle1',
                        'Bundle2',
                    ],
                    'dataBuilderRule' => 'shuffle(array("test"))',
                ],
                'propertyB' => [
                    'name' => 'propertyB',
                    'type' => 'int',
                    'bundles' => [
                        'Bundle2',
                    ],
                ],
            ],
        ];
    }

    public function getItemMetadataTransfer(): array
    {
        return [
            'name' => 'ItemMetadataTransfer',
            'entity-namespace' => null,
            'property' => [
                [
                    'name' => 'propertyA',
                    'type' => 'string',
                    'bundles' => [
                        'Bundle1',
                    ],
                ],
                [
                    'name' => 'propertyB',
                    'type' => 'int',
                    'bundles' => [
                        'Bundle1',
                    ],
                ],
            ],
        ];
    }

    public function getItemMetadata(): array
    {
        return [
            'name' => 'ItemMetadata',
            'entity-namespace' => null,
            'property' => [
                [
                    'name' => 'propertyC',
                    'type' => 'string',
                    'bundles' => [
                        'Bundle2',
                    ],
                ],
                [
                    'name' => 'propertyD',
                    'type' => 'array',
                    'bundles' => [
                        'Bundle2',
                    ],
                ],
            ],
        ];
    }

    public function getExpectedMergedItemMetadataTransfer(): array
    {
        return [
            'name' => 'ItemMetadataTransfer',
            'entity-namespace' => null,
            'deprecated' => null,
            'property' => [
                'propertyA' => [
                    'name' => 'propertyA',
                    'type' => 'string',
                    'bundles' => [
                        'Bundle1',
                    ],
                ],
                'propertyB' => [
                    'name' => 'propertyB',
                    'type' => 'int',
                    'bundles' => [
                        'Bundle1',
                    ],
                ],
                'propertyC' => [
                    'name' => 'propertyC',
                    'type' => 'string',
                    'bundles' => [
                        'Bundle2',
                    ],
                ],
                'propertyD' => [
                    'name' => 'propertyD',
                    'type' => 'array',
                    'bundles' => [
                        'Bundle2',
                    ],
                ],
            ],
        ];
    }

    public function getTransferDefinitionWithStrictMode(): array
    {
        return [
            'name' => 'OrderCollection',
            'entity-namespace' => null,
            'strict' => true,
            'property' => [
                [
                    'name' => 'orders',
                    'type' => 'Order[]',
                    'singular' => 'order',
                    'bundles' => [
                        'Sales',
                    ],
                ],
            ],
        ];
    }

    public function getTransferDefinitionWithoutStrictMode(): array
    {
        return [
            'name' => 'OrderCollection',
            'entity-namespace' => null,
            'property' => [
                [
                    'name' => 'orders',
                    'type' => 'Order[]',
                    'singular' => 'order',
                    'bundles' => [
                        'Payone',
                    ],
                ],
            ],
        ];
    }

    public function getOrderTransferDefinitionFromSalesModule(): array
    {
        return [
            'name' => 'Order',
            'entity-namespace' => null,
            'property' => [
                [
                    'name' => 'idSalesOrder',
                    'type' => 'int',
                    'bundles' => [
                        'Sales',
                    ],
                ],
                [
                    'name' => 'items',
                    'type' => 'Item[]',
                    'singular' => 'item',
                    'bundles' => [
                        'Sales',
                    ],
                ],
            ],
        ];
    }

    public function getOrderTransferDefinitionFromCheckoutModuleWithStrictMode(): array
    {
        return [
            'name' => 'Order',
            'entity-namespace' => null,
            'strict' => true,
            'property' => [
                [
                    'name' => 'items',
                    'type' => 'Item[]',
                    'singular' => 'item',
                    'strict' => true,
                    'bundles' => [
                        'Checkout',
                    ],
                ],
                [
                    'name' => 'checkoutData',
                    'type' => 'CheckoutData',
                    'strict' => true,
                    'bundles' => [
                        'Checkout',
                    ],
                ],
            ],
        ];
    }

    public function getTransferDefinitionWithStrictProperty(): array
    {
        return [
            'name' => 'Transfer',
            'entity-namespace' => null,
            'property' => [
                [
                    'name' => 'propertyA',
                    'type' => 'string',
                    'strict' => true,
                    'bundles' => [
                        'Bundle1',
                    ],
                ],
            ],
        ];
    }

    public function getTransferDefinitionWithoutStrictProperty(): array
    {
        return [
            'name' => 'Transfer',
            'entity-namespace' => null,
            'property' => [
                [
                    'name' => 'propertyA',
                    'type' => 'string',
                    'bundles' => [
                        'Bundle2',
                    ],
                ],
            ],
        ];
    }

    public function getExpectedMergedItemMetadata(): array
    {
        return [
            'name' => 'ItemMetadata',
            'entity-namespace' => null,
            'deprecated' => null,
            'property' => [
                'propertyA' => [
                    'name' => 'propertyA',
                    'type' => 'string',
                    'bundles' => [
                        'Bundle1',
                    ],
                ],
                'propertyB' => [
                    'name' => 'propertyB',
                    'type' => 'int',
                    'bundles' => [
                        'Bundle1',
                    ],
                ],
                'propertyC' => [
                    'name' => 'propertyC',
                    'type' => 'string',
                    'bundles' => [
                        'Bundle2',
                    ],
                ],
                'propertyD' => [
                    'name' => 'propertyD',
                    'type' => 'array',
                    'bundles' => [
                        'Bundle2',
                    ],
                ],
            ],
        ];
    }
}
