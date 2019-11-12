<?php

namespace Modules\Shorturl\Repositories\Cache;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
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

    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator
    {
        // TODO: Implement serverPaginationFilteringFor() method.
    }
}
