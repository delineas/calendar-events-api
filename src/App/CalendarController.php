<?php

namespace Src\App;

use Src\Core\Request;
use Src\App\EventResource;
use Src\Core\Container;

class CalendarController
{
    public function __construct()
    {
        $this->response = Container::get('response');
        $this->calendarClient = Container::get('calendarClient');
    }

    public function nextEvent()
    {
        $events = $this->calendarClient->eventsByDateSince('today');
        $nextEvent = (count($events) > 0) ? current($events) : null;
        return is_null($nextEvent) 
            ? $this->response->sendError('not found', 404) 
            : $this->response->sendMessage(EventResource::toArray($nextEvent[0]));
    }

    public function eventsByDateSince($date)
    {
        $events = $this->calendarClient->eventsByDateSince((string)$date);
        return (count($events) < 1) 
            ? $this->response->sendError('not found', 404) 
            : $this->response->sendMessage(
                array_map(function($event) {
                    return EventResource::toArray($event[0]);
                }, $events)
            );
    }

    public function eventsFuture()
    {
        $date = date('Y-m-d');
        $events = $this->calendarClient->eventsByDateSince((string)$date);
        return (count($events) < 1)
            ? $this->response->sendError('not found', 404)
            : $this->response->sendMessage(
                array_map(function ($event) {
                    return EventResource::toArray($event[0]);
                }, $events)
            );
    }
}
