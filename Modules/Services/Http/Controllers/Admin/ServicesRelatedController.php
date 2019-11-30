<?php

namespace Modules\Services\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Services\Entities\ServicesRelated;
use Modules\Services\Http\Requests\CreateServicesRelatedRequest;
use Modules\Services\Http\Requests\UpdateServicesRelatedRequest;
use Modules\Services\Repositories\ServicesRelatedRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ServicesRelatedController extends AdminBaseController
{
    /**
     * @var ServicesRelatedRepository
     */
    private $servicesrelated;

    public function __construct(ServicesRelatedRepository $servicesrelated)
    {
        parent::__construct();

        $this->servicesrelated = $servicesrelated;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$servicesrelateds = $this->servicesrelated->all();

        return view('services::admin.servicesrelateds.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('services::admin.servicesrelateds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateServicesRelatedRequest $request
     * @return Response
     */
    public function store(CreateServicesRelatedRequest $request)
    {
        $this->servicesrelated->create($request->all());

        return redirect()->route('admin.services.servicesrelated.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('services::servicesrelateds.title.servicesrelateds')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ServicesRelated $servicesrelated
     * @return Response
     */
    public function edit(ServicesRelated $servicesrelated)
    {
        return view('services::admin.servicesrelateds.edit', compact('servicesrelated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ServicesRelated $servicesrelated
     * @param  UpdateServicesRelatedRequest $request
     * @return Response
     */
    public function update(ServicesRelated $servicesrelated, UpdateServicesRelatedRequest $request)
    {
        $this->servicesrelated->update($servicesrelated, $request->all());

        return redirect()->route('admin.services.servicesrelated.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('services::servicesrelateds.title.servicesrelateds')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ServicesRelated $servicesrelated
     * @return Response
     */
    public function destroy(ServicesRelated $servicesrelated)
    {
        $this->servicesrelated->destroy($servicesrelated);

        return redirect()->route('admin.services.servicesrelated.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('services::servicesrelateds.title.servicesrelateds')]));
    }
}
