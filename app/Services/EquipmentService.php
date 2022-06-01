<?php

namespace App\Services;

use App\Http\Requests\Equipment\Store;
use App\Http\Requests\Equipment\Update;
use App\Services\EquipmentServiceInterface;
use Illuminate\Support\Collection;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Builder;
use Throwable;
use Exception;

class EquipmentService implements EquipmentServiceInterface
{

    /**
     * Get equipment Builder depends on input params.
     *
     * @param Collection $input
     * @return Builder
     */
    public function getEquipment(Collection $input): Builder
    {
        $sortField = 'id';
        $sortDirection = 'asc';
        $equipment = Equipment::where(function ($query) use ($input) {
            if ($input->isNotEmpty()) {
                $input->each(function ($item, $key) use ($query) {
                    $query->where($key, 'like', '%' . $item . '%');
                });
            }
        })
            ->orderBy($sortField, $sortDirection)
        ;
        return $equipment;
    }

    public function getEquipmentItem(int $id): \App\Models\Equipment
    {
        return Equipment::findOrFail($id);
    }

    /**
     * Remove equipment item.
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function removeEquipmentItem(int $id): bool
    {
        $res = false;
        try {
            $equipment = Equipment::findOrFail($id);
            if ($equipment->delete())
                $res = true;
        } catch (Throwable $exception) {
            throw new Exception($exception->getMessage());
        }
        return $res;
    }

    /**
     * Store equipment item.
     *
     * @param Store $request
     * @return Equipment
     * @throws Exception
     */
    public function storeEquipmentItem(Store $request): Equipment
    {

        $equipment = new Equipment;
        $equipment->equipment_type_code = $request->typeId;
        $equipment->serial_number = $request->input('serial_number');
        $equipment->comment = $request->input('comment');
        try {
            $equipment->save();
            return $equipment;
        } catch (Throwable $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function updateEquipmentItem(Update $request, $id): bool
    {
        $res = false;
        try {
            $equipment = Equipment::findOrFail($id);
            if ($equipment) {
                $equipment->equipment_type_code = $request->typeId;
                $equipment->serial_number = $request->input('serial_number');
                $equipment->comment = $request->input('comment');
                $equipment->save();
                $res = true;
            }
        } catch (Throwable $exception) {
            throw new Exception($exception->getMessage());
        }
        return $res;
    }
}
