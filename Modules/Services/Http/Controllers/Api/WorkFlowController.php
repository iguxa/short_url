<?php

namespace Modules\Services\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;
use Modules\Services\Http\Services\OffersRelated;
use Modules\Services\Entities\WorkFlows;
use Modules\Services\Http\Requests\WorkFlows\CreateWorkFlowRequest;
use Modules\Services\Http\Services\WorkFlow;
use Modules\Services\Repositories\ServicesRepository;
use Modules\Services\Repositories\WorkFlowsRepository;
use Modules\Services\Transformers\WorkFlow\WorkFlowFormTransformer;
use Modules\Services\Transformers\WorkFlow\WorkFlowTransformer;

class WorkFlowController extends Controller
{
    /**
     * @var ServicesRepository
     */
    private $workflow;

    public function __construct(WorkFlowsRepository $workflow)
    {
        $this->workflow = $workflow;
    }

    public function index(Request $request)
    {
        return WorkFlowTransformer::collection($this->workflow->nestedSort(WorkFlows::defaultOrder()->get()->toTree()));
    }
    public function generate()
    {
        if(is_writable('results.json')){
            $response = (new WorkFlow())->workflow();
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
         shell_exec('cp /var/www/short_url/workflow.svg /var/www/short_url/public');
         shell_exec('cp /var/www/asgard_short/workflow.svg /var/www/asgard_short/public');

        return ['src'=>URL::to('/').'/workflow.svg'];
    }

    public function store(CreateWorkFlowRequest $request)
    {
        $workflow = $this->workflow->create($request->all());
        (new OffersRelated($workflow))->addRelated_workflow(array_filter($request->get('related_workflow')));


        return response()->json([
            'errors' => false,
            'message' => trans('shorturl::messages.shorturl created'),
        ]);
    }

    public function find(WorkFlows $workFlows)
    {
        return new WorkFlowFormTransformer($workFlows);
    }

    public function update(WorkFlows $services, CreateWorkFlowRequest $request)
    {
        $workflow = $this->workflow->update($services, $request->all());
        (new OffersRelated($workflow))->addRelated_workflow(array_filter($request->get('related_workflow')));

        return response()->json([
            'errors' => false,
            'message' => trans('shorturl::messages.shorturl updated'),
        ]);
    }

    public function destroy(WorkFlows $services)
    {
        $this->workflow->destroy($services);

        return response()->json([
            'errors' => false,
            'message' => trans('shorturl::messages.shorturl deleted'),
        ]);
    }
    public function downCategory(WorkFlows $workflow)
    {
        $workflow->down();

        return WorkFlowTransformer::collection($this->workflow->nestedSort(WorkFlows::defaultOrder()->get()->toTree()));
    }
    public function upCategory(WorkFlows $workflow)
    {
        $workflow->up();

        return WorkFlowTransformer::collection($this->workflow->nestedSort(WorkFlows::defaultOrder()->get()->toTree()));
    }
}
