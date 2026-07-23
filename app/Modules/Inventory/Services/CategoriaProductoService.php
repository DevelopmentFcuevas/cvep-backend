<?php

namespace App\Modules\Inventory\Services;

use App\Modules\Inventory\Models\CategoriaProducto;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * @author Francisco Cuevas
 * @description Servicio para la gestión de categorías de productos.
 * @category Inventory
 * @package App\Modules\Inventory\Services
 */

class CategoriaProductoService
{
    /**
     * @description Obtiene todas las categorías de productos.
     * @return \Illuminate\Database\Eloquent\Collection<int, CategoriaProducto>
     */
    public function getAllProductCategories()
    {
        return CategoriaProducto::all();
    }

    /**
     * @description Obtiene una categoría de producto por su ID.
     * @param int $id
     * @return \App\Modules\Inventory\Models\CategoriaProducto
     */
    public function getProductCategoryById($id)
    {
        return CategoriaProducto::find($id);
    }

    /**
     * @description Crea una nueva categoría de producto.
     * @param array $data
     * @return \App\Modules\Inventory\Models\CategoriaProducto
     */
    public function createProductCategory(array $data)
    {
        try {
            DB::beginTransaction();
            $productCategory = CategoriaProducto::create($data);
            DB::commit();
            return $productCategory;
        } catch (\Exception $e) {
            // Log crítico
            logger()->error('Error creando categoría de producto', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }

    /**
     * @description Actualiza una categoría de producto.
     * @param int $id
     * @param array $data
     * @return \App\Modules\Inventory\Models\CategoriaProducto
     */
    public function updateProductCategory($id, $data)
    {
        try {
            DB::beginTransaction();
            $productCategory = CategoriaProducto::find($id);
            $productCategory->update($data);
            DB::commit();
            return $productCategory;
        } catch (\Exception $e) {
            // Log crítico
            logger()->error('Error actualizando categoría de producto', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }

    /**
     * @description Elimina una categoría de producto.
     * @param int $id
     * @return \App\Modules\Inventory\Models\CategoriaProducto
     */
    public function deleteProductCategory($id)
    {
        try {
            DB::beginTransaction();
            $productCategory = CategoriaProducto::find($id);
            $productCategory->estado = 'INACTIVO';
            $productCategory->save();
            $productCategory->delete();
            DB::commit();
            return $productCategory;
        } catch (\Exception $e) {
            // Log crítico
            logger()->error('Error eliminando categoria de producto', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);

            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }
    
}