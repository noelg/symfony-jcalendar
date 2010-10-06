<?php

require_once __DIR__.'/../calendar/CalendarKernel.php';

$kernel = new CalendarKernel('prod', false);
$kernel->handle()->send();
