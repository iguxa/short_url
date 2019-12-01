<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 01.12.19
 * Time: 1:28
 */

namespace Modules\Services\Http\Services;


use Modules\Services\Entities\WorkFlows;

class WorkFlow
{
    public function workflow()
    {
        $test = 1;
        return [
            'straight'   => [
                'type'          => 'workflow',
                'marking_store' => [
                    'type' => 'single_state',
                ],
                'supports'      => ['stdClass'],
                'places'        => WorkFlows::all()->pluck('title'),
                'transitions'   => $this->getEnt()
                ,
            ]
        ];
    }
    public function getEnt()
    {
        $test = 1;
        $result = [];
        $models = WorkFlows::all();
        foreach ($models as $model){
            $related = $model->related_workflow()->get();
            foreach ($related ?? [] as $rel){
                $result[$model->description ?? 'cust'] = [
                    'from' => $model->title,
                    'to'   => $rel->title,
                ];
            }
        }
        return $result;
    }

}
