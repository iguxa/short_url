<?php

return [
    'services.service' => [
        'index' => 'services::services.list resource',
        'create' => 'services::services.create resource',
        'edit' => 'services::services.edit resource',
        'destroy' => 'services::services.destroy resource',
    ],
    'services.workflow' => [
        'index' => 'services::workflows.list resource',
        'create' => 'services::workflows.create resource',
        'edit' => 'services::workflows.edit resource',
        'destroy' => 'services::workflows.destroy resource',
    ],
    'services.lifecircles' => [
        'index' => 'services::lifecircles.list resource',
        'create' => 'services::lifecircles.create resource',
        'edit' => 'services::lifecircles.edit resource',
        'destroy' => 'services::lifecircles.destroy resource',
    ],
    'services.servicesrelateds' => [
        'index' => 'services::servicesrelateds.list resource',
        'create' => 'services::servicesrelateds.create resource',
        'edit' => 'services::servicesrelateds.edit resource',
        'destroy' => 'services::servicesrelateds.destroy resource',
    ],
// append




];
