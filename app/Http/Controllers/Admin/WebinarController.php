<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\WebinarStatus;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class WebinarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables)
    {
        if($request->ajax()){
        
            $query = Webinar::select('title', 'platform', 'date', 'time', 'duration', 'capacity', 'status', 'created_at', 'id')->where('user_id', Auth::id())->orderBy('id','DESC');
     
            return $dataTables->eloquent($query)
            ->editColumn('date', function (Webinar $webinar) {
                return $webinar->date->format('d-m-Y');
            })
            ->editColumn('time', function (Webinar $webinar) {
                return $webinar->time->format('h:i A');
            })
            ->editColumn('capacity', function (Webinar $webinar) {
                return $webinar->capacity . ' attendees';
            })
            ->editColumn('status', function (Webinar $webinar) {
                $class = match ($webinar->status) {
                    WebinarStatus::DRAFT => 'secondary',
                    WebinarStatus::SCHEDULED => 'primary',
                    WebinarStatus::REGISTRATION_CLOSED => 'warning',
                    WebinarStatus::LIVE => 'success',
                    WebinarStatus::COMPLETED => 'info',
                    WebinarStatus::CANCELLED => 'danger',
                };

                return '<span class="badge badge-' . $class . '">'
                    . $webinar->status->label()
                    . '</span>';
            })
            ->addColumn('actions', function (Webinar $webinar) {
                return
                    '<a href="' . route('admin.webinars.show', $webinar) . '" 
                        class="btn btn-sm" title="View">
                        <i class="fa fa-eye"></i>
                    </a> 
                    <a href="' . route('admin.webinars.edit', $webinar) . '" 
                        class="btn btn-sm" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a data-toggle="modal"
                        href="#delete-webinar-modal"
                        data-href="' . route('admin.webinars.destroy', $webinar) . '"
                        class="btn btn-sm webinar-delete"
                        title="Delete">
                        <i class="fa fa-trash"></i>
                    </a>';
            })      
           ->rawColumns(['status','actions'])
           ->make(true);
        }
        return view('admin.webinars.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $webinar = new Webinar();
        return view('admin.webinars.form', compact('webinar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'platform' => ['required', 'string', 'max:100'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'duration' => ['required'],
            'capacity' => ['required'],
            'meeting_link' => ['required', 'url'],
            'status' => ['required', Rule::enum(WebinarStatus::class)],
        ]);

        $validated['user_id'] = Auth::id();

        Webinar::create($validated);

        return redirect()->route('admin.webinars.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Webinar $webinar)
    {
        $this->authorize('view', $webinar);

        return view('admin.webinars.show', compact('webinar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Webinar $webinar)
    {
        $this->authorize('update', $webinar);

        return view('admin.webinars.form', compact('webinar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Webinar $webinar)
    {
        $this->authorize('update', $webinar);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'platform' => ['required', 'string', 'max:100'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'duration' => ['required'],
            'capacity' => ['required'],
            'meeting_link' => ['required', 'url'],
            'status' => ['required', Rule::enum(WebinarStatus::class)],
        ]);

        $webinar->update($validated);

        return redirect()->route('admin.webinars.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Webinar $webinar)
    {
        $this->authorize('delete', $webinar);

        $webinar->delete();

        return response()->json(['status'=>'success', 'message'=>'Data deleted successfully!']);
    }
}
