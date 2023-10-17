<?php

namespace App\Repositories\Message;

use App\Models\Message;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Message
    {
        return parent::getModel();
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
                           ->when(!empty($payload['ticket_id']), function ($query) use ($payload) {
                               $query->where('ticket_id', $payload['ticket_id']);
                           })
                           ->with(['user', 'ticket'])
                           ->defaultSort('-id');
    }
}
