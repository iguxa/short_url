<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 21.10.19
 * Time: 0:16
 */

namespace Modules\Shorturl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Modules\Shorturl\Entities\ShortUrl;
use Modules\Shorturl\Entities\Visitors;

class ShortUrlController extends Controller
{
    public function index(ShortUrl $shortUrl, Request $request)
    {
        if($this->isNewVisitors($request)) {
            $this->createNewVisitors($shortUrl);
        }else{
            Visitors::find($request->cookie('visitors_id'))->increment('counter');
        };
        $shortUrl->increment('counter');
        return redirect($shortUrl->redirect);
    }

    /**
     * @param Request $request
     * @return bool
     */
    protected function isNewVisitors(Request $request): bool
    {
        if($request->cookie('su') and $request->cookie('visitors_id')){
            return !boolval(Visitors::find($request->cookie('visitors_id')));
        };
        return true;
    }

    /**
     * @param ShortUrl $shortUrl
     */
    protected function createNewVisitors(ShortUrl $shortUrl): void
    {
        $visitors = Visitors::create(
            ['description' => 'test', 'server' => json_encode($_SERVER), 'short_url_id' => $shortUrl->id]
        );
        $visitors->increment('counter');
        Cookie::queue(Cookie::forever('su', $shortUrl->title));
        Cookie::queue(Cookie::forever('visitors_id', $visitors->id));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function isVisitorsNotCreated(Request $request)
    {
        $test =1;

        return Visitors::find($request->cookie('visitors_id'))->count() == 0;
    }

}
