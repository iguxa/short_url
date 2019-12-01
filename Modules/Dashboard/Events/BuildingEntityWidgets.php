<?php


namespace Modules\Dashboard\Events;


class BuildingEntityWidgets
{
    private $entityType;
    private $entityId;
    /**
     * @var array
     */
    private $widgets;

    public function __construct($entityType, $entityId)
    {
        $this->entityType = $entityType;
        $this->entityId = $entityId;
        $this->widgets = [];
    }

    public function addWidget($name)
    {
        $this->widgets[] = $name;
    }

    public function getEntityType()
    {
        return $this->entityType;
    }

    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @return array
     */
    public function getWidgets(): array
    {
        return $this->widgets;
    }
}
