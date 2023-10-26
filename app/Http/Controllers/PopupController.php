<?php

namespace App\Http\Controllers;

use App\Models\Popup;
use App\Http\Requests\PopupRequest;
use App\Models\PopupMetadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return view(
            'home',
            [
                'popups' => Popup::paginate(5),
                'metadata' => PopupMetadata::all(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Popup $popup
     *
     * @return mixed
     */
    public function create(Popup $popup)
    {
        return view(
            'create',
            [
                'popup' => $popup
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\PopupRequest $request
     *
     *
     */
    public function store(PopupRequest $request, Popup $popup, GeneratorController $generator)
    {
        $request->validated();
        $popup->fill($request->all())->save();
        $path = $generator->makePreloader($popup);
        $popup->popupmetadata()->create(['link' => url("storage/$path/gp-preloader.js"), 'path' => $path]);
        $generator->makeScript($popup, $path);

        return redirect()->route('popup.show', $popup->id)->withSuccess('Высплюыващее окно добалвено!');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     */
    public function show($id)
    {
        $popup = Popup::find($id);

        return view('show')->with('popup', $popup);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Popup $popup
     *
     */
    public function edit(Popup $popup)
    {
        return view(
            'create',
            [
                'popup' => $popup,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\PopupRequest $request
     * @param \App\Models\Popup               $popup
     *
     *
     */
    public function update(PopupRequest $request, Popup $popup, GeneratorController $generator)
    {
        $request->validated();
        $popup->is_enabled = $request->is_enabled ?? 0;
        $popup->fill($request->all())->save();
        $path = $popup->popupmetadata()->first()->path;
        $generator->deleteScript($path);
        $generator->makeScript($popup, $path);

        return redirect()->route('popup.show', $popup->id)->withSuccess('Высплюыващее окно отредактировано');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Popup $popup
     *
     */
    public function destroy(Popup $popup)
    {
        Storage::disk('local')->deleteDirectory('public/' . $popup->popupmetadata()->get('path')->first()->path);
        $popup->delete();

        return redirect()->route('home')->withSuccess('Высплюыващее окно удалено');
    }

    public function storeShows(Request $request)
    {
        PopupMetadata::where('popup_id', $request->popup_id)->first()->increment('shows');
    }
}
