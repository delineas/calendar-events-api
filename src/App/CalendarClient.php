<?php

namespace Src\App;

class CalendarClient {

    public function __invoke()
    {
        return new ICal($_ENV['GOOGLE_CALENDAR_PUBLIC_URL']);
    }

}