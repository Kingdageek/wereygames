<?php

namespace App\Http\Controllers\Admin;

use App\Models\Wereyimage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ProcessesImages;

class WereyimageController extends Controller
{
    use ProcessesImages;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wereyimages = Wereyimage::orderBy('id', 'DESC')->paginate(10);
        return view('admin.wereyimage.index', compact('wereyimages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wereyimage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateAndSaveImage($request, (new Wereyimage()));

        return redirect()->route('admin.wereyimages.index')
                    ->with('success', 'Wereyimage created successfully');
    }

    private function validateAndSaveImage(Request $request, Wereyimage $wereyimage)
    {
        $this->validate($request, [
            'image' => 'image'
        ]);

        $wereyimage->path = $this->getImagePath($request->image, 'wereyimages');
        $wereyimage->save();

        return array(
            'id' => $wereyimage->id,
            'imageUrl' => asset($wereyimage->path)
        );
    }


    public function process(Request $request)
    {
        return response()->json(
            $this->validateAndSaveImage($request, (new Wereyimage()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WereyImage  $wereyImage
     * @return \Illuminate\Http\Response
     */
    public function show(WereyImage $wereyImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WereyImage  $wereyImage
     * @return \Illuminate\Http\Response
     */
    public function edit(Wereyimage $wereyimage)
    {
        return view('admin.wereyimage.edit', compact('wereyimage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WereyImage  $wereyImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wereyimage $wereyimage)
    {
        $oldImagePath = $wereyimage->path;
        $this->validateAndSaveImage($request, $wereyimage);

        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        return redirect()->route('admin.wereyimages.index')
                    ->with('success', 'Wereyimage successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WereyImage  $wereyImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wereyimage $wereyimage)
    {
        $oldImagePath = $wereyimage->path;
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        $wereyimage->delete();

        return redirect()->route('admin.wereyimages.index')
                    ->with('success', 'Wereyimage successfully deleted');
    }
}
