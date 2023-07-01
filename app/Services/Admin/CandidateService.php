<?php

namespace App\Services\Admin;

use App\Constants\Paginate;
use App\Http\Requests\Admin\UpdateCandidateRequest;
use App\Models\Candidate;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CandidateService
{
    public function getById(int $id)
    {
        return Candidate::query()
                    ->with(['resume' => function($q) {
                        $q->withTrashed();
                    }])
                    ->withTrashed()
                    ->findOrFail($id);
    }

    public function update(Candidate $user, UpdateCandidateRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only('firstname', 'lastname', 'email');
            $user->update($data);
            $user->resume()->update($request->only('phone'));

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR_UPDATE_CANDIDATE: " . $e->getMessage());
            return false;
        }
    }

    public function filter(array $data)
    {
        $query = Candidate::query()
                    ->with(['resume' => function($q) {
                        $q->withTrashed();
                    }])
                    ->when(isset($data['email']), function ($q) use ($data) {
                        $q->where('email', 'like', '%' . $data['email'] . '%');
                    })
                    ->when(isset($data['sex']), function ($q) use ($data) {
                        $q->whereHas('resume', function($q) use ($data) {
                            $q->where('sex', $data['sex']);
                        });
                    })
                    ->when(isset($data['age_from']) && $data['age_from'] != 0, function ($q) use ($data) {
                        $q->whereHas('resume', function($q) use ($data) {
                            $q->where('age', '>=', $data['age_from']);
                        });
                    })
                    ->when(isset($data['age_to']) && $data['age_to'] != 100, function ($q) use ($data) {
                        $q->whereHas('resume', function($q) use ($data) {
                            $q->where('age', '<=', $data['age_to']);
                        });
                    })
                    ->orderByDesc('id')
                    ->withTrashed();
        if (!empty($data['key'])) {
            $this->filterKey($query, $data['key']);
        }

        return $query->paginate(Paginate::PER_PAGE_10)
                    ->withQueryString();
    }

    public function filterKey(&$query, string $key)
    {
        $query->where(function ($q) use ($key) {
            $q->where('id', 'like', "%$key%")
                ->orWhere('name', 'like', "%$key%");
        });
    }

    public function delete(int $id)
    {
        try {
            $user = Candidate::query()->where('id', $id)->first();

            if ($user) {
                $user->update(['status' => Candidate::$status['unactive']]);
                $user->delete();
            }

            return true;
        } catch(Exception $e) {
            Log::error("DELETE_USER_ACCOUNT_ERROR: " . $e->getMessage());

            return false;
        }
    }

    public function restore(int $id)
    {
        try {
            $user = Candidate::query()->withTrashed()->where('id', $id)->first();

            if ($user) {
                $user->update([
                    'status' => Candidate::$status['active'],
                    'deleted_at' => null,
                ]);
            }

            return true;
        } catch(Exception $e) {
            Log::error("RESTORE_USER_ACCOUNT_ERROR: " . $e->getMessage());

            return false;
        }
    }
}
