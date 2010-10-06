<?php

namespace Application\CalendarBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository
{

    /**
     * Returns events for a given week
     *
     * @param string $startDate
     * @param string $range
     * @return array(<Event>) A collection of Event
     */
    public function findByDateRange($start, $end)
    {
        $query = $this->getEntityManager()->createQuery('select e from CalendarBundle:Event e where e.startTime >= :start and e.startTime <= :end');

        $query->setParameters(array(
            'start' => date('Y-m-d H:i:s', $start),
            'end' => date('Y-m-d H:i:s', $end)
        ));

        return $query->getResult();
    }

    public function exportForCalendar($startDate)
    {
        $start = strtotime('Last monday', strtotime($startDate));
        $end = strtotime('+7 days', $start);

        $events = $this->findByDateRange($start, $end);
        $eventFeed = array();
        foreach ($events as $event) {
            $eventFeed[] = array(
                $event->getId(),
                $event->getName(),
                $event->getStartTime()->format('m/d/Y H:i'),
                $event->getEndTime()->format('m/d/Y H:i'),
                "0",
                0,
                null,
                $event->getColor(),
                1,
                null,
                ''
            );
        }

        return array(
            'events' => $eventFeed,
            'issort' => true,
            'start' => date('m/d/Y 00:00', $start),
            'end' => date('m/d/Y 23:59', $end),
            'error' => null
        );
    }

}