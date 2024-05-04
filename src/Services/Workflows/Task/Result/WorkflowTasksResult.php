<?php

declare(strict_types=1);

namespace Bitrix24\SDK\Services\Workflows\Task\Result;

use Bitrix24\SDK\Core\Exceptions\BaseException;
use Bitrix24\SDK\Core\Result\AbstractResult;

class WorkflowTasksResult extends AbstractResult
{
    /**
     * @return WorkflowTaskItemResult[]
     * @throws BaseException
     */
    public function getTasks(): array
    {
        $res = [];
        foreach ($this->getCoreResponse()->getResponseData()->getResult() as $item) {
            $res[] = new WorkflowTaskItemResult($item);
        }

        return $res;
    }
}