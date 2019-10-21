<?php

namespace Modules\Shorturl\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\Page;
use Modules\Page\Http\Requests\CreatePageRequest;
use Modules\Page\Http\Requests\CreateShortUrlRequest;
use Modules\Page\Http\Requests\UpdatePageRequest;
use Modules\Page\Repositories\PageRepository;
use Modules\Page\Transformers\FullPageTransformer;
use Modules\Page\Transformers\PageTransformer;
use Modules\Shorturl\Entities\ShortUrl;
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

    public function store(CreateShortUrlRequest $request)
    {
        $this->shortUrl->create($request->all());

        return response()->json([
            'errors' => false,
            'message' => trans('shorturl::messages.shorturl created'),
        ]);
    }

    public function find(ShortUrl $shortUrl)
    {
        return new ShortUrlTransformer($shortUrl);
    }

    public function update(ShortUrl $shortUrl, CreateShortUrlRequest $request)
    {
        $this->shortUrl->update($shortUrl, $request->except('title'));

        return response()->json([
            'errors' => false,
            'message' => trans('shorturl::messages.shorturl updated'),
        ]);
    }

    public function destroy(ShortUrl $shortUrl)
    {
        $this->shortUrl->destroy($shortUrl);

        return response()->json([
            'errors' => false,
            'message' => trans('shorturl::messages.shorturl deleted'),
        ]);
    }
}
