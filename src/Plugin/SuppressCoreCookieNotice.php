<?php

/**
 * Copyright © Elgentos. All rights reserved.
 * https://elgentos.nl
 */

declare(strict_types=1);

namespace Elgentos\ConsentModeV2\Plugin;

use Elgentos\ConsentModeV2\Api\ConfigurationInterface;
use Magento\Cookie\Block\Html\Notices;

class SuppressCoreCookieNotice
{
    private const CORE_NOTICE_BLOCK_NAME = 'cookie_notices';

    public function __construct(
        private ConfigurationInterface $config,
    ) {
    }

    public function aroundToHtml(Notices $subject, callable $proceed): string
    {
        if ($subject->getNameInLayout() === self::CORE_NOTICE_BLOCK_NAME && $this->config->isEnabled()) {
            return '';
        }

        return $proceed();
    }
}
