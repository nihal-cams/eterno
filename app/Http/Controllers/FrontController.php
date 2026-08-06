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
use Illuminate\Support\Facades\Http;

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



    public function store(Request $request)
    {

        if ($request->filled('username')) {

            return response()->json([
                'success' => false,
                'message' => 'Unable to submit your enquiry. Please try again.',
            ], 422);
        }

        $validator = validator($request->all(), [

            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255',

            'phone' => 'required|string|max:255',

            'resort' => 'required|string|max:255',

            'message' => 'required|string',

            'recaptcha_token' => 'required|string',

        ], [

            'name.required' => 'Please enter your name.',

            'email.required' => 'Please enter your email address.',

            'email.email' => 'Please enter a valid email address.',

            'phone.required' => 'Please enter your phone number.',

            'resort.required' => 'Please select a resort.',

            'message.required' => 'Please enter your message.',

            'recaptcha_token.required' =>
            'Please complete the security verification.',

        ]);



        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Google reCAPTCHA v3 verification
        try {

            $recaptcha = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret' => config('services.recaptcha.secret_key'),

                    'response' => $request->input('recaptcha_token'),

                    'remoteip' => $request->ip(),
                ]
            );
        } catch (\Throwable $e) {

            \Log::error('reCAPTCHA connection error', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Security verification is currently unavailable. Please try again.',
            ], 500);
        }


        $recaptchaData = $recaptcha->json();



        \Log::info('reCAPTCHA response', [
            'status' => $recaptcha->status(),
            'response' => $recaptchaData,
        ]);



        if (!$recaptcha->successful()) {

            return response()->json([
                'success' => false,
                'message' => 'Security verification failed. Please try again.',
            ], 422);
        }

        if (!($recaptchaData['success'] ?? false)) {

            return response()->json([
                'success' => false,
                'message' => 'Security verification failed. Please try again.',
            ], 422);
        }



        if (($recaptchaData['action'] ?? '') !== 'contact_form') {

            return response()->json([
                'success' => false,
                'message' => 'Security verification failed. Please try again.',
            ], 422);
        }


        $score = (float) ($recaptchaData['score'] ?? 0);


        if ($score < 0.5) {

            return response()->json([
                'success' => false,
                'message' => 'Security verification failed. Please try again.',
            ], 422);
        }



        $data = $validator->validated();

        unset($data['recaptcha_token']);


        $enquiry = ContactEnquiry::create($data);



        Mail::to(env('MAIL_ADMIN_ADDRESS'))
            ->send(new ContactEnquiryAdminMail($enquiry));



        Mail::to($enquiry->email)
            ->send(new ContactEnquiryUserMail($enquiry));


        return response()->json([
            'success' => true,
            'message' =>
            'Your enquiry has been submitted successfully. We will get back to you soon.',
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


        if ($validator->fails()) {


            if ($request->filled('username')) {

                return response()->json([
                    'success' => false,
                    'honeypot' => true,
                    'message' => 'Unable to process your request.',
                ], 422);
            }



            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }



        $existing = Newsletter::where('email', $request->email)->first();

        if ($existing) {

            return response()->json([
                'success' => false,
                'message' => 'This email is already subscribed.',
            ], 409);
        }


        Newsletter::create([
            'email' => $request->email,
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to our newsletter!',
        ], 200);
    }
}