<?php

namespace App\Http\Controllers;

use App\Tollbooth;
use Illuminate\Http\Request;

class TollboothsController extends Controller
{
    public function index()
    {
        $tollbooths = Tollbooth::orderBy('name', 'asc')->get();

        return view('tollbooths.index', compact('tollbooths'));
    }

    public function create()
    {
        return view('tollbooths.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|max:255'
        ]);

        Tollbooth::create($request->all());

        return redirect(route('tollbooths.index'));
    }

    public function show($id)
    {
        $tollbooth = Tollbooth::findOrFail($id);
        return view('tollbooths.show', compact('tollbooth'));
    }

    public function edit($id)
    {
        $tollbooth = Tollbooth::findOrFail($id);
        return view('tollbooths.edit', compact('tollbooth'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $tollbooth = Tollbooth::findOrFail($id);
        $tollbooth->fill($request->all());
        $tollbooth->save();

        return redirect(route('tollbooths.index'));
    }

    public function destroy($id)
    {
        $tollbooth = Tollbooth::findOrFail($id);
        $tollbooth->delete();

        return redirect(route('tollbooths.index'));
    }
}
