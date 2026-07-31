<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resort;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\Status;
use Illuminate\Validation\Rule;

class ResortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables)
    {
        if($request->ajax()){
        
            $query = Resort::select('name', 'location', 'image', 'status', 'created_at', 'id')->orderBy('id','DESC');
     
            return $dataTables->eloquent($query)
            ->editColumn('image', function (Resort $resort) {
                $imageUrl = $resort->image 
                    ? asset('uploads/resorts/' . $resort->image) 
                    : asset('img/blank-pic.png');
                return '<img src="' . $imageUrl . '" width="100" height="90" class="img-thumbnail" />';
            })
            ->editColumn('status', function (Resort $resort) {
                $class = match ($resort->status) {
                    Status::ACTIVE => 'success',
                    Status::INACTIVE => 'danger',
                };

                return '<span class="badge badge-' . $class . '">'
                    . $resort->status->label()
                    . '</span>';
            })
            ->addColumn('actions', function (Resort $resort) {
                return
                    '<a href="' . route('admin.resorts.show', $resort) . '" 
                        class="btn btn-sm" title="View">
                        <i class="fa fa-eye"></i>
                    </a> 
                    <a href="' . route('admin.resorts.edit', $resort) . '" 
                        class="btn btn-sm" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a data-toggle="modal"
                        href="#delete-resort-modal"
                        data-href="' . route('admin.resorts.destroy', $resort) . '"
                        class="btn btn-sm resort-delete"
                        title="Delete">
                        <i class="fa fa-trash"></i>
                    </a>';
            })      
           ->rawColumns(['image', 'status','actions'])
           ->make(true);
        }
        return view('admin.resorts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $resort = new Resort();
        return view('admin.resorts.form', compact('resort'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'button_text' => ['required', 'string'],
            'button_url' => ['required', 'url'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/resorts'), $fileName);
        }

        $validated['image'] = $fileName;

        Resort::create($validated);

        return redirect()->route('admin.resorts.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resort $resort)
    {
        return view('admin.resorts.show', compact('resort'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resort $resort)
    {
        return view('admin.resorts.form', compact('resort'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resort $resort)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'button_text' => ['required', 'string'],
            'button_url' => ['required', 'url'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        $fileName = $resort->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/resorts'), $fileName);
            
            if ($resort->image && file_exists(public_path('uploads/resorts/' . $resort->image))) {
                unlink(public_path('uploads/resorts/' . $resort->image));
            }
        }

        $validated['image'] = $fileName;

        $resort->update($validated);

        return redirect()->route('admin.resorts.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resort $resort)
    {
        if (
            $resort->testimonials()->exists() ||
            $resort->galleries()->exists()
        ) {
            return response()->json([
                'status' => 'error',
                'message' => 'This resort cannot be deleted because it contains related data.',
            ], 422);
        }
        
        $resort->delete();

        return response()->json(['status'=>'success', 'message'=>'Data deleted successfully!']);
    }
}
