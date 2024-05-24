@extends('layouts.app-2')
@section('tab-title', 'Complete Listing of Chairmanship')
@prepend('page-css')
    <link href="{{ asset('/assets-2/plugins/datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets-2/plugins/datatables/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets-2/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .dataTables_filter input {
            margin-bottom: 10px;
        }
    </style>
@endprepend
@section('content')
    @if (Session::has('success'))
        <div class="card mb-2 bg-success shadow-sm text-white">
            <div class="card-body">
                {{ Session::get('success') }}
            </div>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header bg-light p-3 justify-content-between align-items-center d-flex">
            <h6 class="h6 card-title">Complete Listing <span class="text-lowercase">of</span> Chairmanship</h6>
        </div>
        <div class="card-body">
            <!-- User Listing Table-->
            <div class="table-responsive">
                <table class="table table-striped border" id="agendas-table">
                    <thead>
                        <tr class="bg-light">
                            <th class="p-2 text-center fw-medium text-uppercase">#</th>
                            <th class="p-2 text-center fw-medium text-uppercase">Title</th>
                            <th class="p-2 text-center fw-medium text-uppercase">Chairman</th>
                            <th class="p-2 text-center fw-medium text-uppercase">Vice Chairman</th>
                            <th class="p-2 text-center fw-medium text-uppercase">Members</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendas as $agenda)
                            <tr class="align-middle draggable" data-id="{{ $agenda->id }}">
                                <td class="text-center">
                                    {{ $agenda->index }}
                                </td>
                                <td class="text-start">
                                    <span class="mx-3">
                                        {{ Str::limit($agenda->title, 50, '...') }}</span>
                                </td>
                                <td class="text-truncate">{{ $agenda?->chairman_information?->fullname }}</td>
                                <td>{{ $agenda?->vice_chairman_information?->fullname }}</td>
                                <td class="text-center">
                                    @if ($agenda->members->count() > 0)
                                        <a class="text-primary fw-medium view-lead-committees cursor-pointer text-decoration-underline"
                                            data-bs-toggle="offcanvas" data-bs-target="#offCanvasCommittee"
                                            aria-controls="offCanvasCommittee" data-lead-committee="{{ $agenda->id }}">
                                            View Members</a>
                                    @endif

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end border-0" style="width:400px;" tabindex="-1" id="offCanvasCommittee"
        aria-labelledby="offCanvasCommitteeTitle">
        <div class="offcanvas-header position-relative">
            <div class="d-flex flex-column">
                <h5 class="offcanvas-title text-uppercase fw-medium" id="offCanvasCommitteeTitle"></h5>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="avatar-group me-4" id="pictures">
                        <span class="small fw-bolder ms-2 text-muted text-dark" id="picturesDescription"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas-body h-100 d-flex justify-content-between flex-column pb-0">
            <div class="overflow-auto py-2">
                <div class="overflow-hidden" id="leadCommitteeContent">
                </div>
            </div>
        </div>
    </div>

    @push('page-scripts')
        <script src="{{ asset('/assets-2/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/assets-2/plugins/datatables/dataTables.bootstrap5.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                let table = $('#agendas-table').DataTable({
                    ordering: false,
                    pageLength: 100,
                });
            });
        </script>

        <script>
            function addNumberSuffix(num) {
                num = parseInt(num);
                if (Number.isInteger(num)) {
                    if (num % 100 >= 11 && num % 100 <= 13) {
                        return num + 'th';
                    } else {
                        var lastDigit = num % 10;
                        switch (lastDigit) {
                            case 1:
                                return num + 'st';
                            case 2:
                                return num + 'nd';
                            case 3:
                                return num + 'rd';
                            default:
                                return num + 'th';
                        }
                    }
                }
                return "";
            }
            const loadCanvasContent = (response) => {
                let chairmanAndViceChairmanCount = 2;
                let {
                    agenda
                } = response;

                $('#offCanvasCommitteeTitle').text(agenda.title);
                $('#picturesDescription').html(`<br>${agenda?.members?.length + chairmanAndViceChairmanCount} Members`);

                $('#pictures').find('picture').remove();

                if (agenda.members) {
                    $('#leadCommitteeContent').html(``);
                    $('#leadCommitteeContent').prepend(`
                        <div class="card mb-3">
                                <div class="card-body fw-medium">
                                    <img class="img-fluid" src="/storage/user-images/${agenda?.vice_chairman_information?.profile_picture}" alt="${agenda?.vice_chairman_information?.fullname}">
                                    <div class="text-center">
                                        <span class="fs-4 fw-bold">${agenda?.vice_chairman_information?.fullname}</span>
                                    </div>
                                    <div class="text-center">
                                        <span>${agenda?.vice_chairman_information?.district}</span>
                                    </div>
                                    <span class="fs-5 fw-bold">${addNumberSuffix(agenda.vice_chairman_information?.sanggunian)} Sangguniang Panlalawigan Member</span>
                                </div>
                        </div>
                    `);

                    $('#leadCommitteeContent').prepend(`<span class="fw-bold fs-4">Vice Chairman</span>`);


                    $('#leadCommitteeContent').prepend(`
                        <div class="card mb-3">
                            <div class="card-body fw-medium">
                                <img class="img-fluid" src="/storage/user-images/${agenda?.chairman_information?.profile_picture}" alt="${agenda?.chairman_information?.fullname}">
                                <div class="text-center">
                                    <span class="fs-4 fw-bold">${agenda?.chairman_information?.fullname}</span>
                                </div>
                                <div class="text-center">
                                    <span>${agenda?.chairman_information?.district}</span>
                                </div>
                                <span class="fs-5 fw-bold">${addNumberSuffix(agenda?.chairman_information?.sanggunian)} Sangguniang Panlalawigan Member</span>
                            </div>
                        </div>
                    `);

                    $('#leadCommitteeContent').prepend(`<span class="fw-bold fs-4">Chairman</span>`);
                    $('#leadCommitteeContent').append(`<span class="fw-bold fs-4">Members</span>`);

                    agenda.members.forEach((member) => {
                        let {
                            sanggunian_member
                        } = member;
                        let [memberInformation] = sanggunian_member;

                        $('#leadCommitteeContent').append(`
                            <div class="card mb-3">
                                <div class="card-body fw-medium">
                                    <img class="img-fluid" src="/storage/user-images/${memberInformation?.profile_picture}" alt="${memberInformation?.fullname}">
                                    <div class="text-center">
                                        <span class="fs-4 fw-bold">${memberInformation?.fullname}</span>
                                    </div>
                                    <div class="text-center">
                                        <span>${memberInformation?.district}</span>
                                    </div>
                                    <span class="fs-5 fw-bold">${addNumberSuffix(memberInformation?.sanggunian)} Sangguniang Panlalawigan Member</span>
                                </div>
                            </div>
                        `);
                    });
                }
            };


            document.addEventListener('click', event => {
                if (event.target.matches('.view-lead-committees')) {
                    const agenda = event.target.getAttribute('data-lead-committee');
                    fetch(`/api/agenda-members/${agenda}`)
                        .then(response => response.json())
                        .then(data => loadCanvasContent(data))
                        .catch(error => console.error(error));
                }
            });
        </script>
    @endpush
@endsection
