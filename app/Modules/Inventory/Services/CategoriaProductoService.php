<?php

namespace App\Modules\Inventory\Services;

use App\Modules\Inventory\Models\CategoriaProducto;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * @author Francisco Cuevas
 * @description Servicio para la gestión de familias de productos.
 * @category Inventory
 * @package App\Modules\Inventory\Services
 */

class CategoriaProductoService
{
    /**
     * @description Obtiene todas las familias de productos.
     * @return \Illuminate\Database\Eloquent\Collection<int, CategoriaProducto>
     */
    public function getAllProductFamilies()
    {
        return CategoriaProducto::all();
    }

    //public function getProductFamilyById($id)
    //{
    //    return CategoriaProducto::find($id);
    //}

    /**
     * @description Crea una nueva familia de productos.
     * @param array $data
     * @return \App\Modules\Inventory\Models\CategoriaProducto
     */
    public function createProductFamily(array $data)
    {
        //return CategoriaProducto::create($data);

        try {
            DB::beginTransaction();
            $productFamily = CategoriaProducto::create($data);
            DB::commit();
            return $productFamily;
        } catch (\Exception $e) {
            // Log crítico
            logger()->error('Error creando familia de producto', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }

    //public function updateProductFamily($id, $data)
    //{
    //    $productFamily = $this->getProductFamilyById($id);
    //    $productFamily->update($data);
    //    return $productFamily;
    //}

    //public function deleteProductFamily($id)
    //{   
    //    $productFamily = $this->getProductFamilyById($id);
    //    $productFamily->delete();
    //    return $productFamily;
    //}
    
}