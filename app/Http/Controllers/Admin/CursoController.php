<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Redirect;

class CursoController extends Controller
{
    public function exportPdf()
    {
        $cursos = Producto::get();
        $pdf = PDF::loadView('pdf.cursos', compact('cursos'));

        return $pdf->download('cursos-list.pdf');
    }

    public function index()
    {
        $cursos = Producto::latest()->paginate(8);
        return view('admin.curso.index', compact('cursos'));
    }


    public function create()
    {
        return view("admin.curso.create");
    }


    public function store(Request $request)
    {
        /* Validacion del Formulario */
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'costo' => 'required'
        ]);

        Producto::create([
            'CURSOC_Nombre' => request('nombre'),
            'CURSOC_Descripcion' => request('descripcion'),
            'CURSOC_Costo' => request('costo'),
        ]);

        return Redirect::to("/curso");

    }

    public function show($id)
    {
        $producto = Producto::find($id);
        $view = view('admin.curso.show', compact('producto'));
        $pdf = PDF::loadView('admin.curso.show', compact('producto'));
        return $pdf->download('reporte_de_curso.pdf');
    }

    public function edit($id)
    {
        $curso = Producto::findOrFail($id);
        return view("admin.curso.edit", ['curso' => $curso]);
    }


    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->CURSOC_Nombre = $request->nombre;
        $producto->CURSOC_Descripcion = $request->descripcion;
        $producto->CURSOC_Costo = $request->costo;
        $producto->save();
        return Redirect::to("/curso");
    }


    public function destroy($id)
    {
        Producto::destroy($id);
        return Redirect::to("/curso");
    }
}
