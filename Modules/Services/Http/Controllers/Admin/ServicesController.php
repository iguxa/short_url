<?php

namespace Modules\Services\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Services\Entities\Services;
use Modules\Services\Http\Requests\CreateServicesRequest;
use Modules\Services\Http\Requests\UpdateServicesRequest;
use Modules\Services\Repositories\ServicesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ServicesController extends AdminBaseController
{
    /**
     * @var ServicesRepository
     */
    private $services;

    public function __construct(ServicesRepository $services)
    {
        parent::__construct();

        $this->services = $services;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$services = $this->services->all();

        return view('services::admin.services.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('services::admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateServicesRequest $request
     * @return Response
     */
    public function store(CreateServicesRequest $request)
    {
        $this->services->create($request->all());

        return redirect()->route('admin.services.services.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('services::services.title.services')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Services $services
     * @return Response
     */
    public function edit(Services $services)
    {
        return view('services::admin.services.edit', compact('services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Services $services
     * @param  UpdateServicesRequest $request
     * @return Response
     */
    public function update(Services $services, UpdateServicesRequest $request)
    {
        $this->services->update($services, $request->all());

        return redirect()->route('admin.services.services.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('services::services.title.services')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Services $services
     * @return Response
     */
    public function destroy(Services $services)
    {
        $this->services->destroy($services);

        return redirect()->route('admin.services.services.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('services::services.title.services')]));
    }
}
