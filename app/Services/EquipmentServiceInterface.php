<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\Equipment\Store;
use App\Http\Requests\Equipment\Update;
use App\Models\Equipment;

interface EquipmentServiceInterface {

    public function getEquipment(Collection $input): Builder;

    public function getEquipmentItem(Int $id): Equipment;

    public function removeEquipmentItem(Int $id): bool;

    public function storeEquipmentItem(Store $request): Equipment;

    public function updateEquipmentItem(Update $request, $id): bool;

}
