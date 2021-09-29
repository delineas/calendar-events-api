<?php

namespace Src\App;

class ICalOccurrence
{

  /**
   * @var ICalEvent
   */
  protected $_event;

  /**
   * @var integer
   */
  protected $_timestamp;


  public function __construct(ICalEvent $event, $timestamp)
  {
    $this->_event     = $event;
    $this->_timestamp = $timestamp;
  }

  public function __toString()
  {
    return (string) $this->_timestamp;
  }


  public function format($format = 'U')
  {
    return date($format, $this->_timestamp);
  }

  public function duration($format = 'U')
  {
    return date($format, $this->_event->duration());
  }
}