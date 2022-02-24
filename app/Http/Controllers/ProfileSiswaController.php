<?php

namespace App\Http\Controllers;

use App\Models\ProfileSiswa;
use App\Http\Requests\StoreProfileSiswaRequest;
use App\Http\Requests\UpdateProfileSiswaRequest;

class ProfileSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfileSiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileSiswaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfileSiswa  $profileSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileSiswa $profileSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfileSiswa  $profileSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfileSiswa $profileSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileSiswaRequest  $request
     * @param  \App\Models\ProfileSiswa  $profileSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileSiswaRequest $request, ProfileSiswa $profileSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfileSiswa  $profileSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {}
        
}
