<?php

namespace DaveLiddament\CustomPhpstanRulesTalkDemo\Service;

use DaveLiddament\CustomPhpstanRulesTalkDemoLibrary\AlertService;

final class Alerter
{
    public function __construct(private readonly AlertService $alertService)
    {
    }

    public function alert(string $message): void
    {
        $this->alertService->alert($message, 'info');
    }
}