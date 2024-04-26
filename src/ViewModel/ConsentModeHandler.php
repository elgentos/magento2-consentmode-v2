<?php

/**
 * Copyright © Elgentos. All rights reserved.
 * https://elgentos.nl
 */

declare(strict_types=1);

namespace Elgentos\ConsentModeV2\ViewModel;

use Elgentos\ConsentModeV2\Api\ConfigurationInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ConsentModeHandler implements ArgumentInterface
{
    public function __construct(
        private readonly ConfigurationInterface $configuration
    ) {
    }

    public function shouldIncludeScript(): bool
    {
        return $this->configuration->isEnabled();
    }

    public function isUrlPassThroughEnabled(): bool
    {
        return $this->configuration->isUrlPassthroughEnabled();
    }
}
