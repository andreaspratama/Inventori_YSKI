<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asets;
use App\Models\Type;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AsetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Asets::query();

            // foreach ($query as $item) {
            //     $item->barcode = DNS2D::getBarcodeHTML("$item->barcode", 'QRCODE');
            // }

            // dd($query);

            return Datatables::of($query)
                ->addColumn('aksi', function($item) {
                    return '
                        <a href="' . route('asets.edit', $item->id) . '" class="btn btn-warning btn-sm">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm delete" data-id="'. $item->id .'">
                            <i class="fa fa-fw fa-times"></i>
                        </a>
                    ';
                })
                ->addColumn('barcode', function($item) {
                    return \DNS2D::getBarcodePNGPath($item->barcode, 'QRCODE');
                })
                ->addColumn('type_id', function($item) {
                    return $item->type->nama;
                })
                ->addColumn('number', function($item) {
                    static $count = 0;
                    return ++$count;
                })
                ->rawColumns(['aksi', 'type_id', 'number', 'barcode'])
                ->make();
        }

        return view('pages.admin.asets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = Type::all();

        return view('pages.admin.asets.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['barcode'] = $request->nama;
        Asets::create($data);

        return redirect()->route('asets.index')->with('success', 'Data Berhasil Ditambahkan');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
