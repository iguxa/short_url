<?php

namespace Modules\Shorturl\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Shorturl\Entities\ShortUrl;
use Modules\Shorturl\Http\Requests\CreateShortUrlRequest;
use Modules\Shorturl\Http\Requests\UpdateShortUrlRequest;
use Modules\Shorturl\Repositories\ShortUrlRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ShortUrlController extends AdminBaseController
{
    /**
     * @var ShortUrlRepository
     */
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('shorturl::admin.shorturls.index', compact(''));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('shorturl::admin.shorturls.create');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('shorturl::admin.shorturls.edit', compact(''));
    }
}
