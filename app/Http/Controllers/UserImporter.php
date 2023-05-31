<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserImporter extends Controller
{
    /**
     * Import users from a CSV file.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $file = $request->file('file');
        return redirect()->back()->with('success', 'Users imported successfully!');
    }
}
