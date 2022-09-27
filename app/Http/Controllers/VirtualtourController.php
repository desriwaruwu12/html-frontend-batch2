<?php

namespace App\Http\Controllers;

use App\Models\Vtour;
use App\Models\Virtualtour;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VirtualtourController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get vtour
        $Virtualtour = Virtualtour::latest()->paginate(5);

        //render view with Virtualtour
        return view('virtualtour.index', compact('Virtualtour'));
    }
/**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('Virtualtour.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //    validate form
        // $this->validate($request, [
        // 'url_gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'nama_paket'     => 'required|min:5', 
        // 'tanggal_pelaksanaan' => 'required',
        // 'harga_paket' => 'required' ]);

        // upload image
        $image = $request->file('url_gambar');
        $image->storeAs('public/Virtualtour/', $image->hashName());

        //create post
        Virtualtour::create([
            'url_gambar'     => $image->hashName(),
            'paket'     => $request->nama_paket,
            'harga'   => $request->harga,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan
        ]);

        //redirect to index
        return redirect()->route('virtualtour.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function edit($id)
{   
    $vtour = Virtualtour::findOrfail($id);
    return view('Virtualtour.edit', compact('vtour'));
}

/**
 * update
 *
 * @param  mixed $request
 * @param  mixed $vtour
 * @return void
 */
    public function update(Request $request, $id)
{
    //die();
    //validate form
    // $this->validate($request, [
    //         'url_gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'nama_paket'     => 'required|min:5', 
    //         'tanggal_pelaksanaan' => 'required',
    //         'harga_paket' => 'required'   
    //   ]);
    //  
    $vtour=Virtualtour::find($id);
    // echo $vtour;die();
    //check if image is uploaded
    if ($request->hasFile('url_gambar')) {

        //upload new image
        $url_gambar = $request->file('url_gambar');
        $url_gambar->storeAs('public/Virtualtour/', $url_gambar->hashName());

        //delete old image
        Storage::delete('public/Virtualtour/'.$vtour->url_gambar);

        //update vtour with new image
        $vtour->update([
            'url_gambar' => $url_gambar->hashName(),
            'paket' => $request->nama_paket,
            'harga' => $request->harga,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan
        ]);

    } else {
 
        //update vtour without image
        try{
        // $vtour->update([
        //     'nama_paket' => $request->nama_paket,
        //     'harga' => $request->harga,
        //     'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan
        // ]);
        $vtour->paket=$request->nama_paket;
        $vtour->harga=$request->harga;
        $vtour->save();
        }
        catch(\Exception $e)
        {
            echo "success";
        echo $request->harga;
        print_r($vtour);
        echo $e;
        die();
        }
        
        }
    
    //  DB::commmit();
    //redirect to index
    return redirect()->route('virtualtour.index')->with(['success' => 'Data Berhasil Diubah!']);
}
public function destroy($id)
{

    $post = Virtualtour::FindOrFail($id);

    
    
    Storage::delete('public/virtualtour/'.$post->url_gambar);
    $post->delete();
    return redirect()->route('virtualtour.index')->with(['success' => 'Data Berhasil Dihapus!']);
}


}