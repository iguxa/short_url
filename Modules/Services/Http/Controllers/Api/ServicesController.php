<?php

namespace Modules\Services\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;
use Modules\Page\Http\Requests\CreateShortUrlRequest;
use Modules\Services\Entities\Services;
use Modules\Services\Http\Requests\Services\CreateServicesRequest;
use Modules\Services\Http\Services\OffersRelated;
use Modules\Services\Http\Services\WorkFlow;
use Modules\Services\Repositories\ServicesRepository;
use Modules\Services\Transformers\Services\RelatedServicesFormTransformer;
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
    public function updateServices(Request $request)
    {
        //$service = Services::where('title',$request->get('title'))->first();
        $ids = [];
        /*if($service->count()){
            $model = $service;
        }else{
            $model = $this->services->create(['title'=>$request->get('title'),'description'=>$request->get('description')]);
        }*/
        $this->createServices($request);

        foreach ($request->get('straight')['transitions'] as $transitions){
            $ids[] = Services::where('title',$transitions['to'])->first()->id;
        }
        //(new OffersRelated($model))->addRelated_services(array_filter($ids));
        return $ids;
    }

    /**
     * @param Request $request
     */
    protected function createServices(Request $request): void
    {
        foreach ($request->get('straight')['places'] as $title) {
            $service = Services::where('title', $title);
            if (!$service->count()) {
                $this->services->create(['title' => $title]);
            }
        }
    }
    public function generate()
    {
        if(is_writable('results.json')){
            $response = (new WorkFlow())->services();
            $fp = fopen('results.json', 'w');
            fwrite($fp, json_encode($response));
            fclose($fp);
            return ['generate'=>true];
        }
        return['generate'=>false];
    }
    public function getdoc()
    {
        //$test = URL::to('/');
        /*Artisan::call('workflow:dump straight', [
            '--format' => 'svg', '--class' => 'App\\Http\\Controllers\\Controller'
        ]);*/
        //Artisan::call('module:make-migration create_services__workflow_related_table11 Services');
        //return shell_exec('php /var/www/short_url/artisan workflow:dump straight --format=svg --class=stdClass');
        shell_exec('cp /var/www/short_url/services.svg /var/www/short_url/public');
        shell_exec('cp /var/www/asgard_short/straight.svg /var/www/asgard_short/public');

        return ['src'=>URL::to('/').'/services.svg'];
    }
    public function check(Request $request)
    {
        return (new OffersRelated(new Services))->getSameByRel(array_filter($request->get('related_services')));
    }
}
