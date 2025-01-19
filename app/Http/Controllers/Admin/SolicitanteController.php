<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Solicitante;
use App\TipoSolicitante;
use Illuminate\Http\Request;
use Redirect;

class SolicitanteController extends Controller
{	
    public function index()
    {
        //$solicitantes = Solicitante::latest()->paginate(8);

        $solicitantes = Solicitante::join('tiposolicitante','tiposolicitante.TIPSOLIP_Codigo','=','solicitante.TIPSOLIP_Codigo')->select()->get();

        return view('admin.solicitante.index',compact('solicitantes'));
    }

    public function list(){
        return Solicitante::all();
    }
    
    public function create(){
        $tiposolicitante = TipoSolicitante::pluck('TIPSOLIC_Descripcion', 'TIPSOLIP_Codigo');
        return view('admin.solicitante.create',compact('tiposolicitante'));
    }
    
    public function store(Request $request){

        /* Validacion del Formulario */
        $request->validate([
            'tipo' => 'required',
            'ubigeo' => 'required',
            'nombre' => 'required',
            'ruc' => 'required',
            'direccion' => 'required',
            'email' => 'required|email',
            'telefono' => 'required'
        ]);

        Solicitante::create([
            'TIPSOLIP_Codigo'  => request('tipo'),
            'UBIGP_Codigo'     => request('ubigeo'),
            'SOLIC_Nombre'     => request('nombre'),
            'SOLIC_Ruc'        => request('ruc'),
            'SOLIC_Direccion'  => request('direccion'),
            'SOLIC_Telefono'   => request('telefono'),
            'SOLIC_Email'      => request('email'),
            'SOLIC_FlagEstado' => request('estado'),
            'SOLIC_Contacto'   => request('contacto')
        ]);
        return Redirect::to("/solicitante");
    }
    
    public function edit($id){
        $tiposolicitante = TipoSolicitante::pluck('TIPSOLIC_Descripcion', 'TIPSOLIP_Codigo');        
        $solicitante = Solicitante::findOrFail($id);
        return view("admin.solicitante.edit",['solicitante' => $solicitante,'tiposolicitante'=>$tiposolicitante]);
    }
    
    public function update(Request $request,$id){
        $solicitante = Solicitante::findOrFail($id);
        $solicitante->TIPSOLIP_Codigo = $request->tipo;
        $solicitante->UBIGP_Codigo    = $request->ubigeo;
        $solicitante->SOLIC_Nombre    = $request->nombre;
        $solicitante->SOLIC_Ruc       = $request->ruc;
        $solicitante->SOLIC_Direccion = $request->direccion;
        $solicitante->SOLIC_Telefono  = $request->telefono;
        $solicitante->SOLIC_Email     = $request->email;
        $solicitante->SOLIC_Contacto  = $request->contacto;
        $solicitante->save();
        return redirect::to('/solicitante');
    }
    
    public function destroy($id){
        Solicitante::destroy($id);
        return Redirect::to("/solicitante");
    }
}
