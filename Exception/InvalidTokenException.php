<?php

/*
 * This file is part of the Apisearch PHP Client.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author PuntMig Technologies
 */

declare(strict_types=1);

namespace Apisearch\Exception;

use RuntimeException;

/**
 * Class InvalidTokenException.
 */
class InvalidTokenException extends RuntimeException
{
    /**
     * Get http error code.
     *
     * @return int
     */
    public function getTransportableHTTPError(): int
    {
        return 401;
    }

    /**
     * Throw an invalid key exception.
     *
     * @return InvalidTokenException
     */
    public static function create(): self
    {
        return new self('Token is not valid');
    }
}