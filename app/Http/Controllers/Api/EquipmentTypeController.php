<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\EquipmentTypeServiceInterface;

class EquipmentTypeController extends Controller
{
    private EquipmentTypeServiceInterface $equipmentTypeService;

    public function __construct(EquipmentTypeServiceInterface $equipmentTypeService)
    {
        $this->equipmentTypeService = $equipmentTypeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\EquipmentType\Collection
     */
    public function index(Request $request)
    {
        return (new \App\Http\Resources\EquipmentType\Collection(
            $this
                ->equipmentTypeService
                ->getEquipmentType(
                    $request
                        ->collect()
                        ->except('page')
                )
                ->paginate(10)
        ));
    }
}
