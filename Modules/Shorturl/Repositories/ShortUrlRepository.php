<?php

namespace Modules\Shorturl\Repositories;

use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Core\Repositories\BaseRepository;

interface ShortUrlRepository extends BaseRepository
{
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator;
}
