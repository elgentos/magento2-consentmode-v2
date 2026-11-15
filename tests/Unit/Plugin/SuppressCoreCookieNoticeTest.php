<?php

declare(strict_types=1);

namespace Elgentos\ConsentModeV2\Tests\Unit\Plugin;

use Elgentos\ConsentModeV2\Api\ConfigurationInterface;
use Elgentos\ConsentModeV2\Plugin\SuppressCoreCookieNotice;
use Magento\Cookie\Block\Html\Notices;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class SuppressCoreCookieNoticeTest extends TestCase
{
    private ConfigurationInterface&Stub $config;

    private SuppressCoreCookieNotice $plugin;

    protected function setUp(): void
    {
        $this->config = $this->createStub(ConfigurationInterface::class);
        $this->plugin = new SuppressCoreCookieNotice($this->config);
    }

    public function testCoreNoticeIsSuppressedWhenModuleIsEnabled(): void
    {
        $this->config->method('isEnabled')->willReturn(true);

        $this->assertSame('', $this->plugin->aroundToHtml($this->subject('cookie_notices'), $this->proceed('core notice')));
    }

    public function testCoreNoticeIsRenderedWhenModuleIsDisabled(): void
    {
        $this->config->method('isEnabled')->willReturn(false);

        $this->assertSame(
            'core notice',
            $this->plugin->aroundToHtml($this->subject('cookie_notices'), $this->proceed('core notice'))
        );
    }

    public function testReplacementBannerIsRenderedWhenModuleIsEnabled(): void
    {
        $this->config->method('isEnabled')->willReturn(true);

        $this->assertSame(
            'module banner',
            $this->plugin->aroundToHtml(
                $this->subject('cookie_notices_content_mode_v2'),
                $this->proceed('module banner')
            )
        );
    }

    private function subject(string $nameInLayout): Notices&Stub
    {
        $subject = $this->createStub(Notices::class);
        $subject->method('getNameInLayout')->willReturn($nameInLayout);

        return $subject;
    }

    private function proceed(string $html): callable
    {
        return static fn (): string => $html;
    }
}
