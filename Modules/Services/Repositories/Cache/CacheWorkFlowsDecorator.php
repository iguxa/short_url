<?php

namespace Modules\Services\Repositories\Cache;

use Modules\Services\Repositories\WorkFlowsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheWorkFlowsDecorator extends BaseCacheDecorator implements WorkFlowsRepository
{
    public function __construct(WorkFlowsRepository $workflows)
    {
        parent::__construct();
        $this->entityName = 'services.workflows';
        $this->repository = $workflows;
    }
}
