<?php

declare(strict_types=1);

namespace Bitrix24\SDK\Services\Telephony;

use Bitrix24\SDK\Infrastructure\Filesystem\Base64Encoder;
use Bitrix24\SDK\Services\AbstractServiceBuilder;
use Bitrix24\SDK\Services\Telephony;
use Symfony\Component\Filesystem\Filesystem;

class TelephonyServiceBuilder extends AbstractServiceBuilder
{
    public function externalCall(): Telephony\ExternalCall\Service\ExternalCall
    {
        if (!isset($this->serviceCache[__METHOD__])) {
            $this->serviceCache[__METHOD__] = new Telephony\ExternalCall\Service\ExternalCall(
                new Telephony\ExternalCall\Service\Batch($this->batch, $this->log),
                new Base64Encoder(
                    new Filesystem(),
                    new \Symfony\Component\Mime\Encoder\Base64Encoder(),
                    $this->log,
                ),
                $this->core,
                $this->log
            );
        }

        return $this->serviceCache[__METHOD__];
    }
    public function call(): Telephony\Call\Service\Call
    {
        if (!isset($this->serviceCache[__METHOD__])) {
            $this->serviceCache[__METHOD__] = new Telephony\Call\Service\Call(
                new Telephony\Call\Service\Batch($this->batch, $this->log),
                $this->core,
                $this->log
            );
        }

        return $this->serviceCache[__METHOD__];
    }
}