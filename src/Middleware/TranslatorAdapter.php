<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge\Middleware;

use Denbad\RelativeDate\Middleware\Translator;
use Symfony\Component\Translation\TranslatorInterface;

final class TranslatorAdapter implements Translator
{
    public const TRANSLATION_DOMAIN = 'denbadRelativeDate';

    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function trans(string $id, array $parameters = [], string $locale = null): string
    {
        return $this->translator->trans($id, $parameters, self::TRANSLATION_DOMAIN, $locale);
    }
}