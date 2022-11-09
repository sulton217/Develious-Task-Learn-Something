<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokBarang; 
class StokBarangController extends Controller
{
    //
    public function index()
    {
        $stokbarang = StokBarang::latest()->get();
        return view('stokbarang.index', compact('stokbarang'));
    }

    public function create()
    {
        return view('stokbarang.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'kodebarang' => 'required|integer'
        ]);

        $stokbarang = StokBarang::create([
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'kodebarang' => $request->kodebarang
        ]);


        if ($stokbarang) { 
            return redirect()
                ->route('stokbarang.index')
                ->with([
                    'success' => 'New stokbarang has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    public function edit($id)
    {
        $stokbarang = StokBarang::findOrFail($id);
        return view('stokbarang.edit', compact('stokbarang'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'jumlah' => 'required',
            'kodebarang' => 'required'
        ]);

        $stokbarang = StokBarang::findOrFail($id);

        $stokbarang->update([
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'kodebarang' => $request->kodebarang
        ]);

        if ($stokbarang) {
            return redirect()
                ->route('stokbarang.index')
                ->with([
                    'success' => 'stokbarang has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
                ]);
        }
    }


    public function destroy($id)
    {
        $stokbarang = StokBarang::findOrFail($id);
        $stokbarang->delete();

        if ($stokbarang) {
            return redirect()
                ->route('stokbarang.index')
                ->with([
                    'success' => 'stokbarang has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('stokbarang.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }


}
