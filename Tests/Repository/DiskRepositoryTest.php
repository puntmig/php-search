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
 */

declare(strict_types=1);

namespace Apisearch\Tests\Repository;

use Apisearch\Repository\DiskRepository;
use Apisearch\Repository\Repository;

/**
 * Class DiskRepositoryTest.
 */
class DiskRepositoryTest extends RepositoryTest
{
    /**
     * Get repository intance.
     *
     * @return Repository
     */
    protected function getRepository(): Repository
    {
        return new DiskRepository(tempnam(sys_get_temp_dir(), 'apisearch'));
    }
}
