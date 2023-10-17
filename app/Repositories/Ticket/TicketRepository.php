<?php

namespace App\Repositories\Ticket;

use App\Enums\TableTicketFieldStatusEnum;
use App\Models\Ticket;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Ticket
    {
        return parent::getModel();
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
                           ->with(['user', 'messages'])
                           ->defaultSort('-id');
    }

    public function toggleStatus(Ticket $ticket): Ticket
    {
        if ($ticket->status === TableTicketFieldStatusEnum::OPEN) {
            $ticket->update([
                'status'    => TableTicketFieldStatusEnum::CLOSE,
                'closed_by' => auth()->user()->id
            ]);
        } else {
            $ticket->update([
                'status'    => TableTicketFieldStatusEnum::OPEN,
                'closed_by' => null
            ]);
        }
        return $ticket;
    }
}
