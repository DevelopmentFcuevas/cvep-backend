<?php
namespace App\Modules\Public\Services;

use App\Modules\Public\Models\Pais;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * @author Francisco Cuevas
 * @description Servicio para la gestión de paises.
 * @category Public
 * @package App\Modules\Public\Services
 */
class PaisService
{
    public function getAllPaises()
    {
        return Pais::all();
    }

    public function getPaisById($id)
    {
        return Pais::find($id);
    }

    public function createPais(array $data)
    {
        try {
            Log::info('Ingreso a la funcion createPais de PaisService');
            Log::info('Data: ' . json_encode($data, JSON_PRETTY_PRINT));
            DB::beginTransaction();
            $pais = Pais::create($data);
            DB::commit();
            Log::info('Sale de la funcion createPais de PaisService');
            return $pais;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creando pais', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    public function updatePais($id, array $data)
    {
        try {
            DB::beginTransaction();
            $pais = Pais::find($id);
            $pais->update($data);
            DB::commit();
            return $pais;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error actualizando pais', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    public function deletePais($id)
    {
        try {
            DB::beginTransaction();
            $pais = Pais::find($id);
            $pais->delete();
            DB::commit();
            return $pais;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error eliminando pais', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            throw $e;
        }
    }
}   
