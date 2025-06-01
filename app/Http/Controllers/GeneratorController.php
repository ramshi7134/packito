<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PackageGenerator;

class GeneratorController extends Controller
{
    public function index()
    {
        return view('generator.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'module_name' => 'required|string|alpha_dash',
            'sql' => 'required|string',
        ]);

        $moduleName = ucfirst($request->module_name);
        $createQuery = $request->sql;

        $zipPath = app(PackageGenerator::class)->generate($moduleName, $createQuery);

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
