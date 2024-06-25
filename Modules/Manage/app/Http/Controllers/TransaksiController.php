<?php

namespace Modules\Manage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Manage\Models\MTabungTab;
use Modules\Manage\Models\TTabungTab;

class TransaksiController extends Controller
{
    protected $controller;
    protected $mTabungTab;
    protected $tTabungTab;
    public function __construct(
        Controller $controller, 
        MTabungTab $mTabungTab,
        TTabungTab $tTabungTab
    ) {
        $this->controller = $controller;
        $this->mTabungTab = $mTabungTab;
        $this->tTabungTab = $tTabungTab;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manage::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->controller->validasi($request, [
            'condition' => 'required',
            'type_transaction' => 'required',
            'no_po' => 'required',
            'surat_jalan' => 'required',
            'm_type_tabs_id' => 'required',
            'sender' => 'required',
            'receiver' => 'required',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->tabung as $value) { // looping input tabung yang banyak itu
                $findTabung = $this->mTabungTab->where('code', $value->code)->first(); // cari udah exist belum ?
                if(!isset($findTabung)) { // tambah ke master code kalau belum exist
                    $tabung = $this->mTabungTab->create([
                        'code' => $value->code
                    ]);
                }
                // tambahkan transaksi tabung
                $this->tTabungTab->create([
                    'm_tabung_tabs_id' => $tabung->id,
                    'type_transaction' => $tabung->type_transaction,
                    'condition' => $tabung->condition,
                    'no_po' => $tabung->no_po,
                    'surat_jalan' => $tabung->surat_jalan,
                    'm_type_tabs_id' => $tabung->m_type_tabs_id,
                    'sender' => $tabung->sender,
                    'receiver' => $tabung->receiver,
                    'm_user_access_tabs_id' => auth()->user()->id,
                ]);
            }
            DB::commit();
            return $this->controller->success('TRANSAKSI ADD', null);
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(500, $th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('manage::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('manage::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->tTabungTab->where('id', $id)->update($request->all());
            DB::commit();
            return $this->controller->success('TRANSAKSI UPDATE', null);
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(500, $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->tTabungTab->where('id', $id)->delete();
            DB::commit();
            return $this->controller->success('TRANSAKSI DELETE', null);
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(500, $th->getMessage());
        }
    }
}
