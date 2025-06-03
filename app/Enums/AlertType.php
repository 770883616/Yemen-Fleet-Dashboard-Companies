<?php
// filepath: app/Enums/AlertType.php

namespace App\Enums;

class AlertType
{
    const VEHICLE_FAULT = 'vehicle_fault';
    const DRIVER_HEALTH = 'driver_health';
    const WEATHER      = 'weather';
    const ACCIDENT     = 'accident';
    const SHIPMENT     = 'shipment';
    const BILLING      = 'billing';
    const SYSTEM       = 'system';
}
