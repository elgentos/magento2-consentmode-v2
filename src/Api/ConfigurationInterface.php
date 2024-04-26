<?php

/**
 * Copyright © Elgentos. All rights reserved.
 * https://elgentos.nl
 */

declare(strict_types=1);

namespace Elgentos\ConsentModeV2\Api;

interface ConfigurationInterface
{
    public const CONFIG_CONSENTMODE_ENALBED = 'elgentos_consentmodev2/general/enabled',
        CONFIG_URL_PASSTHROUGH_ENALBED = 'elgentos_consentmodev2/general/url_passthrough';

    public function isEnabled(int $storeId = null): bool;

    public function isUrlPassThroughEnabled(int $storeId = null): bool;
}
