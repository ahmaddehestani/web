<?php

namespace App\Actions\ConsultationRequest;


use App\Actions\Message\StoreMessageAction;
use App\Enums\RoleEnum;
use App\Models\User;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserCompanyProfile\UserCompanyProfileRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class StoreConsultationRequestAction
{
    use AsAction;

    public function __construct(
        private readonly UserRepositoryInterface $repository,
        private readonly UserCompanyProfileRepositoryInterface $userCompanyProfileRepository,
        private readonly TicketRepositoryInterface $ticketRepository,
        private readonly MessageRepositoryInterface $messageRepository
    )
    {
    }

    public function handle(array $payload)
    {
        $payload['mobile_prefix'] = '+98';
        return DB::transaction(function () use ($payload) {
            $user = $this->repository->find($payload['mobile'],'mobile');
            if (!$user) {
                /** @var User $user */
                $user = $this->repository->create([
                    'mobile_prefix' => $payload['mobile_prefix'],
                    'mobile'        => (int)$payload['mobile'],
                    'name'          => $payload['name'],
                ]);
                $role = Role::where('name', RoleEnum::USER->value)->first();
                $user->assignRole($role);
                $payload['user_id'] = $user->id;
                if (isset($payload['company_name'])) {
                    $this->userCompanyProfileRepository->create($payload);
                }
            }
            $data['user_id'] = $user->id;
            $data['subject'] = 'webSite Consultation';
            $data['description'] = $payload['description'];
            $data['department'] = 'support';
            $ticket = $this->ticketRepository->create($data);
            $this->messageRepository->create([
                'ticket_id' => $ticket->id,
                'message'   => $data['description'],
                'user_id'   => $user->id,
            ]);
            return trans('ticket.store_success');
        });
    }
}
