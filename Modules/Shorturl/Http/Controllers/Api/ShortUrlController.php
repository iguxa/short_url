<?php

namespace Modules\Shorturl\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\Page;
use Modules\Page\Http\Requests\CreatePageRequest;
use Modules\Page\Http\Requests\UpdatePageRequest;
use Modules\Page\Repositories\PageRepository;
use Modules\Page\Transformers\FullPageTransformer;
use Modules\Page\Transformers\PageTransformer;
use Modules\Shorturl\Repositories\ShortUrlRepository;
use Modules\Shorturl\Transformers\ShortUrlTransformer;

class ShortUrlController extends Controller
{
    /**
     * @var ShortUrlRepository
     */
    private $shortUrl;

    public function __construct(ShortUrlRepository $shortUrl)
    {
        $this->shortUrl = $shortUrl;
    }

    public function index(Request $request)
    {
        return ShortUrlTransformer::collection($this->shortUrl->serverPaginationFilteringFor($request));

    }

    public function store(CreatePageRequest $request)
    {
        $this->shortUrl->create($request->all());

        return response()->json([
            'errors' => false,
            'message' => trans('page::messages.page created'),
        ]);
    }

    public function find(Page $page)
    {
        return new FullPageTransformer($page);
    }

    public function update(Page $page, UpdatePageRequest $request)
    {
        $this->page->update($page, $request->all());

        return response()->json([
            'errors' => false,
            'message' => trans('page::messages.page updated'),
        ]);
    }

    public function destroy(Page $page)
    {
        $this->page->destroy($page);

        return response()->json([
            'errors' => false,
            'message' => trans('page::messages.page deleted'),
        ]);
    }
}
