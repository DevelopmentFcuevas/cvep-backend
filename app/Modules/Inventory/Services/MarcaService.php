<?php

namespace App\Modules\Inventory\Services;

use App\Modules\Inventory\Models\Marca;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * @author Francisco Cuevas
 * @description Servicio para la gestión de marcas.
 * @category Inventory
 * @package App\Modules\Inventory\Services
 */

class MarcaService
{
    /**
     * @description Obtiene todas las marcas.
     * @return \Illuminate\Database\Eloquent\Collection<int, Marca>
     */
    public function getAllMarcas()
    {
        return Marca::all();
    }

    /**
     * @description Obtiene una marca por su ID.
     * @param int $id
     * @return \App\Modules\Inventory\Models\Marca
     */
    public function getMarcaById($id)
    {
        return Marca::find($id);
    }

    /**
     * @description Crea una nueva marca.
     * @param array $data
     * @return \App\Modules\Inventory\Models\Marca
     * onlyTrashed: busca registros eliminados suavemente
     * restore: restaura el registro eliminado suavemente
     * update: actualiza el registro
     * create: crea el registro
     * 
     */
    public function createMarca(array $data)
    {
        try {
            Log::info('Ingreso a la funcion createMarca de MarcaService');
            Log::info('Data: ' . json_encode($data, JSON_PRETTY_PRINT));
            DB::beginTransaction();

            // Buscar si existe un registro previamente eliminado suavemente con el mismo nombre
            $trashedMarca = Marca::onlyTrashed()->where('nombre', $data['nombre'])->first();

            if ($trashedMarca) {
                $trashedMarca->restore();
                $data['estado'] = $data['estado'] ?? 'ACTIVO';
                $trashedMarca->update($data);
                $marca = $trashedMarca;
            } else {
                $marca = Marca::create($data);
            }

            DB::commit();
            Log::info('Sale de la funcion createMarca de MarcaService');
            return $marca;
            
        } catch (\Exception $e) {
            // Log crítico
            logger()->error('Error creando marca', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }

    /**
     * @description Actualiza una marca.
     * @param int $id
     * @param array $data
     * @return \App\Modules\Inventory\Models\Marca
     */
    public function updateMarca($id, $data)
    {
        try {
            DB::beginTransaction();
            $marca = Marca::find($id);
            if ($marca) {
                $marca->update($data);
            }
            DB::commit();
            return $marca;
        } catch (\Exception $e) {
            // Log crítico
            logger()->error('Error actualizando marca', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }

    /**
     * @description Elimina una marca.
     * @param int $id
     * @return \App\Modules\Inventory\Models\Marca
     */
    public function deleteMarca($id)
    {
        try {
            DB::beginTransaction();
            $marca = Marca::find($id);
            if ($marca) {
                $marca->estado = 'INACTIVO';
                $marca->save();
                $marca->delete();
            }
            DB::commit();
            return $marca;
        } catch (\Exception $e) {
            // Log crítico
            logger()->error('Error eliminando marca', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);

            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }
    
}