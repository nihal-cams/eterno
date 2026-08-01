<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AboutStatus;
use App\Enums\ExperienceStatus;
use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables)
    {
        if ($request->ajax()) {

            $query = Experience::select(
                'id',
                'subtitle',
                'title',
                'image',
                'layout',
                'sort_order',
                'status',
                'created_at'
            )->orderBy('sort_order')
                ->orderByDesc('id');

            return $dataTables->eloquent($query)

                ->addIndexColumn()

                // ->editColumn('image', function (Experience $experience) {

                //     if (!$experience->image) {
                //         return '-';
                //     }

                //     return '<img src="' . asset($experience->image) . '"
                //                 width="60"
                //                 height="60"
                //                 class="img-thumbnail">';
                // })


                ->editColumn('image', function (Experience $experience) {

                    $image_url = $experience->image
                        ? asset($experience->image)
                        : asset('img/blank-pic.png');

                    return '<img src="' . $image_url . '"
                width="100"
                height="90"
                class="img-thumbnail" />';
                })

                ->editColumn('status', function (Experience $experience) {

                    $class = match ($experience->status) {
                        ExperienceStatus::ACTIVE => 'success',
                        ExperienceStatus::INACTIVE => 'danger',
                    };

                    return '<span class="badge badge-' . $class . '">'
                        . $experience->status->label()
                        . '</span>';
                })

                ->editColumn('layout', function (Experience $experience) {

                    return ucfirst($experience->layout);
                })

                // ->editColumn('status', function (Experience $experience) {

                //     $class = match ($experience->status) {

                //         ExperienceStatus::ACTIVE => 'success',

                //         ExperienceStatus::INACTIVE => 'secondary',
                //     };

                //     return '<span class="badge badge-' . $class . '">'
                //         . $experience->status->label()
                //         . '</span>';
                // })

                ->editColumn('created_at', function (Experience $experience) {

                    return $experience->created_at->format('d-m-Y');
                })

                ->addColumn('actions', function (Experience $experience) {

                    return '

                    <a href="' . route('admin.experience-items.edit', $experience) . '"
                        class="btn btn-sm"
                        title="Edit">

                        <i class="fa fa-edit"></i>

                    </a>

                    <a
                        href="#delete-experience-modal"
                        class="btn btn-sm experience-delete"
                        data-toggle="modal"
                        data-href="' . route('admin.experience-items.destroy', $experience) . '"
                        title="Delete">

                        <i class="fa fa-trash"></i>

                    </a>

                    ';
                })

                ->rawColumns([
                    'image',
                    'status',
                    'actions'
                ])

                ->make(true);
        }

        return view('admin.experience.items.index');
    }


    public function create()
    {
        $experience = new Experience();

        return view(
            'admin.experience.items.form',
            compact('experience')
        );
    }


    public function store(Request $request)
    {

        $validated = $request->validate([

            'subtitle' => 'nullable|max:255',

            'title' => 'required|max:255',

            'description' => 'nullable',

            'experience_list' => 'nullable',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

            'layout' => 'required|in:left,right',

            'sort_order' => 'required|integer',

            'status' => ['required', Rule::enum(ExperienceStatus::class)]

        ]);


        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_experience.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('img/experience/items'),
                $imageName
            );

            $validated['image'] =
                'img/experience/items/' . $imageName;
        }

        Experience::create($validated);

        return redirect()
            ->route('admin.experience-items.index')
            ->with(
                'success',
                'Experience added successfully.'
            );
    }




    public function edit($id)
    {
        // dd($id);

        $experience = Experience::findOrFail($id);

        return view(
            'admin.experience.items.form',
            compact('experience')
        );
    }





    public function update(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);

        $validated = $request->validate([

            'subtitle' => 'nullable|max:255',

            'title' => 'required|max:255',

            'description' => 'nullable',

            'experience_list' => 'nullable',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

            'layout' => 'required|in:left,right',

            'sort_order' => 'required|integer',

            'status' => ['required', Rule::enum(ExperienceStatus::class)]

        ]);


        if ($request->hasFile('image')) {

            if (
                $experience->image &&
                file_exists(public_path($experience->image))
            ) {

                unlink(public_path($experience->image));
            }

            $image = $request->file('image');

            $imageName = time() . '_experience.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('img/experience/items'),
                $imageName
            );

            $validated['image'] =
                'img/experience/items/' . $imageName;
        }

        $experience->update($validated);

        return redirect()
            ->route('admin.experience-items.index')
            ->with('success', 'Updated Successfully');
    }


    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);

        if (
            $experience->image &&
            file_exists(public_path($experience->image))
        ) {
            unlink(public_path($experience->image));
        }

        $experience->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully'
        ]);
    }
}