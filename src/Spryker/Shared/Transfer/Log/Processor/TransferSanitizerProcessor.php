<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Transfer\Log\Processor;

use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Shared\Log\Sanitizer\SanitizerInterface;

class TransferSanitizerProcessor
{
    /**
     * @var string
     */
    public const EXTRA = 'transfer';

    /**
     * @var string
     */
    public const CONTEXT_KEY = 'transfer';

    /**
     * @var string
     */
    public const RECORD_EXTRA = 'extra';

    /**
     * @var string
     */
    public const RECORD_CONTEXT = 'context';

    /**
     * @var \Spryker\Shared\Log\Sanitizer\SanitizerInterface
     */
    protected $sanitizer;

    public function __construct(SanitizerInterface $sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }

    /**
     * @param \Monolog\LogRecord|array<string, array> $record
     *
     * @return \Monolog\LogRecord|array<string, array>
     */
    public function __invoke($record)
    {
        $transfer = $this->findTransfer((array)$record[static::RECORD_CONTEXT]);
        if (!($transfer instanceof TransferInterface)) {
            return $record;
        }

        $contextData = $this->transferToArray($transfer);
        $contextData['class'] = get_class($transfer);
        $sanitizedData = $this->sanitizer->sanitize($contextData);

        if (is_array($record)) {
            unset($record[static::RECORD_CONTEXT][static::CONTEXT_KEY]);
            $record[static::RECORD_EXTRA][static::EXTRA] = $sanitizedData;

            return $record;
        }

        $record->extra[static::EXTRA] = $sanitizedData;

        return $record;
    }

    protected function transferToArray(TransferInterface $transfer): array
    {
        $transferArray = $transfer->toArray();

        foreach ($transferArray as $key => $value) {
            if (is_array($value) && (current($value) instanceof TransferInterface)) {
                foreach ($value as $position => $transfer) {
                    $value[$position] = $this->transferToArray($transfer);
                }
            }
        }

        return $transferArray;
    }

    protected function findTransfer(array $context): ?TransferInterface
    {
        if (!empty($context[static::CONTEXT_KEY])) {
            return $context[static::CONTEXT_KEY];
        }
        if (current($context) instanceof TransferInterface) {
            return current($context);
        }

        return null;
    }
}
