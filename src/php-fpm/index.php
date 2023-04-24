<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use OpenTelemetry\API\Common\Instrumentation\Globals;
use OpenTelemetry\API\Trace\SpanKind;
use OpenTelemetry\API\Trace\Propagation\TraceContextPropagator;

$tracer = Globals::tracerProvider()->getTracer('manual-instrumentation');

$context = TraceContextPropagator::getInstance()->extract(getallheaders());
$rootSpan = $tracer->spanBuilder('HTTP ' . $_SERVER['REQUEST_METHOD'])
    ->setStartTimestamp((int) ($_SERVER['REQUEST_TIME_FLOAT'] * 1e9))
    ->setParent($context)
    ->setSpanKind(SpanKind::KIND_SERVER)
    ->startSpan();
$scope = $rootSpan->activate();
try {
    $rootSpan->addEvent('Received request through NGINX');
    echo '<h1>Hello World</h1>';

    $carrier = [];
    TraceContextPropagator::getInstance()->inject($carrier);
    foreach ($carrier as $name => $value) {
        echo '<p>' . $name . ': ' . $value. '</p>';
    }

} finally {
    $rootSpan->end();
    $scope->detach();
}