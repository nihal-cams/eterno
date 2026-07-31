<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function edit()
    {
        $page = ContactPage::first();

        if (!$page) {

            $page = ContactPage::create([

                'banner_title' => 'Contact Us',
                'section_title' => 'Let’s Start Your Journey',

            ]);
        }

        return view(
            'admin.contact.page.edit',
            compact('page')
        );
    }


    public function update(Request $request)
    {
        $page = ContactPage::first();

        $data = $request->validate([

            'banner_title' => 'nullable|max:255',
            'banner_description' => 'nullable',

            'section_subtitle' => 'nullable|max:255',
            'section_title' => 'nullable|max:255',
            'section_description' => 'nullable',

            'form_title' => 'nullable|max:255',
            'form_description' => 'nullable',

            'phone' => 'nullable|max:255',
            'email' => 'nullable|email',
            'address' => 'nullable',

            'map_iframe' => 'nullable',

        ]);


        if ($request->hasFile('banner_image')) {

            $image = $request->file('banner_image');

            $imageName = time() . '_banner.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('img/contact'),
                $imageName
            );

            $data['banner_image'] =
                'img/contact/' . $imageName;
        }


        if ($request->hasFile('form_image')) {

            $image = $request->file('form_image');

            $imageName = time() . '_form.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('img/contact'),
                $imageName
            );

            $data['form_image'] =
                'img/contact/' . $imageName;
        }


        $page->update($data);

        return back()->with(
            'success',
            'Contact page updated successfully.'
        );
    }
}