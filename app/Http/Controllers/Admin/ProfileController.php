<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $profile = Profile::query()->firstOrCreate([]);

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $profile = Profile::query()->firstOrCreate([]);
        $profile->update($request->validated());

        return back()->with('success', 'Đã cập nhật hồ sơ giới thiệu.');
    }
}
