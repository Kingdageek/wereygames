<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index')->with('settings', Settings::first());
    }

    public function update(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'wereyword_hints' => 'required|integer|max:10|min:3',
        ]);

        $settings = Settings::first();
        $betaMode = $request->has('beta_mode') ? 1 : 0;
        $settings->update([
            'wereyword_hints' => $request->wereyword_hints,
            'beta_mode' => $betaMode
        ]);

        return redirect()->back()->with('success', 'Wereygames settings updated successfully');
    }
}
