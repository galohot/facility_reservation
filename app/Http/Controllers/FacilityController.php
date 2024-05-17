<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Facility;
use App\Models\FacilityCategory;
use App\Models\Reservation;
use App\Models\UkerMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category'); // New line to get the category filter value

        $categories = FacilityCategory::all();
        $facilities = Facility::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('location', 'like', '%'.$search.'%')
                    ->orWhere('capacity', 'like', '%'.$search.'%')
                    ->orWhereHas('facilityCategory', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('category_str', 'like', '%'.$search.'%');
                    })
                    ->orWhereHas('ukerMaster', function ($ukerQuery) use ($search) {
                        $ukerQuery->where('nama_unit_kerja_eselon_2', 'like', '%'.$search.'%');
                    });
            })
            ->when($category, function ($query, $category) { // New line to filter by category
                $query->whereHas('facilityCategory', function ($categoryQuery) use ($category) {
                    $categoryQuery->where('category_str', $category);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('facilities.index', compact('facilities','categories'));
    }

    public function reservationHistory(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category'); // New line to get the category filter value

        $categories = FacilityCategory::all();
        $facilities = Facility::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('location', 'like', '%'.$search.'%')
                    ->orWhere('capacity', 'like', '%'.$search.'%')
                    ->orWhereHas('facilityCategory', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('category_str', 'like', '%'.$search.'%');
                    })
                    ->orWhereHas('ukerMaster', function ($ukerQuery) use ($search) {
                        $ukerQuery->where('nama_unit_kerja_eselon_2', 'like', '%'.$search.'%');
                    });
            })
            ->when($category, function ($query, $category) { // New line to filter by category
                $query->whereHas('facilityCategory', function ($categoryQuery) use ($category) {
                    $categoryQuery->where('category_str', $category);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $reservations = Reservation::all();

        return view('facilities.reservation-history', compact('reservations','facilities','categories'));

    }
    public function create()
    {
        $facilityCategories = FacilityCategory::all();
        $ukerMasters = UkerMaster::all();
        $addons = Addon::all(); // Fetch all addons

        return view('facilities.create', compact('facilityCategories', 'ukerMasters', 'addons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:facilities,name',
            'description' => 'required|string',
            'capacity' => 'nullable|integer',
            'floor' => 'required|integer|max:50',
            'uker_masters_id' => 'required|exists:uker_masters,id',
            'facility_category_id' => 'required|exists:facility_categories,id',
            'image_main' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            'location' => 'nullable|string',
            'google_map_link' => 'nullable|string',
            'addons' => 'array', // Validate addons as an array
            'addons.*' => 'exists:addons,id', // Validate each addon exists in addons table
        ]);

        $data = $request->all();
        $facility = Facility::create($data);

        foreach (['image_main', 'image_1', 'image_2', 'image_3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $filename = $this->generateImageFilename($facility, $imageField);
                $path = $request->file($imageField)->storeAs('public/facilities/' . $facility->id, $filename);
                $facility->$imageField = str_replace('public/', '', $path);
            }
        }

        $facility->addons()->sync($request->addons); // Sync addons with the facility
        $facility->save();

        return redirect()->route('facilities.index')
            ->with('success', 'Facility created successfully.');
    }

    private function generateImageFilename(Facility $facility, $imageField)
    {
        // Extract the extension from the uploaded file
        $extension = request()->file($imageField)->getClientOriginalExtension();

        // Generate a unique filename based on facility name and field name
        $filename = 'facility' . $facility->id . '-' . $facility->name . '-' . $imageField . '.' . $extension;

        // Replace spaces with hyphens and make it lowercase
        $filename = strtolower(str_replace(' ', '-', $filename));

        return $filename;
    }

    public function show(Facility $facility)
    {
        $facilityCategories = FacilityCategory::all();
        $ukerMasters = UkerMaster::all();
        $reservations = Reservation::all();
        $facility->load('addons'); // Load addons relationship
        return view('facilities.show', compact('facility', 'facilityCategories', 'ukerMasters', 'reservations'));
    }

    public function edit(Facility $facility)
    {
        $facilityCategories = FacilityCategory::all();
        $ukerMasters = UkerMaster::all();
        $addons = Addon::all(); // Fetch all addons
        $facility->load('addons'); // Load addons relationship
        return view('facilities.edit', compact('facility', 'facilityCategories', 'ukerMasters', 'addons'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:facilities,name,' . $facility->id,
            'description' => 'required|string',
            'capacity' => 'nullable|integer',
            'floor' => 'required|integer|max:50',
            'uker_masters_id' => 'required|exists:uker_masters,id',
            'facility_category_id' => 'required|exists:facility_categories,id',
            'image_main' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
            'addons' => 'array', // Validate addons as an array
            'addons.*' => 'exists:addons,id', // Validate each addon exists in addons table
        ]);

        $data = $request->all();

        foreach (['image_main', 'image_1', 'image_2', 'image_3'] as $imageField) {
            if ($request->hasFile($imageField) && $facility->$imageField) {
                Storage::delete('public/' . $facility->$imageField);
            }
        }

        foreach (['image_main', 'image_1', 'image_2', 'image_3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $filename = $this->generateImageFilename($facility, $imageField);
                $path = $request->file($imageField)->storeAs('public/facilities/' . $facility->id, $filename);
                $data[$imageField] = str_replace('public/', '', $path);
            }
        }

        $facility->update($data);
        $facility->addons()->sync($request->addons); // Sync addons with the facility

        return redirect()->route('facilities.index')
            ->with('success', 'Facility updated successfully.');
    }

    public function destroy(Facility $facility)
    {
        // Check if the facility is related to any reservations
        $hasReservations = Reservation::where('facility_id', $facility->id)->exists();

        // If there are reservations related to the facility, prevent deletion and show error message
        if ($hasReservations) {
            return redirect()->route('facilities.index')
                ->with('error', 'Cannot delete facility because it is being used in an active reservation');
        }

        // Determine which images need to be deleted
        $imagesToDelete = collect([
            'image_main' => $facility->image_main,
            'image_1' => $facility->image_1,
            'image_2' => $facility->image_2,
            'image_3' => $facility->image_3,
        ])->filter();

        // Delete the images
        foreach ($imagesToDelete as $columnName => $imagePath) {
            Storage::delete($imagePath);
        }

        // Check if any other facilities are using the same folder for images
        $remainingFacilitiesWithImages = Facility::where(function ($query) use ($facility) {
            $query->whereNotNull('image_main')
                ->orWhereNotNull('image_1')
                ->orWhereNotNull('image_2')
                ->orWhereNotNull('image_3');
        })->where('id', '<>', $facility->id)
        ->exists();

        // If no other facilities are using the same folder, delete it
        if (!$remainingFacilitiesWithImages) {
            $folderPath = 'public/facilities/' . $facility->id;

            if (Storage::exists($folderPath)) {
                Storage::deleteDirectory($folderPath);
            }
        }

        // Then delete the facility
        $facility->delete();

        return redirect()->route('facilities.index')
            ->with('success', 'Facility and associated images deleted successfully');
    }



}