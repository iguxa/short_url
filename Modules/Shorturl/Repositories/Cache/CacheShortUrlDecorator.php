<?php

namespace Modules\Shorturl\Repositories\Cache;

use Modules\Shorturl\Repositories\ShortUrlRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheShortUrlDecorator extends BaseCacheDecorator implements ShortUrlRepository
{
    public function __construct(ShortUrlRepository $shorturl)
    {
        parent::__construct();
        $this->entityName = 'shorturl.shorturls';
        $this->repository = $shorturl;
    }
}
