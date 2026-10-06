<?php

namespace App\Modules\Inventory\Services;

use App\Modules\Inventory\Models\UnidadMedida;
use Illuminate\Support\Facades\DB;
use Exception;


/**
 * @author Francisco Cuevas
 * @description Servicio para la gestión de unidades de medida.
 * @category Inventory
 * @package App\Modules\Inventory\Services
 */

class UnidadMedidaService
{
    /**
     * @description Lista todas las unidades de medida.
     * @return \Illuminate\Database\Eloquent\Collection<int, UnidadMedida>
     */
    public function getAllUnitMeasures()
    {
        return UnidadMedida::all();
    }

    /**
     * @description Obtiene una unidad de medida por su ID.
     * @param int $id
     * @return \App\Modules\Inventory\Models\UnidadMedida
     */
    public function getUnitMeasureById($id)
    {
        return UnidadMedida::find($id);
    }

    /**
     * @description Crea una nueva unidad de medida.
     * @param array $data
     * @return \App\Modules\Inventory\Models\UnidadMedida
     */
    public function createUnitMeasure(array $data)
    {
        try {
            DB::beginTransaction();
            $unitMeasure = UnidadMedida::create($data);
            DB::commit();
            return $unitMeasure;
        } catch (\Exception $e) {
            //Log critico
            logger()->error('Error creando unidad de medida', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }

    /*
     * @description Actualiza una unidad de medida.
     * @param int $id
     * @param array $data
     * @return \App\Modules\Inventory\Models\UnidadMedida
    */
    public function updateUnitMeasure($id, $data)
    {
        try {
            DB::beginTransaction();
            $unitMeasure = UnidadMedida::find($id);
            $unitMeasure->update($data);
            DB::commit();
            return $unitMeasure;
        } catch (\Exception $e) {
            //Log critico
            logger()->error('Error actualizando unidad de medida', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }

    /**
     * @description Elimina una unidad de medida.
     * @param int $id
     * @return \App\Modules\Inventory\Models\UnidadMedida
     */
    public function deleteUnitMeasure($id)
    {
        try {
            DB::beginTransaction();
            $unitMeasure = UnidadMedida::find($id);
            $unitMeasure->estado = 'INACTIVO';
            $unitMeasure->save();
            $unitMeasure->delete();
            DB::commit();
            return $unitMeasure;
        } catch (\Exception $e) {
            //Log critico
            logger()->error('Error eliminando unidad de medida', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e;
        }
    }
    
}