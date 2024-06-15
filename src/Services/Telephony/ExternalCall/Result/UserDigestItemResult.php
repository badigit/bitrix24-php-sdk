<?php

declare(strict_types=1);

namespace Bitrix24\SDK\Services\Telephony\ExternalCall\Result;

use Bitrix24\SDK\Core\Result\AbstractItem;

/**
 * @property-read int $ID
 * @property-read string $TIMEMAN_STATUS
 * @property-read string $USER_PHONE_INNER
 * @property-read string $WORK_PHONE
 * @property-read string $PERSONAL_PHONE
 * @property-read string $PERSONAL_MOBILE
 *
 */
class UserDigestItemResult extends AbstractItem
{
    public function __get($offset)
    {
        return match ($offset) {
            'ID' => (int)$this->data[$offset],
            default => $this->data[$offset] ?? null,
        };
    }
}