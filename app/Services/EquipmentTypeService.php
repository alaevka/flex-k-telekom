<?php

namespace App\Services;

use App\Services\EquipmentTypeServiceInterface;
use Illuminate\Support\Collection;
use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Builder;

class EquipmentTypeService implements EquipmentTypeServiceInterface
{

    /**
     * Get equipment Builder depends on input params.
     *
     * @param Collection $input
     * @return Builder
     */
    public function getEquipmentType(Collection $input): Builder
    {
        $sortField = 'id';
        $sortDirection = 'asc';
        $equipment = EquipmentType::where(function ($query) use ($input) {
            if ($input->isNotEmpty()) {
                $input->each(function ($item, $key) use ($query) {
                    $query->where($key, 'like', '%' . $item . '%');
                });
            }
        })
            ->orderBy($sortField, $sortDirection);
        return $equipment;
    }
}
