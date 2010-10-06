<?php

namespace Application\CalendarBundle\Entity;


/**
 * @Table()
 * @Entity(repositoryClass="Application\CalendarBundle\Entity\EventRepository")
 */
class Event
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(type="string", length="255")
     */
    protected $name;

    /**
     * @Column(type="string", length="1024")
     */
    protected $subject;

    /**
     * @Column(type="string", length="1024")
     */
    protected $location;

    /**
     * @Column(type="string", length="255")
     */
    protected $description;

    /**
     * @Column(type="datetime")
     */
    protected $startTime;

    /**
     * @Column(type="datetime")
     */
    protected $endTime;


    /**
     * @Column(type="boolean")
     */
    protected $isAllDayEvent;

    /**
     * @Column(type="string", length="200")
     */
    protected $color;

    /**
     * @Column(type="string", length="200")
     */
    protected $recurringRule;


    public function getId()
    {
      return $this->id;
    }

    public function setStartTime($t)
    {
      $this->startTime = $t;
    }

    public function setEndTime($t)
    {
      $this->endTime = $t;
    }

    public function fromArray($values)
    {
      $this->name          = isset($values['title']) ? $values['title'] : (string) $this->name;
      $this->subject       = isset($values['subject']) ? $values['subject'] : '';
      $this->description   = isset($values['description']) ? $values['description'] : '';
      $this->color         = isset($values['color']) ? $values['color'] : 4;
      $this->location      = isset($values['location']) ? $values['location'] : '';
      $this->recurringRule = false;
      $this->startTime     = new \DateTime($values['startTime']);
      $this->endTime       = new \DateTime($values['endTime']);
      $this->isAllDayEvent = isset($values['isAllDayEvent']) ? (bool) $values['isAllDayEvent'] : false;
    }

    public function __call($method, $args = array())
    {
      if (0 === strpos($method, 'get'))
      {
        $field = lcfirst(str_replace('get', '', $method));
        return $this->$field;
      }

      throw new RunTimeException(sprintf('Method %s not found', $method));
    }
}
