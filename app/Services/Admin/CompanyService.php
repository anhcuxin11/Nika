<?php

namespace App\Services\Admin;

use App\Constants\Paginate;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Models\Candidate;
use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyService
{
    public function getById(int $id)
    {
        return Company::query()
                    ->withTrashed()
                    ->findOrFail($id);
    }

    public function filter(array $data)
    {
        $query = Company::query()
                    ->when(isset($data['name']), function ($q) use ($data) {
                        $q->where('name', 'like', '%' . $data['name'] . '%');
                    })
                    ->when(isset($data['address']), function ($q) use ($data) {
                        $q->where('address', 'like', '%' . $data['address'] . '%');
                    })
                    ->when(isset($data['status']), function ($q) use ($data) {
                        $q->where('status', $data['status']);
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
                ->orWhere('name_person', 'like', "%$key%")
                ->orWhere('email_company', 'like', "%$key%");
        });
    }

    public function delete(int $id)
    {
        try {
            $company = Company::query()->where('id', $id)->first();

            if ($company) {
                $company->update(['status' => Company::$status['blacklist']]);
                $company->delete();
            }

            return true;
        } catch(Exception $e) {
            Log::error("DELETE_COMPANY_ACCOUNT_ERROR: " . $e->getMessage());

            return false;
        }
    }

    public function restore(int $id)
    {
        try {
            $company = Company::query()->withTrashed()->where('id', $id)->first();

            if ($company) {
                $company->update([
                    'status' => Company::$status['active'],
                    'deleted_at' => null,
                ]);
            }

            return true;
        } catch(Exception $e) {
            Log::error("RESTORE_COMPANY_ACCOUNT_ERROR: " . $e->getMessage());

            return false;
        }
    }

    public function update(Company $company, UpdateCompanyRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only('name', 'name_person', 'email_company', 'phone_company', 'fax_company', 'address');
            $company->update($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR_UPDATE_COMPANY: " . $e->getMessage());
            return false;
        }
    }
}
