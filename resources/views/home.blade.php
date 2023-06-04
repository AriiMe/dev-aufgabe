@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Select Leave Dates</h1>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                select: function(info) {
                    var startDate = info.startStr;
                    var endDate = info.endStr;

                    $.ajax({
                        url: '/request',
                        type: 'POST',
                        data: {
                            start_time: startDate,
                            end_time: endDate,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            alert('Leave request submitted!');
                        },
                        error: function() {
                            alert('There was an error. Please try again.');
                        }
                    });
                }
            });

            calendar.render();
        });
    </script>
@endsection
