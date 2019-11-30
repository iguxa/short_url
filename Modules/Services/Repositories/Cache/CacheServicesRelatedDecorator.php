<?php

namespace Modules\Services\Repositories\Cache;

use Modules\Services\Repositories\ServicesRelatedRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheServicesRelatedDecorator extends BaseCacheDecorator implements ServicesRelatedRepository
{
    public function __construct(ServicesRelatedRepository $servicesrelated)
    {
        parent::__construct();
        $this->entityName = 'services.servicesrelateds';
        $this->repository = $servicesrelated;
    }
}
