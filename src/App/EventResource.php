<?php 

namespace Src\App;

class EventResource
{
    public static function toArray($event)
    {
        return [
            'summary' => $event->summary,
            'description' => $event->description,
            'start' => $event->dateStartTZ
        ];
      }
}