<?php

namespace Modules\Services\Repositories\Cache;

use Modules\Services\Repositories\LifeCircleRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheLifeCircleDecorator extends BaseCacheDecorator implements LifeCircleRepository
{
    public function __construct(LifeCircleRepository $lifecircle)
    {
        parent::__construct();
        $this->entityName = 'services.lifecircles';
        $this->repository = $lifecircle;
    }
}
