<?php

namespace App\Http\Controllers;

use App\Enums\AboutStatus;
use App\Mail\ContactEnquiryAdminMail;
use App\Mail\ContactEnquiryUserMail;
use App\Models\About;
use App\Models\AboutCoreValue;
use App\Models\AboutPhilosophy;
use App\Models\ContactEnquiry;
use App\Models\ContactPage;
use App\Models\Experience;
use App\Models\ExperiencePage;
use App\Models\Gallery;
use App\Models\Newsletter;
use App\Models\Resort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function home()
    {

        $homeexperiencepage = ExperiencePage::where('type', 1)
            ->first();

        $homeexperiences = Experience::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->where('type', 1)
            ->get();

        return view('front.home', compact('homeexperiencepage', 'homeexperiences'));
    }

    public function aboutUs()
    {

        $aboutpage = About::first();

        $aboutphilosophy = AboutPhilosophy::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->get();

        $aboutcorevalues = AboutCoreValue::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->get();


        return view('front.about-us', compact('aboutpage', 'aboutphilosophy', 'aboutcorevalues'));
    }



    public function experience()
    {

        $experiencepage = ExperiencePage::first();

        $experiences = Experience::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->get();

        $experiencegallaries = Gallery::where('status', 'active')
            ->where('type', 3)
            ->get();


        return view('front.experience', compact('experiencepage', 'experiences', 'experiencegallaries'));
    }



    public function contact()
    {

        $page = ContactPage::first();

        $resorts = Resort::where('status', 'active')
            ->orderBy('name')
            ->get();

        // dd($resorts);

        return view('front.contact', compact('page', 'resorts'));
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'phone' => 'nullable|string|max:255',
    //         'resort' => 'required|string|max:255',
    //         'message' => 'required|string',
    //     ]);

    //     // Save enquiry
    //     $enquiry = ContactEnquiry::create($data);

    //     // Send email to admin

    //     Mail::to(env('MAIL_ADMIN_ADDRESS'))
    //         ->send(new ContactEnquiryAdminMail($enquiry));

    //     // Mail::to('shymicams@gmail.com')
    //     //     ->send(new ContactEnquiryAdminMail($enquiry));

    //     // Send confirmation email to user
    //     Mail::to($enquiry->email)->send(new ContactEnquiryUserMail($enquiry));

    //     // return redirect()
    //     //     ->route('contact')
    //     //     ->with('success', 'Thank you for contacting us. We will get back to you shortly.');


    //     return response()->json(['success' => true, 'message' => 'Your enquiry has been submitted successfully. We will get back to you soon.',]);
    // }



    public function store(Request $request)
    {
        // Honeypot validation
        // Bots usually fill hidden fields, normal users won't.
        if ($request->filled('username')) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to process your request.',
            ], 422);
        }

        // Normal Laravel validation
        $validator = validator($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'resort' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'resort.required' => 'Please select a resort.',
            'message.required' => 'Please enter your message.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Save enquiry
        $enquiry = ContactEnquiry::create($data);

        // Send email to admin
        Mail::to(env('MAIL_ADMIN_ADDRESS'))
            ->send(new ContactEnquiryAdminMail($enquiry));

        // Send confirmation email to user
        Mail::to($enquiry->email)
            ->send(new ContactEnquiryUserMail($enquiry));

        return response()->json([
            'success' => true,
            'message' => 'Your enquiry has been submitted successfully. We will get back to you soon.',
        ]);
    }






    public function subscribe(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => [
                    'required',
                    'email',
                    'max:255',
                ],

                'username' => [
                    'prohibited',
                ],
            ],
            [
                'email.required' => 'Email is required.',
                'email.email' => 'The email field must be a valid email address.',
                'email.max' => 'The email may not be greater than 255 characters.',
                'username.prohibited' => 'Unable to process your request.',
            ]
        );

        /*
    |--------------------------------------------------------------------------
    | Validation Failed
    |--------------------------------------------------------------------------
    */

        if ($validator->fails()) {

            /*
        |--------------------------------------------------------------------------
        | Honeypot detected
        |--------------------------------------------------------------------------
        */

            if ($request->filled('username')) {

                return response()->json([
                    'success' => false,
                    'honeypot' => true,
                    'message' => 'Unable to process your request.',
                ], 422);
            }

            /*
        |--------------------------------------------------------------------------
        | Normal Email Validation
        |--------------------------------------------------------------------------
        */

            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        /*
    |--------------------------------------------------------------------------
    | Check Duplicate Email
    |--------------------------------------------------------------------------
    */

        $existing = Newsletter::where('email', $request->email)->first();

        if ($existing) {

            return response()->json([
                'success' => false,
                'message' => 'This email is already subscribed.',
            ], 409);
        }

        /*
    |--------------------------------------------------------------------------
    | Save Newsletter
    |--------------------------------------------------------------------------
    */

        Newsletter::create([
            'email' => $request->email,
        ]);

        /*
    |--------------------------------------------------------------------------
    | Success
    |--------------------------------------------------------------------------
    */

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to our newsletter!',
        ], 200);
    }
}