<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Repositories\BaseRepositoryInterface;

interface TicketRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Ticket;
    public function toggleStatus(Ticket $ticket):Ticket;
}
