<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExperiencePage;
use Illuminate\Http\Request;

class ExperiencePageController extends Controller
{
    /**
     * Edit Experience Page
     */
    public function edit()
    {
        $experiencePage = ExperiencePage::first();

        if (!$experiencePage) {

            $experiencePage = ExperiencePage::create([

                'banner_title'       => 'Experience',

                'banner_description' => '',

                'intro_subtitle'     => '',

                'intro_title'        => 'Our Experiences',

                'intro_description'  => '',

            ]);
        }

        return view(
            'admin.experience.edit',
            compact('experiencePage')
        );
    }


    /**
     * Update Experience Page
     */
    public function update(Request $request)
    {
        $experiencePage = ExperiencePage::first();

        $data = $request->validate([

            'banner_title' => 'required|max:255',

            'banner_description' => 'nullable',

            'intro_subtitle' => 'nullable|max:255',

            'intro_title' => 'required|max:255',

            'intro_description' => 'nullable',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Banner Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('banner_image')) {

            if (
                $experiencePage->banner_image &&
                file_exists(public_path($experiencePage->banner_image))
            ) {

                unlink(public_path($experiencePage->banner_image));
            }

            $image = $request->file('banner_image');

            $imageName = time() . '_banner.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('img/experience'),
                $imageName
            );

            $data['banner_image'] =
                'img/experience/' . $imageName;
        }

        $experiencePage->update($data);

        return redirect()
            ->back()
            ->with(
                'success',
                'Experience Page updated successfully.'
            );
    }
}