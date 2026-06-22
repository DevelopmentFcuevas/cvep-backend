<?php

namespace App\Modules\Inventory\Services;

use App\Modules\Inventory\Models\ProductFamily;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * @author Francisco Cuevas
 * @description Servicio para la gestión de familias de productos.
 * @category Inventory
 * @package App\Modules\Inventory\Services
 */

class ProductFamilyService
{
    /**
     * @description Obtiene todas las familias de productos.
     * @return \Illuminate\Database\Eloquent\Collection<int, ProductFamily>
     */
    public function getAllProductFamilies()
    {
        return ProductFamily::all();
    }

    //public function getProductFamilyById($id)
    //{
    //    return ProductFamily::find($id);
    //}

    /**
     * @description Crea una nueva familia de productos.
     * @param array $data
     * @return \App\Modules\Inventory\Models\ProductFamily
     */
    public function createProductFamily(array $data)
    {
        //return ProductFamily::create($data);

        try {
            DB::beginTransaction();
            $productFamily = ProductFamily::create($data);
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