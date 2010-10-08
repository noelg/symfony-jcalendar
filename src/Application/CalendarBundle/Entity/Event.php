<?php

namespace Application\CalendarBundle\Entity;

/**
 * @Doctrine\ORM\Mapping\Entity(repositoryClass="Application\CalendarBundle\Entity\EventRepository")
 */
class Event
{
    /**
     * @Doctrine\ORM\Mapping\Id
     * @Doctrine\ORM\Mapping\Column(type="integer")
     * @Doctrine\ORM\Mapping\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string", length="255")
     */
    protected $name;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string", length="1024")
     */
    protected $subject;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string", length="1024")
     */
    protected $location;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string", length="255")
     */
    protected $description;

    /**
     * @Doctrine\ORM\Mapping\Column(type="datetime")
     */
    protected $startTime;

    /**
     * @Doctrine\ORM\Mapping\Column(type="datetime")
     */
    protected $endTime;


    /**
     * @Doctrine\ORM\Mapping\Column(type="boolean")
     */
    protected $isAllDayEvent;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string", length="200")
     */
    protected $color;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string", length="200")
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
