<?php

namespace App\Http\Controllers;

use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CrudController extends Controller
{
    public function index() {

        $data = DB::select("select * from productos");        
        return View("welcome")->with("data", $data);

    }

    public function create(Request $request) {
        try {
            $sql = DB::insert('insert into productos (nombre, cantidad, precio) values (?, ?, ?)', [
                $request->txtnombre, $request->txtcantidad, $request->txtprecio
            ]);

            if($sql==0){
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        $ok = "Registro ingresado correctamente";
        $nok = "No se puedo guradar el registro";
        return $sql == true ? back()->with("correcto", $ok) : back()->with("incorrecto", $nok);
    }

    public function update(Request $request) {
        try {
            $sql = DB::update('update productos set nombre=?, cantidad=?, precio=? where id=?', [
                $request->txtnombre, 
                $request->txtcantidad, 
                $request->txtprecio,
                $request->txtid
            ]);

            if($sql==0){
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        $ok = "Registro actualizado correctamente";
        $nok = "No se puedo actualizar el registro";
        return $sql == true ? back()->with("correcto", $ok) : back()->with("incorrecto", $nok);
    }

    public function delete($id){
        $ok = "Registro eliminado correctamente";
        $nok = "No se puedo eliminar el registro";
        try {
            $sql = DB::delete(" delete from productos where id=$id");

            if($sql == 0){
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;                             
            $nok = "Error: $th";
        }
        return $sql == true ? back()->with("correcto", $ok) : back()->with("incorrecto", $nok);
    }
}
