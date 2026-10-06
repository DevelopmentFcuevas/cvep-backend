<?php

namespace App\Modules\Inventory\Services;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Modules\Inventory\Models\Product;

/**
 * @author Francisco Cuevas
 * @description Servicio para la gestión de productos.
 * @category Inventory
 * @package App\Modules\Inventory\Services
 */

class ProductoService
{
    /**
     * @description Obtiene todos los productos.
     * @return \Illuminate\Database\Eloquent\Collection<int, Product>
     */
    public function getAllProductos()
    {
        return Product::all();
    }

    /**
     * @description Obtiene un producto por su ID.
     * @param int $id
     * @return \App\Modules\Inventory\Models\Product
     */
    public function getProductoById($id)
    {
        return Product::find($id);
    }

    /**
     * @description Crea un nuevo producto.
     * @param array $data
     * @return \App\Modules\Inventory\Models\Product
     */
    public function createProducto(array $data)
    {
        try {
            Log::info('Ingreso a la funcion createProducto de ProductoService');
            Log::info('Data: ' . json_encode($data, JSON_PRETTY_PRINT));
            DB::beginTransaction();
            $product = Product::create($data);
            DB::commit();
            Log::info('Sale de la funcion createProducto de ProductoService');
            return $product;
            
        } catch (\Exception $e) {
            // Log crítico
            logger()->error('Error creando producto', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }

    /**
     * @description Actualiza un producto.
     * @param int $id
     * @param array $data
     * @return \App\Modules\Inventory\Models\Product
     */
    public function updateProducto($id, $data)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($id);
            $product->update($data);
            DB::commit();
            return $product;
        } catch (\Exception $e) {
            // Log crítico
            logger()->error('Error actualizando producto', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }

    /**
     * @description Elimina un producto.
     * @param int $id
     * @return \App\Modules\Inventory\Models\Product
     */
    public function deleteProducto($id)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($id);
            $product->estado = 'INACTIVO';
            $product->save();
            $product->delete();
            DB::commit();
            return $product;
        } catch (\Exception $e) {
            // Log crítico
            logger()->error('Error eliminando producto', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);

            // Re-lanzar la excepción para que el controlador pueda manejarla
            DB::rollBack();
            throw $e; // dejamos que Laravel lo maneje
        }
    }
    
}