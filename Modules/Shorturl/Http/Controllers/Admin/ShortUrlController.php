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
    private $shorturl;

    public function __construct(ShortUrlRepository $shorturl)
    {
        parent::__construct();

        $this->shorturl = $shorturl;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$shorturls = $this->shorturl->all();

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
     * Store a newly created resource in storage.
     *
     * @param  CreateShortUrlRequest $request
     * @return Response
     */
    public function store(CreateShortUrlRequest $request)
    {
        $this->shorturl->create($request->all());

        return redirect()->route('admin.shorturl.shorturl.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('shorturl::shorturls.title.shorturls')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ShortUrl $shorturl
     * @return Response
     */
    public function edit(ShortUrl $shorturl)
    {
        return view('shorturl::admin.shorturls.edit', compact('shorturl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ShortUrl $shorturl
     * @param  UpdateShortUrlRequest $request
     * @return Response
     */
    public function update(ShortUrl $shorturl, UpdateShortUrlRequest $request)
    {
        $this->shorturl->update($shorturl, $request->all());

        return redirect()->route('admin.shorturl.shorturl.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('shorturl::shorturls.title.shorturls')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ShortUrl $shorturl
     * @return Response
     */
    public function destroy(ShortUrl $shorturl)
    {
        $this->shorturl->destroy($shorturl);

        return redirect()->route('admin.shorturl.shorturl.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('shorturl::shorturls.title.shorturls')]));
    }
}
