<?php 

namespace Src\App;

class EventResource
{
    public static function toArray($event)
    {
        return [
            'summary' => stripslashes($event->summary),
            'description' => '', //$event->description,
            'start' => $event->dateStartTZ
        ];
      }
}