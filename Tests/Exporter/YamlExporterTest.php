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

namespace Apisearch\Tests\Exporter;

use Apisearch\Exporter\Exporter;
use Apisearch\Exporter\YamlExporter;

/**
 * Class YamlExporterTest.
 */
class YamlExporterTest extends ExporterTest
{
    /**
     * Get exporter instance.
     *
     * @return Exporter
     */
    public function getExporterInstance(): Exporter
    {
        return new YamlExporter();
    }
}