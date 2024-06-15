<?php

declare(strict_types=1);

namespace Bitrix24\SDK\Services\Telephony\Voximplant\Sip\Service;

use Bitrix24\SDK\Core\Contracts\CoreInterface;
use Bitrix24\SDK\Core\Exceptions\BaseException;
use Bitrix24\SDK\Core\Exceptions\TransportException;
use Bitrix24\SDK\Core\Result\DeletedItemResult;
use Bitrix24\SDK\Core\Result\EmptyResult;
use Bitrix24\SDK\Services\AbstractService;
use Bitrix24\SDK\Services\Telephony\Common\PbxType;
use Bitrix24\SDK\Services\Telephony\ExternalLine\Result\ExternalLineAddedResult;
use Bitrix24\SDK\Services\Telephony\ExternalLine\Result\ExternalLinesResult;
use Bitrix24\SDK\Services\Telephony\Voximplant\Sip\Result\SipLineAddedResult;
use Bitrix24\SDK\Services\Telephony\Voximplant\Sip\Result\SipLinesResult;
use Bitrix24\SDK\Services\Telephony\Voximplant\Sip\Result\SipLineStatusItemResult;
use Bitrix24\SDK\Services\Telephony\Voximplant\Sip\Result\SipLineStatusResult;
use Psr\Log\LoggerInterface;

class Sip extends AbstractService
{
    public function __construct(
        readonly public Batch $batch,
        CoreInterface         $core,
        LoggerInterface       $logger
    )
    {
        parent::__construct($core, $logger);
    }

    /**
     * Creates a new SIP line linked to the application. Once created, this line becomes an outbound line by default.
     *
     * This method is available to the user with granted access permissions for Manage numbers - Edit - Any.
     *
     * @link https://training.bitrix24.com/rest_help/scope_telephony/voximplant/voximplant_sip_add.php
     */
    public function add(
        PbxType $pbxType,
        string  $title,
        string  $serverUrl,
        string  $login,
        string  $password
    ): SipLineAddedResult
    {
        return new SipLineAddedResult($this->core->call('voximplant.sip.add', [
            'TYPE' => $pbxType->value,
            'TITLE' => $title,
            'SERVER' => $serverUrl,
            'LOGIN' => $login,
            'PASSWORD' => $password
        ]));
    }

    /**
     * Deletes the current SIP line (created by the application).
     *
     * This method is available to the user with granted access permissions for Manage numbers - Edit - Any.
     * @param int $sipConfigId SIP line setup identifier.
     * @throws BaseException
     * @throws TransportException
     * @link https://training.bitrix24.com/rest_help/scope_telephony/voximplant/voximplant_sip_delete.php
     */
    public function delete(int $sipConfigId): DeletedItemResult
    {
        return new DeletedItemResult($this->core->call('voximplant.sip.delete', [
            'CONFIG_ID' => $sipConfigId
        ]));
    }

    /**
     * Returns the list of all SIP lines created by the application. It is a list method.
     *
     * This method is available to the user with granted access permissions for Manage numbers - Edit - Any.
     * @throws BaseException
     * @throws TransportException
     * @link https://training.bitrix24.com/rest_help/scope_telephony/voximplant/voximplant_sip_get.php
     */
    public function get(): SipLinesResult
    {
        return new SipLinesResult($this->core->call('voximplant.sip.get'));
    }

    /**
     * Returns the current status of the SIP registration (for cloud hosted PBX only).
     *
     * This method is available to the user with granted access permissions for Manage numbers - Edit - Any.
     *
     * @link https://training.bitrix24.com/rest_help/scope_telephony/voximplant/voximplant_sip_status.php
     * @param int $sipRegistrationId SIP registration identifier.
     * @throws BaseException
     * @throws TransportException
     */
    public function status(int $sipRegistrationId): SipLineStatusResult
    {
        return new SipLineStatusResult($this->core->call('voximplant.sip.status', [
            'REG_ID' => $sipRegistrationId
        ]));
    }
}