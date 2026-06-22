<?php

namespace App\Modules\People\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\People\Models\Proveedor;
use App\Modules\People\Models\Persona;
use App\Modules\People\Requests\StoreProveedorRequest;
use App\Modules\People\Requests\UpdateProveedorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * Controlador para gestionar proveedores.
 */

class ProveedorController extends Controller
{
    public function index()
    {
        //$proveedor = Proveedor::all();
        //return response()->json($proveedor);

        return Proveedor::with('persona')->get();
    }
    
    /**
     * Cuando se crea un Proveedor se debe:
     * 1. Crear Persona.
     * 2. Crear Proveedor con ese ID
     * 3. Crear Teléfono.
     * 4. Crear Correo.
     * 5. Crear Contacto.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // 1. Crear Persona.
            $persona = Persona::create([
                'nombre_razon_social' => $request->nombre_razon_social,
                'ruc' => $request->ruc,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'descripcion_ubicacion' => $request->descripcion_ubicacion,
            ]);

            // 2. Crear Proveedor con ese ID
            $proveedor = Proveedor::create([
                'persona_id' => $persona->id
            ]);

            // 3. Crear Teléfono.
            //$telefono = Telefono::create([
            //    'persona_id' => $persona->id,
            //    'numero' => $request->numero,
            //    'tipo' => $request->tipo,
            //]);

            // 4. Crear Correo.
            //$correo = Correo::create([
            //    'persona_id' => $persona->id,
            //    'correo' => $request->correo,
            //]);

            // 5. Crear Contacto.
            //$contacto = Contacto::create([
            //    'persona_id' => $persona->id,
            //    'nombre' => $request->nombre,
            //    'cargo' => $request->cargo,
            //]);

            DB::commit();

            return response()->json($proveedor->load('persona'), 201);
            
        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al crear el proveedor',
                'error' => $e->getMessage()
            ], 500);
        }
        
    }

    public function show($id)
    {
        //$proveedor = Proveedor::findOrFail($id);
        //return response()->json($proveedor);

        $proveedor = Proveedor::with('persona')
            ->where('persona_id', $id)
            ->findOrFail($id);
        return response()->json($proveedor);
    }

    public function update(UpdateProveedorRequest $request, $id)
    {
        //$data = $request->validated();
        //$proveedor = Proveedor::findOrFail($id);
        //$proveedor->update($data);
        //return response()->json($proveedor, 200);

        $data = $request->validated();
        $proveedor = Proveedor::where('persona_id', $id)->firstOrFail();
        $proveedor->persona->update($data);
        return response()->json($proveedor->load('persona'), 200);
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::where('persona_id', $id)->firstOrFail();
        $proveedor->delete();
        //return response()->json($proveedor, 200);
        return response()->json(['message' => 'Proveedor eliminado correctamente'], 200);
    }

}