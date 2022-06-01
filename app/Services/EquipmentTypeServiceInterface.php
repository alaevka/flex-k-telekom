<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

interface EquipmentTypeServiceInterface {

    public function getEquipmentType(Collection $input): Builder;

}
