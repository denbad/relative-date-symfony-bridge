<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge\Middleware;

use Denbad\RelativeDate\Middleware\Translator;
use Symfony\Component\Translation\TranslatorInterface;

final class TranslatorAdapter implements Translator
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function trans(string $id, array $parameters = [], string $domain = null, string $locale = null): string
    {
        return $this->translator->trans($id, $parameters, $domain, $locale);
    }
}