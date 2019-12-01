<?php

namespace Modules\Services\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Page\Http\Requests\CreateShortUrlRequest;
use Modules\Services\Entities\Services;
use Modules\Services\Http\Requests\Services\CreateServicesRequest;
use Modules\Services\Http\Services\OffersRelated;
use Modules\Services\Repositories\ServicesRepository;
use Modules\Services\Transformers\Services\ServicesFormTransformer;
use Modules\Services\Transformers\Services\ServicesTransformer;
use Modules\Shorturl\Entities\ShortUrl;
use Modules\Shorturl\Transformers\ShortUrlTransformer;

class ServicesController extends Controller
{
    /**
     * @var ServicesRepository
     */
    private $services;

    public function __construct(ServicesRepository $services)
    {
        $this->services = $services;
    }

    public function index(Request $request)
    {
        return ServicesTransformer::collection($this->services->serverPaginationFilteringFor($request));

    }

    public function store(CreateServicesRequest $request)
    {
        $services = $this->services->create($request->all());
        (new OffersRelated($services))->addRelated_services(array_filter($request->get('related_services')));


        return response()->json([
            'errors' => false,
            'message' => trans('shorturl::messages.shorturl created'),
        ]);
    }

    public function find(Services $services)
    {
        return new ServicesFormTransformer($services);
    }

    public function update(Services $services, CreateServicesRequest $request)
    {
        $services = $this->services->update($services, $request->except('id'));
        (new OffersRelated($services))->addRelated_services(array_filter($request->get('related_services')));


        return response()->json([
            'errors' => false,
            'message' => trans('shorturl::messages.shorturl updated'),
        ]);
    }

    public function destroy(Services $services)
    {
        $this->services->destroy($services);

        return response()->json([
            'errors' => false,
            'message' => trans('shorturl::messages.shorturl deleted'),
        ]);
    }
}
