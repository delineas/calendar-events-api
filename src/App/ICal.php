<?php

// Copy from https://gist.github.com/seebz/c00a38d9520e035a6a8c

namespace Src\App;

class ICal
{
  /**
   * @var string
   */
  public $title;

  /**
   * @var string
   */
  public $description;

  /**
   * @var array
   */
  public $events = array();

  /**
   * @var array
   */
  protected $_eventsByDate;


  public function __construct($content = null)
  {
    if ($content) {
      $isUrl  = strpos($content, 'http') === 0 && filter_var($content, FILTER_VALIDATE_URL);
      $isFile = strpos($content, "\n") === false && file_exists($content);
      if ($isUrl || $isFile) {
        $content = file_get_contents($content);
      }
      $this->parse($content);
    }
  }


  public function title()
  {
    return $this->summary;
  }

  public function description()
  {
    return $this->description;
  }

  public function events()
  {
    return $this->events;
  }

  public function eventsByDate()
  {
    if (!$this->_eventsByDate) {
      $this->_eventsByDate = array();

      foreach ($this->events() as $event) {
        foreach ($event->occurrences() as $occurrence) {
          $date = $occurrence->format('Y-m-d');
          $this->_eventsByDate[$date][] = $event;
        }
      }
      ksort($this->_eventsByDate);
    }

    return $this->_eventsByDate;
  }

  public function eventsByDateBetween($start, $end)
  {
    if ((string) (int) $start !== (string) $start) {
      $start = strtotime($start);
    }
    $start = date('Y-m-d', $start);

    if ((string) (int) $end !== (string) $end) {
      $end = strtotime($end);
    }
    $end = date('Y-m-d', $end);

    $return = array();
    foreach ($this->eventsByDate() as $date => $events) {
      if ($start <= $date && $date < $end) {
        $return[$date] = $events;
      }
    }

    return $return;
  }

  public function eventsByDateSince($start)
  {
    if ((string) (int) $start !== (string) $start) {
      $start = strtotime($start);
    }
    $start = date('Y-m-d', $start);

    $return = array();
    foreach ($this->eventsByDate() as $date => $events) {
      if ($start <= $date) {
        $return[$date] = $events;
      }
    }

    return $return;
  }

  public function parse($content)
  {
    $content = str_replace("\r\n ", '', $content);

    // Title
    preg_match('`^X-WR-CALNAME:(.*)$`m', $content, $m);
    $this->title = $m ? trim($m[1]) : null;

    // Description
    preg_match('`^X-WR-CALDESC:(.*)$`m', $content, $m);
    $this->description = $m ? trim($m[1]) : null;

    // Events
    preg_match_all('`BEGIN:VEVENT(.+)END:VEVENT`Us', $content, $m);
    foreach ($m[0] as $c) {
      $this->events[] = new ICalEvent($c);
    }

    return $this;
  }
}
