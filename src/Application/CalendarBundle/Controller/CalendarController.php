<?php

namespace Application\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\CalendarBundle\Entity\Event;

class CalendarController extends Controller
{

    public function indexAction()
    {
        return $this->render('CalendarBundle:Calendar:index.php');
    }

    public function feedAction()
    {
        $em = $this['doctrine.orm.entity_manager'];
        $date = $this['request']->get('showdate', date('n/j/Y'));

        $events = $em->getRepository('CalendarBundle:Event')->exportForCalendar($date);

        return $this->createResponse(json_encode($events), 200, array('Content-Type' => 'text/javascript'));
    }

    public function addAction()
    {
        $em = $this['doctrine.orm.entity_manager'];

        $request = $this['request'];

        $event = new Event();
        $event->fromArray(array(
            'startTime' => $request->get('CalendarStartTime'),
            'endTime' => $request->get('CalendarEndTime'),
            'title' => $request->get('CalendarTitle'),
            'isAllDayEvent' => $request->get('IsAllDayEvent'),
        ));

        $em->persist($event);
        $em->flush();

        return $this->createResponse(json_encode(array('IsSuccess' => true, 'Msg' => 'add success', 'Data' => $event->getId())), 200, array('Content-Type' => 'text/javascript'));
    }

    public function updateAction()
    {
        $request = $this['request'];
        $em = $this['doctrine.orm.entity_manager'];
        $id = $request->get('calendarId');
        $event = $em->find('CalendarBundle:Event', $id);
        $event->setStartTime(new \DateTime($request->get('CalendarStartTime')));
        $event->setEndTime(new \DateTime($request->get('CalendarEndTime')));
        $em->persist($event);
        $em->flush();

        return $this->createResponse(json_encode(array('IsSuccess' => true, 'Msg' => 'update success')), 200, array('Content-Type' => 'text/javascript'));
    }

    public function deleteAction()
    {
        $request = $this['request'];
        $id = $request->get('calendarId');

        $em = $this['doctrine.orm.entity_manager'];
        $event = $em->find('CalendarBundle:Event', $id);
        $em->remove($event);
        $em->flush();

        return $this->createResponse(json_encode(array('IsSuccess' => true, 'Msg' => 'delete success')), 200, array('Content-Type' => 'text/javascript'));
    }

    public function editAction()
    {
        $em = $this['doctrine.orm.entity_manager'];
        $id = $this['request']->get('id');
        $event = $em->find('CalendarBundle:Event', $id);

        return $this->render('CalendarBundle:Calendar:edit.php', array('event' => $event));
    }

    public function updateDetailsAction()
    {
        $request = $this['request'];
        $id = $request->get('id');

        $em = $this['doctrine.orm.entity_manager'];
        if (!($event = $em->find('CalendarBundle:Event', $id))) {
            $event = new Event();
        }
        $event->fromArray(array(
            'description' => $request->get('Description'),
            'subject' => $request->get('Subject'),
            'location' => $request->get('Location'),
            'color' => $request->get('colorvalue'),
            'startTime' => $request->get('stpartdate') . ' ' . $request->get('stparttime'),
            'endTime' => $request->get('etpartdate') . ' ' . $request->get('etparttime'),
            'isAllDayEvent' => $request->get('IsAllDayEvent'),
        ));

        $em->persist($event);
        $em->flush();

        return $this->createResponse(json_encode(array('IsSuccess' => true, 'Msg' => 'update success')), 200, array('Content-Type' => 'text/javascript'));
    }
}
