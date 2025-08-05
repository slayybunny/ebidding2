<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BiddingPlatformController extends Controller
{
    public function index()
    {
        return view('admin.bidding-platform.index');
    }

    public function create()
    {
        return view('admin.bidding-platform.create');
    }

    public function store(Request $request)
    {
        // Dummy simpanan
        return redirect()->route('admin.bidding.index')->with('success', 'Bidaan baru berjaya ditambah (dummy).');
    }

    public function show($id)
    {
        return view('admin.bidding-platform.show', ['id' => $id]);
    }

    public function edit($id)
    {
        return view('admin.bidding-platform.edit', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        // Dummy kemaskini
        return redirect()->route('admin.bidding.index')->with('success', 'Bidaan berjaya dikemaskini (dummy).');
    }
}
