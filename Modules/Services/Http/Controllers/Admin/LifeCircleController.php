<?php

namespace Modules\Services\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Services\Entities\LifeCircle;
use Modules\Services\Http\Requests\CreateLifeCircleRequest;
use Modules\Services\Http\Requests\UpdateLifeCircleRequest;
use Modules\Services\Repositories\LifeCircleRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class LifeCircleController extends AdminBaseController
{
    /**
     * @var LifeCircleRepository
     */
    private $lifecircle;

    public function __construct(LifeCircleRepository $lifecircle)
    {
        parent::__construct();

        $this->lifecircle = $lifecircle;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$lifecircles = $this->lifecircle->all();

        return view('services::admin.lifecircles.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('services::admin.lifecircles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLifeCircleRequest $request
     * @return Response
     */
    public function store(CreateLifeCircleRequest $request)
    {
        $this->lifecircle->create($request->all());

        return redirect()->route('admin.services.lifecircle.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('services::lifecircles.title.lifecircles')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LifeCircle $lifecircle
     * @return Response
     */
    public function edit(LifeCircle $lifecircle)
    {
        return view('services::admin.lifecircles.edit', compact('lifecircle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LifeCircle $lifecircle
     * @param  UpdateLifeCircleRequest $request
     * @return Response
     */
    public function update(LifeCircle $lifecircle, UpdateLifeCircleRequest $request)
    {
        $this->lifecircle->update($lifecircle, $request->all());

        return redirect()->route('admin.services.lifecircle.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('services::lifecircles.title.lifecircles')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LifeCircle $lifecircle
     * @return Response
     */
    public function destroy(LifeCircle $lifecircle)
    {
        $this->lifecircle->destroy($lifecircle);

        return redirect()->route('admin.services.lifecircle.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('services::lifecircles.title.lifecircles')]));
    }
}
