<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Profile;
use App\Support\WebpImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function edit(): Response
    {
        $profile = Profile::query()->firstOrCreate([]);

        return Inertia::render('Admin/Profile/Edit', [
            'profile' => $profile->toArray() + ['avatar_url' => $profile->avatar_url],
        ]);
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $profile = Profile::query()->firstOrCreate([]);
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }

            $data['avatar'] = WebpImage::store($request->file('avatar'), 'images');
        }

        $profile->update($data);

        return back()->with('success', 'Đã cập nhật hồ sơ giới thiệu.');
    }
}
