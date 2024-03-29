<?php

/**
 * This file is part of the Propel package - modified by Spryker Systems GmbH.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with the source code of the extended class.
 *
 * @license MIT License
 * @see https://github.com/propelorm/Propel2
 */

namespace Spryker\Zed\Transfer\Business\Model\Generator\Helper;

/**
 * The generic interface to create a plural form of a name.
 *
 * @author Hans Lellelid <hans@xmpl.org>
 */
interface PluralizerInterface
{
    /**
     * Generate a plural name based on the passed in root.
     *
     * @param string $root The root that needs to be pluralized (e.g. Author)
     *
     * @return string The plural form of $root.
     */
    public function getPluralForm($root): string;
}
