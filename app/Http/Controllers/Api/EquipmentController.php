<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Equipment\Resource;
use Illuminate\Http\Request;
use App\Services\EquipmentServiceInterface;
use App\Http\Requests\Equipment\Store;
use App\Http\Requests\Equipment\Update;

class EquipmentController extends Controller
{
    private EquipmentServiceInterface $equipmentService;

    public function __construct(EquipmentServiceInterface $equipmentService)
    {
        $this->equipmentService = $equipmentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Equipment\Collection
     */
    public function index(Request $request)
    {
        return (new \App\Http\Resources\Equipment\Collection(
            $this
                ->equipmentService
                ->getEquipment(
                    $request
                        ->collect()
                        ->except('page')
                )
                ->paginate(10)
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Store $request
     * @return Resource
     */
    public function store(Store $request)
    {
        return (new Resource(
            $this
                ->equipmentService
                ->storeEquipmentItem($request)
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Resource
     */
    public function show($id)
    {
        return (new Resource(
            $this
                ->equipmentService
                ->getEquipmentItem($id)
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Update $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Update $request, $id)
    {
        return response()->json(
            (!$this
                ->equipmentService
                ->updateEquipmentItem($request, $id)
            )
                ? ['error' => 'Can`t update item.']
                : ['success' => 'Item with id #' . $id . ' updated.']
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return response()->json(
            (!$this
                ->equipmentService
                ->removeEquipmentItem($id)
            )
                ? ['error' => 'Can`t remove item.']
                : ['success' => 'Item with id #' . $id . ' removed.']
        );
    }
}
