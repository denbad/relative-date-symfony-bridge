<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge\Tests\Middleware;

use Denbad\RelativeDateSymfonyBridge\Middleware\TranslatorAdapter;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Translation\TranslatorInterface;

final class TranslatorAdapterTest extends \PHPUnit\Framework\TestCase
{
    public function testTrans(): void
    {
        /** @var TranslatorInterface $translator */

        $id = 'today';
        $parameters = [];
        $locale = 'locale';
        $result = 'сегодня';

        $translator = $this->getTranslator();
        $translator
            ->expects($this->once())
            ->method('trans')
            ->with($id, $parameters, TranslatorAdapter::TRANSLATION_DOMAIN, $locale)
            ->willReturn($result)
        ;

        $middleware = new TranslatorAdapter($translator);
        $this->assertEquals($result, $middleware->trans($id, $parameters, $locale));
    }

    private function getTranslator(): MockObject
    {
        return $this->getMockForAbstractClass(TranslatorInterface::class);
    }
}