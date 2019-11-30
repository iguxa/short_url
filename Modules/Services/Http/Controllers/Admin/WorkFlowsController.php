<?php

namespace Modules\Services\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Services\Entities\WorkFlows;
use Modules\Services\Http\Requests\CreateWorkFlowsRequest;
use Modules\Services\Http\Requests\UpdateWorkFlowsRequest;
use Modules\Services\Repositories\WorkFlowsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class WorkFlowsController extends AdminBaseController
{
    /**
     * @var WorkFlowsRepository
     */
    private $workflows;

    public function __construct(WorkFlowsRepository $workflows)
    {
        parent::__construct();

        $this->workflows = $workflows;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$workflows = $this->workflows->all();

        return view('services::admin.workflows.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('services::admin.workflows.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateWorkFlowsRequest $request
     * @return Response
     */
    public function store(CreateWorkFlowsRequest $request)
    {
        $this->workflows->create($request->all());

        return redirect()->route('admin.services.workflows.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('services::workflows.title.workflows')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  WorkFlows $workflows
     * @return Response
     */
    public function edit(WorkFlows $workflows)
    {
        return view('services::admin.workflows.edit', compact('workflows'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  WorkFlows $workflows
     * @param  UpdateWorkFlowsRequest $request
     * @return Response
     */
    public function update(WorkFlows $workflows, UpdateWorkFlowsRequest $request)
    {
        $this->workflows->update($workflows, $request->all());

        return redirect()->route('admin.services.workflows.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('services::workflows.title.workflows')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  WorkFlows $workflows
     * @return Response
     */
    public function destroy(WorkFlows $workflows)
    {
        $this->workflows->destroy($workflows);

        return redirect()->route('admin.services.workflows.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('services::workflows.title.workflows')]));
    }
}
