<?php

/**
 * Copyright © Elgentos. All rights reserved.
 * https://elgentos.nl
 */

declare(strict_types=1);

namespace Elgentos\ConsentModeV2\Model;

use Elgentos\ConsentModeV2\Api\ConfigurationInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Config implements ConfigurationInterface
{
    /**
     * @param ScopeConfigInterface $config
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        private ScopeConfigInterface $config,
        private StoreManagerInterface $storeManager,
    ) {
    }

    public function isEnabled(int $storeId = null): bool
    {
        return (bool)$this->config->getValue(
            self::CONFIG_CONSENTMODE_ENALBED,
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId($storeId)
        );
    }

    public function isUrlPassThroughEnabled(int $storeId = null): bool
    {
        return (bool)$this->config->getValue(
            self::CONFIG_URL_PASSTHROUGH_ENALBED,
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId($storeId)
        );
    }

    public function getStoreId(int $storeId = null): int
    {
        return (int)$this->storeManager
            ->getStore($storeId)
            ->getId();
    }
}
