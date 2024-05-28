<x-landing-layout>
    <x-slot name="slot">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
        <script src='fullcalendar/dist/index.global.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    selectable: false,
                    events: @json($events),
                    eventContent: function(info) {
                        return {
                            html: '<div class="uker-info"><b>' + info.event.extendedProps.facility +
                                '</b></div>'
                            // Render more fields as needed
                        };
                    },
                    eventClick: function(info) {
                        // Redirect to reservation show route with reservation ID
                        window.location.href = "{{ secure_url('reservations.show', '') }}/" + info.event.id;
                    },
                    dateClick: function(info) {
                        // Redirect to the reservation creation page with the clicked date as a query parameter
                        window.location.href = "{{ secure_url('reservation.make') }}?start_date=" + info
                            .dateStr;
                    }
                });
                calendar.render();

            });
        </script>

        <div class="page">
            <div class="content">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <a href="{{ secure_url('reservations.create') }}" class="btn btn-success">
                                                Make Reservation
                                            </a>
                                            <h6 class="text-muted">or select a date to schedule an event</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="page">
            <div class="content">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="col-12">
                            <form method="GET" action="{{ secure_url('events.index') }}" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="search" placeholder="Search..."
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="status" class="form-control">
                                                    <option value="">Select Status (All)</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="approved">Approved</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Additional filters can be added here -->
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="page">
            <div class="content">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-landing-layout>
