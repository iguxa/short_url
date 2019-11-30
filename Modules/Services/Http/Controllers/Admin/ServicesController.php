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

    public function index()
    {
        return view('services::admin.services.index', compact(''));
    }

    public function create()
    {
        return view('services::admin.services.create');
    }

    public function edit()
    {
        return view('services::admin.services.edit', compact(''));
    }

}
