<?php

namespace App\Entity\Enums;
enum OrderStatus: string
{
    case DISPATCH = "DISPATCH";
    case PREPARATION = "PREPARATION";
    case SHIPPING = "SHIPPING";
    case RECEPTION = "RECEPTION";
    case CONSOLIDATION = "CONSOLIDATION";
    case DISTRIBUTION = "DISTRIBUTION";
}