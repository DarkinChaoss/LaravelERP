<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use DB;

class ControladorPedido extends Controller
{
    public function indexView()
    {
        return view('pedido');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ped = new Pedido();
        $ped->cliente_id = $request->input('idCliente');
        $ped->valor_total = $request->input('valort');
        $ped->desconto = $request->input('desconto');
        $ped->save();
        $id = DB::table('pedidos')->find(\DB::table('pedidos')->max('id'));
        return json_encode($id);
    }

    public function show($id)
    {
        $ped = Pedido::find($id);
        if (isset($ped)) {
            return json_encode($ped);            
        }
        return response('receber não encontrado', 404);
    }

}
