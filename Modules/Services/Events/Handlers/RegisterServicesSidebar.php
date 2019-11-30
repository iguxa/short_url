<?php

namespace Modules\Services\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterServicesSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('services::services.title.services'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('services::services.title.services'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.services.services.create');
                    $item->route('admin.services.services.index');
                    $item->authorize(
                        $this->auth->hasAccess('services.services.index')
                    );
                });
                /*$item->item(trans('services::workflows.title.workflows'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.services.workflows.create');
                    $item->route('admin.services.workflows.index');
                    $item->authorize(
                        $this->auth->hasAccess('services.workflows.index')
                    );
                });
                $item->item(trans('services::lifecircles.title.lifecircles'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.services.lifecircle.create');
                    $item->route('admin.services.lifecircle.index');
                    $item->authorize(
                        $this->auth->hasAccess('services.lifecircles.index')
                    );
                });
                $item->item(trans('services::servicesrelateds.title.servicesrelateds'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.services.servicesrelated.create');
                    $item->route('admin.services.servicesrelated.index');
                    $item->authorize(
                        $this->auth->hasAccess('services.servicesrelateds.index')
                    );
                });*/
// append




            });
        });

        return $menu;
    }
}
