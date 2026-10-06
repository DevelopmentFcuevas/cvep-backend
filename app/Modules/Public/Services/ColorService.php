<?php
namespace App\Modules\Public\Services;

use App\Modules\Public\Models\Color;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * @author Francisco Cuevas
 * @description Servicio para la gestión de colores.
 * @category Public
 * @package App\Modules\Public\Services
 */
class ColorService
{
    public function getAllColores()
    {
        return Color::all();
    }

    public function getColorById($id)
    {
        return Color::find($id);
    }

    public function createColor(array $data)
    {
        try {
            Log::info('Ingreso a la funcion createColor de ColorService');
            Log::info('Data: ' . json_encode($data, JSON_PRETTY_PRINT));
            DB::beginTransaction();
            $color = Color::create($data);
            DB::commit();
            Log::info('Sale de la funcion createColor de ColorService');
            return $color;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creando color', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    public function updateColor($id, array $data)
    {
        try {
            DB::beginTransaction();
            $color = Color::find($id);
            $color->update($data);
            DB::commit();
            return $color;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error actualizando color', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    public function deleteColor($id)
    {
        try {
            DB::beginTransaction();
            $color = Color::find($id);
            $color->delete();
            DB::commit();
            return $color;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error eliminando color', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            throw $e;
        }
    }
}   
