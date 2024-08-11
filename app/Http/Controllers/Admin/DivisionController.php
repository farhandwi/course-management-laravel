<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::paginate(10);
        return view('admin.divisions.index', compact('divisions'));
    }

    public function create()
    {
        return view('admin.divisions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Division::create($validated);

        return redirect()->route('divisions.index')->with('success', 'Division created successfully.');
    }

    public function show(Division $division)
    {
        return view('admin.divisions.show', compact('division'));
    }

    public function edit(Division $division)
    {
        return view('admin.divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $division->update($validated);

        return redirect()->route('divisions.index')->with('success', 'Division updated successfully.');
    }

    public function destroy(Division $division)
    {
        $division->delete();

        return redirect()->route('divisions.index')->with('success', 'Division deleted successfully.');
    }
}
