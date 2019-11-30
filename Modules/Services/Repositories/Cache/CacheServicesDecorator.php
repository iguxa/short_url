<?php

namespace Modules\Services\Repositories\Cache;

use Modules\Services\Repositories\ServicesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheServicesDecorator extends BaseCacheDecorator implements ServicesRepository
{
    public function __construct(ServicesRepository $services)
    {
        parent::__construct();
        $this->entityName = 'services.services';
        $this->repository = $services;
    }
}
