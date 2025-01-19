<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Contacto;
use App\Role;
use Illuminate\Http\Request;
use Redirect;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


$path_first = base_path('public_html/upload');
echo $path_first."<br>";
// Path to the 'application' folder    
$path_second = app_path();  
echo $path_second."<br>";
// Path to the 'public' folder    
$path_third = public_path();
echo $path_third."<br>";
// Path to the 'storage' folder    
$path_fourth = storage_path();
echo $path_fourth."<br>";
// Path to the 'storage/app' folder    
$path_fifth = storage_path('app');
echo $path_fifth."<br>";
die;

        $contactos = Contacto::all();
        return view('admin.contacto.index',compact('contactos'));
    }

    public function list(){
        $contactos = Contacto::join('solicitante','solicitante.SOLIP_Codigo','=','contacto.SOLIP_Codigo')->select()->get();
        return $contactos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contacto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Contacto::create([
            'SOLIP_Codigo'     => $request->solicitante,
            'nombre_contacto'  => $request->nombres,
            'correo_contacto'  => $request->correo,
            'celular_contacto' => $request->celular
        ]);
        return Redirect::to("/contacto");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contacto = Contacto::findOrFail($id);
        return view("admin.contacto.edit", ['contacto' => $contacto]);
    }

    public function get($id){
        return Contacto::findOrFail($id);
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->SOLIP_Codigo     = $request->solicitante;
        $contacto->nombre_contacto  = $request->nombre;
        $contacto->correo_contacto  = $request->correo;
        $contacto->celular_contacto = $request->celular;
        $contacto->save();
        return Redirect::to("/contacto");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contacto::destroy($id);
        return response()->json(['message'=>'Contacto borrado']);
    }
}
