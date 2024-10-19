<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $laptops = Laptop::where('name', 'LIKE', '%'.$request->search.'%')->orderBy('name','ASC')->simplePaginate(5);
          // compact : mengirim data ke blade : compact('namavariable')
        return view('laptops.index', compact('laptops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('laptops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required|min:5|max:15',
            'price' => 'required|numeric',
            'stock' => 'required',
        ], [
            'type.required' => 'Jenis mamin wajib diisi!',
            'name.required' => 'Nama mamin wajib diisi!',
            'price.required' => 'Harga mamin wajib diisi!',
            'price.numeric' => 'Harga mamin harus berupa angka!',
            'stock.required' => 'Jumlah stock wajib diisi!',
        ]);
        $proses = Laptop::create([
            'type' => $request->type,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        if ($proses) {
            return redirect()->route('laptops')->with('success', 'Data laptop berhasil ditambahkan');
        } else {
            return redirect()->route('laptops.add')->with('failed', 'Gagal menambahkan data laptop');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $laptop = Laptop::where('id', $id)->first();
        return view('laptops.edit', compact('laptop'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required|min:5|max:15',
            'price' => 'required|numeric',
            'stock' => 'required',
        ], [
            'type.required' => 'Jenis mamin wajib diisi!',
            'name.required' => 'Nama mamin wajib diisi!',
            'price.required' => 'Harga mamin wajib diisi!',
            'price.numeric' => 'Harga mamin harus berupa angka!',
            'stock.required' => 'Jumlah stock wajib diisi!',
        ]);
        // ambil data sebelumnya, ambil dr id yg dikirim route {id}
        $laptopBefore = Laptop::where('id', $id)->first();
        // cek isi input stock jangan lebih kecil dari stock yg uda ada sebelumnya
        if ((int)$request->stock < (int)$laptopBefore->stock) {
            return redirect()->back()->with('failed', 'Jumlah stock baru tidak boleh kurang dari jumlah sebelumnya!');
        }
        // kalau stok >= dari sebelumnya, data diupdate
        $proses = $laptopBefore->update([
            'type' => $request->type,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        if ($proses) {
            return redirect()->route('laptops')->with('success', 'Data laptop berhasil diubah!');
        } else {
            return redirect()->route('laptops.edit', $id)->with('failed', 'Gagal mengubah data mamin!');
        }
    }

       public function stockEdit(Request $request, $id)
    {
        if(!isset($request->stock)){
            return response()->json(['failed'=> 'Jumlah por tidak boleh kosong'], 400);
        }
        $laptop = Laptop::findOrFail($id);
        $laptop->update(['stock'=>$request->stock]);
        // $laptop->stock = $request->input('stock');
        // $laptop->save();

        return response()->json(['success' => 'Jumlah stock berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proses = Laptop::where('id', $id)->delete();
        if($proses) {
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        }else {
            return redirect()->back()->with('failed', 'Data berhasil dihapus');
        }
    }
}
