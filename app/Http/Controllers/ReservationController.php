<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $reservations = Reservation::query()
            ->when($search, function ($query, $search) {
                $query->where('event', 'like', '%'.$search.'%')
                    ->orWhere('reservation_start', 'like', '%'.$search.'%')
                    ->orWhere('reservation_end', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%')
                            ->orWhereHas('ukerMaster', function ($ukerQuery) use ($search) {
                                $ukerQuery->where('nama_unit_kerja_eselon_2', 'like', '%'.$search.'%');
                            });
                    });
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('reservations.index', compact('reservations'));
    }
    public function landingIndex(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $reservations = Reservation::query()
            ->when($search, function ($query, $search) {
                $query->where('event', 'like', '%'.$search.'%')
                    ->orWhere('reservation_start', 'like', '%'.$search.'%')
                    ->orWhere('reservation_end', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%')
                            ->orWhereHas('ukerMaster', function ($ukerQuery) use ($search) {
                                $ukerQuery->where('nama_unit_kerja_eselon_2', 'like', '%'.$search.'%');
                            });
                    });
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('landing.content.user-reservation', compact('reservations'));
    }


    public function create()
    {
        $facilities = Facility::all();
        return view('reservations.create', compact('facilities'));
    }
    public function landingCreate()
    {
        $facilities = Facility::all();
        return view('landing.content.reservation', compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'facility_id' => 'required|exists:facilities,id',
            'event' => 'required|string|max:255|unique:reservations,event',
            'reservation_start' => 'required|date',
            'reservation_end' => 'required|date|after_or_equal:reservation_start',
            'description' => 'nullable|string',
            'document' => 'required|file|mimes:pdf|max:2048',
            'document_attachment' => 'nullable|file|mimes:pdf|max:2048|unique:reservations,document_attachment'
        ],[
            'user_id.required' => 'The user ID field is required.',
            'user_id.exists' => 'The selected user ID is invalid.',
            'facility_id.required' => 'The facility ID field is required.',
            'facility_id.exists' => 'The selected facility ID is invalid.',
            'event.required' => 'The event field is required.',
            'event.string' => 'The event must be a string.',
            'event.max' => 'The event may not be greater than :max characters.',
            'reservation_start.required' => 'The reservation start field is required.',
            'reservation_start.date' => 'The reservation start must be a date.',
            'reservation_end.required' => 'The reservation end field is required.',
            'reservation_end.date' => 'The reservation end must be a date.',
            'reservation_end.after_or_equal' => 'The reservation end must be after or equal to the reservation start.',
            'description.string' => 'The description must be a string.',
            'document.file' => 'The document must be a file.',
            'document.mimes' => 'The document must be a file of type: pdf.',
            'document.max' => 'The document may not be greater than :max kilobytes.',
            'document_attachment.file' => 'The document attachment must be a file.',
            'document_attachment.mimes' => 'The document attachment must be a file of type: pdf.',
            'document_attachment.max' => 'The document attachment may not be greater than :max kilobytes.'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('document')) {
            $documentName = Str::slug($request->input('event')) . '_document.' . $request->file('document')->getClientOriginalExtension();
            $documentPath = $request->file('document')->storeAs('public/documents', $documentName);
            $data['document'] = $documentPath;
        }

        if ($request->hasFile('document_attachment')) {
            $documentAttachmentName = Str::slug($request->input('event')) . '_attachment.' . $request->file('document_attachment')->getClientOriginalExtension();
            $documentAttachmentPath = $request->file('document_attachment')->storeAs('public/document-attachments', $documentAttachmentName);
            $data['document_attachment'] = $documentAttachmentPath;
        }

        Reservation::create($data);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation created successfully.');
    }
    public function landingStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'facility_id' => 'required|exists:facilities,id',
            'event' => 'required|string|max:255|unique:reservations,event',
            'reservation_start' => 'required|date',
            'reservation_end' => 'required|date|after_or_equal:reservation_start',
            'description' => 'nullable|string',
            'document' => 'required|file|mimes:pdf|max:2048',
            'document_attachment' => 'nullable|file|mimes:pdf|max:2048|unique:reservations,document_attachment'
        ],[
            'user_id.required' => 'The user ID field is required.',
            'user_id.exists' => 'The selected user ID is invalid.',
            'facility_id.required' => 'The facility ID field is required.',
            'facility_id.exists' => 'The selected facility ID is invalid.',
            'event.required' => 'The event field is required.',
            'event.string' => 'The event must be a string.',
            'event.max' => 'The event may not be greater than :max characters.',
            'reservation_start.required' => 'The reservation start field is required.',
            'reservation_start.date' => 'The reservation start must be a date.',
            'reservation_end.required' => 'The reservation end field is required.',
            'reservation_end.date' => 'The reservation end must be a date.',
            'reservation_end.after_or_equal' => 'The reservation end must be after or equal to the reservation start.',
            'description.string' => 'The description must be a string.',
            'document.file' => 'The document must be a file.',
            'document.mimes' => 'The document must be a file of type: pdf.',
            'document.max' => 'The document may not be greater than :max kilobytes.',
            'document_attachment.file' => 'The document attachment must be a file.',
            'document_attachment.mimes' => 'The document attachment must be a file of type: pdf.',
            'document_attachment.max' => 'The document attachment may not be greater than :max kilobytes.'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('document')) {
            $documentName = Str::slug($request->input('event')) . '_document.' . $request->file('document')->getClientOriginalExtension();
            $documentPath = $request->file('document')->storeAs('public/documents', $documentName);
            $data['document'] = $documentPath;
        }

        if ($request->hasFile('document_attachment')) {
            $documentAttachmentName = Str::slug($request->input('event')) . '_attachment.' . $request->file('document_attachment')->getClientOriginalExtension();
            $documentAttachmentPath = $request->file('document_attachment')->storeAs('public/document-attachments', $documentAttachmentName);
            $data['document_attachment'] = $documentAttachmentPath;
        }

        Reservation::create($data);

        return redirect()->route('landing')
            ->with('success', 'Reservation created successfully.');
    }




    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $facilities = Facility::all();
        return view('reservations.edit', compact('reservation','facilities'));
    }

    public function preverify(Reservation $reservation)
    {
        $facilities = Facility::all();
        return view('reservations.verify', compact('reservation','facilities'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'facility_id' => 'required|exists:facilities,id',
            'event' => 'required|string|max:255',
            'reservation_start' => 'required|date',
            'reservation_end' => 'required|date|after_or_equal:reservation_start',
            'description' => 'nullable|string',
            'document' => 'required|file|mimes:pdf|max:2048',
            'document_attachment' => 'nullable|file|mimes:pdf|max:2048'
        ], [
            'user_id.required' => 'The user ID field is required.',
            'user_id.exists' => 'The selected user ID is invalid.',
            'facility_id.required' => 'The facility ID field is required.',
            'facility_id.exists' => 'The selected facility ID is invalid.',
            'event.required' => 'The event field is required.',
            'event.string' => 'The event must be a string.',
            'event.max' => 'The event may not be greater than :max characters.',
            'reservation_start.required' => 'The reservation start field is required.',
            'reservation_start.date' => 'The reservation start must be a date.',
            'reservation_end.required' => 'The reservation end field is required.',
            'reservation_end.date' => 'The reservation end must be a date.',
            'reservation_end.after_or_equal' => 'The reservation end must be after or equal to the reservation start.',
            'description.string' => 'The description must be a string.',
            'document.file' => 'The document must be a file.',
            'document.mimes' => 'The document must be a file of type: pdf.',
            'document.max' => 'The document may not be greater than :max kilobytes.',
            'document_attachment.file' => 'The document attachment must be a file.',
            'document_attachment.mimes' => 'The document attachment must be a file of type: pdf.',
            'document_attachment.max' => 'The document attachment may not be greater than :max kilobytes.'
        ]);

        $data = $request->all();

        // Exclude current reservation from unique rule when not updating document
        if (!$request->hasFile('document')) {
            $request->merge(['document' => $reservation->document]);
        }

        // Exclude current reservation from unique rule when not updating document_attachment
        if (!$request->hasFile('document_attachment')) {
            $request->merge(['document_attachment' => $reservation->document_attachment]);
        }

        if ($request->hasFile('document')) {
            $documentName = Str::slug($request->input('event')) . '_document.' . $request->file('document')->getClientOriginalExtension();
            Storage::delete('public/' . $reservation->document);
            $documentPath = $request->file('document')->storeAs('public/documents', $documentName);
            $data['document'] = $documentPath;
        }

        if ($request->hasFile('document_attachment')) {
            $documentAttachmentName = Str::slug($request->input('event')) . '_attachment.' . $request->file('document_attachment')->getClientOriginalExtension();
            Storage::delete('public/' . $reservation->document_attachment);
            $documentAttachmentPath = $request->file('document_attachment')->storeAs('public/document-attachments', $documentAttachmentName);
            $data['document_attachment'] = $documentAttachmentPath;
        }

        $reservation->update($data);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully');
    }


    public function verify(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')
            ->with('success', 'A change in reservation status has been successfully registered.');
    }

    public function destroy(Reservation $reservation)
    {
        try {
            // Check if document path is not null before attempting deletion
            if ($reservation->document) {
                Storage::delete($reservation->document);
            }

            // Check if document_attachment path is not null before attempting deletion
            if ($reservation->document_attachment) {
                Storage::delete($reservation->document_attachment);
            }
        } catch (\Exception $e) {
            // Log the error using Laravel's default logger
            Log::error('Error deleting files: ' . $e->getMessage());

            // You can also return a response indicating the error to the user
            return redirect()->route('reservations.index')->with('error', 'Error deleting files.');
        }

        // If deletion from storage is successful or paths were null, proceed to delete the reservation record
        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation deleted successfully');
    }
}