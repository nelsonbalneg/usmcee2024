<?php

namespace App\Services;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReservationApplicantSearch
{
    public function search(int $sessionId, string $term): Collection
    {
        $term = trim($term);
        if (mb_strlen($term) < 2) {
            return collect();
        }
        $query = $this->eligible($sessionId);
        // Prefix searches use existing name indexes; split names allow either name order.
        foreach (array_slice(preg_split('/[\s,]+/u', $term, -1, PREG_SPLIT_NO_EMPTY), 0, 5) as $token) {
            $prefix = str_replace(['!', '%', '_', '['], ['!!', '!%', '!_', '!['], $token).'%';
            $query->where(function (Builder $names) use ($prefix) {
                foreach (['lastname', 'firstname', 'middlename', 'suffix', 'lrn'] as $column) {
                    $names->orWhereRaw("users.{$column} LIKE ? ESCAPE '!'", [$prefix]);
                }
            });
        }
        return $query->orderBy('users.lastname')->orderBy('users.firstname')->orderBy('users.id')
            ->limit(25)->get()->map(fn ($user) => $this->format($user));
    }

    public function selected(int $sessionId, int $userId): Collection
    {
        return $this->eligible($sessionId)->where('users.id', $userId)->limit(1)->get()
            ->map(fn ($user) => (object) $this->format($user));
    }

    private function eligible(int $sessionId): Builder
    {
        return DB::table('users')->select('users.id', 'users.firstname', 'users.lastname', 'users.middlename', 'users.suffix', 'users.lrn', 'users.birthdate')
            ->whereNotNull('users.lrn')->where('users.lrn', '<>', '')
            ->whereNotExists(function (Builder $query) use ($sessionId) {
                $query->selectRaw('1')->from('reservations')->whereColumn('reservations.user_id', 'users.id')
                    ->where('reservations.cee_session_id', $sessionId)->whereIn('reservations.status', ['pending', 'confirmed']);
            });
    }

    private function format(object $user): array
    {
        return [
            'id' => $user->id,
            'fullname' => trim($user->lastname.', '.$user->firstname.' '.($user->middlename ?? '').' '.($user->suffix ?? '')),
            'lrn' => $user->lrn, 'firstname' => $user->firstname, 'lastname' => $user->lastname, 'birthdate' => $user->birthdate,
        ];
    }
}
