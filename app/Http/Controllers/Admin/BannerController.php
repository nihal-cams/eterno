<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\Status;
use Illuminate\Validation\Rule;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables)
    {
        if($request->ajax()){
        
            $query = Banner::select('title', 'image', 'status', 'created_at', 'id')->orderBy('id','DESC');
     
            return $dataTables->eloquent($query)
            ->editColumn('image', function (Banner $banner) {
                $imageUrl = $banner->image 
                    ? asset('uploads/banners/' . $banner->image) 
                    : asset('img/blank-pic.png');
                return '<img src="' . $imageUrl . '" width="100" height="90" class="img-thumbnail" />';
            })
            ->editColumn('status', function (Banner $banner) {
                $class = match ($banner->status) {
                    Status::ACTIVE => 'success',
                    Status::INACTIVE => 'danger',
                };

                return '<span class="badge badge-' . $class . '">'
                    . $banner->status->label()
                    . '</span>';
            })
            ->addColumn('actions', function (Banner $banner) {
                return
                    '<a href="' . route('admin.banners.show', $banner) . '" 
                        class="btn btn-sm" title="View">
                        <i class="fa fa-eye"></i>
                    </a> 
                    <a href="' . route('admin.banners.edit', $banner) . '" 
                        class="btn btn-sm" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a data-toggle="modal"
                        href="#delete-banner-modal"
                        data-href="' . route('admin.banners.destroy', $banner) . '"
                        class="btn btn-sm banner-delete"
                        title="Delete">
                        <i class="fa fa-trash"></i>
                    </a>';
            })      
           ->rawColumns(['image', 'status','actions'])
           ->make(true);
        }
        return view('admin.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $banner = new Banner();
        return view('admin.banners.form', compact('banner'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners'), $fileName);
        }

        $validated['image'] = $fileName;

        Banner::create($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.form', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        $fileName = $banner->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners'), $fileName);
            
            if ($banner->image && file_exists(public_path('uploads/banners/' . $banner->image))) {
                unlink(public_path('uploads/banners/' . $banner->image));
            }
        }

        $validated['image'] = $fileName;

        $banner->update($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return response()->json(['status'=>'success', 'message'=>'Data deleted successfully!']);
    }
}
