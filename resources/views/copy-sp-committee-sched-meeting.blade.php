<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Today's Scheduled Committee Meeting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <style>


        body {
            font-family: Inter, sans-serif;
            box-sizing: border-box;
            padding: 0px;
            margin: 0px;
            /*overflow: hidden;*/
        }

        .kanban-board {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .kanban-column {
            /* background-color: #f2f3f6; */
            padding: 10px;
            padding-right: 32px;
            border-radius: 5px;
            margin-bottom: 20px;
            flex-basis: calc(33.33% - 20px);
            /* max-width: calc(33.33% - 20px); */
        }

        .kanban-column h2 {
            margin-top: 0;
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .kanban-card {
            /* background-color: #ffffff; */
            border-radius: 5px;
            padding: 10px;
            margin-top: 30px;
            margin-bottom: 25px;
            cursor: pointer;
            font-size: 18px;
        }

        .kanban-card h3 {
            margin-top: 0;
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .kanban-card p {
            margin-bottom: 0;
            font-size: 0.9rem;
            color: white;
        }

        ol {
            list-style: none;
        }



        .highlighted-text {
            background-color: yellow;
        }

    </style>
</head>
<body>


<div class="row">
    <div class="col-lg-2 pe-0 d-sm-none d-none d-lg-block d-md-block " id="sidebar" style="background: hsl(217.67deg 54.43% 15.49%) !important">
        <div data-simplebar class="px-2" data-simplebar-auto-hide="true" id="spMemberWidget">
            <div class="list-group list-group-flush scrollarea">
                <div class="input-group mb-2 mt-2 rounded-0">
                    <span class="input-group-text bg-dark text-white" id="basic-addon1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-search" viewBox="0 0 16 16">
                          <path
                              d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </span>
                    <input type="text" class="form-control  border border-dark rounded-0" placeholder="Search..."
                           id="searchField">
                </div>

                <div class="list-group-item list-group-item-action py-3 lh-tight" id="noResults" style="display:none;">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="text-muted text-center">Sorry, we couldn't find any matches for your search.</span>
                    </div>
                </div>

                @foreach($members as $member)
                    <a href="#"
                       id="{{ $member->id }}"
                       class="sanggunian-member-item list-group-item list-group-item-action list-group-members-item py-3 lh-tight"
                       aria-current="true"
                       data-search-content="{{ Str::of($member->fullname)->snake() }}">
                        <div class="d-flex align-items-center justify-content-start">
                            {{--                            <img class="img-fluid rounded-circle"--}}
                            {{--                                 src="{{ asset('storage/user-images/' . $member->profile_picture) }}"--}}
                            {{--                                 width="50px">--}}
                            <strong class="mb-1 mx-2">{{ $member->fullname }}</strong>
                        </div>
                        <div class="ms-2 d-none">
                            @foreach($member->agenda_chairman as $chairman)
                                <div class="card-title border-bottom  mb-1 mt-1 small">
                                    Chairman <span
                                        class="text-lowercase">of</span> <strong
                                        class="sanggunian-member-committee">{{ $chairman->title }}</strong></div>
                            @endforeach
                            @foreach($member->agenda_vice_chairman as $vice_chairman)
                                <div
                                    class="card-title border-bottom col-10 mb-1 mt-1 small">
                                    Vice Chairman <span
                                        class="text-lowercase">of</span> <strong
                                        class="sanggunian-member-committee">{{ $vice_chairman->title }}</strong>
                                </div>
                            @endforeach
                            @foreach($member->agenda_member as $agendaMember)
                                <div
                                    class="col-10 mb-1 border-bottom mt-1 small card-title">
                                    Member
                                    <span class="text-lowercase">of</span>
                                    <strong
                                        class="sanggunian-member-committee">{{ $agendaMember->agenda->title }}</strong>
                                </div>
                            @endforeach
                            @foreach($member->expanded_agenda_chairman as $expandedAgendaChairman)
                                <div
                                    class="card-title col-10 mb-1 mt-1 small border-bottom">
                                    Chairman <span
                                        class="text-lowercase">of</span> Expanded
                                    Committee <strong
                                        class="sanggunian-member-committee">{{ $expandedAgendaChairman->title }}</strong>
                                </div>
                            @endforeach
                            @foreach($member->expanded_agenda_vice_chairman as $expandedAgendaViceChairman)
                                <div
                                    class="col-10 mb-1 mt-1 small card-title border-bottom">
                                    Vice Chairman <span
                                        class="text-lowercase">of</span> Expanded
                                    Committee <strong
                                        class="sanggunian-member-committee">{{ $expandedAgendaViceChairman->title }}</strong>
                                </div>
                            @endforeach
                            @foreach($member->expanded_agenda_member as $expandedMember)
                                <div
                                    class="col-10 mb-1 mt-1 small card-title border-bottom">
                                    Member <span
                                        class="text-lowercase">of</span> Expanded
                                    Committee <strong
                                        class="sanggunian-member-committee">{{ $expandedMember->agenda->title }}</strong>
                                </div>
                            @endforeach
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-10 p-0 col-sm-12" id="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-0 border-0 p-0" style="min-height:94.5vh;" id="committeeDocuments">
                    <div class="card-body">
                        <div
                            class="header d-flex flex-row align-items-center justify-content-center border border-start-0 border-end-0 border-top-0 border-5 border-dark mb-3">
                            <img width="8%" src="{{ asset('session/logo.png') }}" alt="" class="me-auto">
                            <div class="d-flex flex-column align-items-center">
                                <span class="h6">Republic of the Philippines</span>
                                <h5 class="fw-bold text-dark">PROVINCE OF SURIGAO DEL SUR</h5>
                                <h5 class="text-dark">Tandag City</h5>
                                <h3 class="fw-bold text-dark">TANGGAPAN NG SANGGUNIANG PANLALAWIGAN</h3>
                                <h5 class="text-dark">(Office of the Provincial Council)</h5>
                            </div>
                            <img width="9.5%" src="{{ asset('assets/tsp.png') }}" alt="" class="ms-auto">
                        </div>
                        <div class="text-center">
                            <h4 class="fw-medium" style="letter-spacing : 1.8px;">
                                SCHEDULE OF COMMITTEE MEETINGS
                                <h4 class="fw-bold text-uppercase text-decoration-underline">
                                    {{ $schedules?->first()?->first()?->venue }}
                                </h4>
                            </h4>
                        </div>

                        @foreach ($schedules as $index => $grouppedSchedules)
                            <div id="{{ $index }}" class="schedule-container">
                                @foreach ($grouppedSchedules as $key => $schedule)
                                    @if (
                                        $key === 0 ||
                                            $schedule->date_and_time->format('Y-m-d') !== $grouppedSchedules[$key - 1]->date_and_time->format('Y-m-d'))
                                        <h5 class="fw-medium text-center mt-5">
                                    <span class="text-uppercase">
                                        @if ($schedule->date_and_time->hour === 0)
                                            {{ $schedule->date_and_time->format('F d, Y') }}
                                        @else
                                            {{ $schedule->date_and_time->format('F d, Y @ h:i A') }}
                                        @endif
                                    </span>
                                            <p class="">{{ $schedule->description }}</p>
                                        </h5>
                                        @php $countIndex = 1; @endphp
                                    @endif

                                    @if ($schedule->with_invited_guest == 1)
                                        <h5 class="fw-medium text-uppercase text-center mt-3"
                                            style="letter-spacing : 1.8px;">
                                            COMMITTEE WITH INVITED GUESTS
                                        </h5>
                                        <div class="kanban-column w-100">
                                            <ol class="kanban-cards" id="{{ $schedule->id }}">
                                                @foreach ($schedule->committees as $committee)
                                                    <li class="kanban-card" data-id="{{ $committee->id }}">
                                                        <a target="_blank"
                                                           href="{{ route('committee-file.show', $committee) }}"
                                                           class="kanban-content">
                                                    <span class="text-dark">
                                                        <span class="count-index">{{ $countIndex }}. </span>
                                                        {{ $committee->lead_committee_information->title }} /
                                                        {{ $committee->expanded_committee_information->title }}
                                                    </span>
                                                        </a>
                                                        @php $countIndex++; @endphp
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    @else
                                        <h5 class="fw-medium text-uppercase text-center mt-3"
                                            style="letter-spacing : 1.8px;">
                                            COMMITTEE WITHOUT INVITED GUESTS
                                        </h5>
                                        <div class="kanban-column w-100">
                                            <ol class="kanban-cards" id="{{ $schedule->id }}">
                                                @foreach ($schedule->committees as $committee)
                                                    <li class="kanban-card" data-id="{{ $committee->id }}">
                                                        <a target="_blank"
                                                           href="{{ route('committee-file.show', $committee) }}"
                                                           class="kanban-content">
                                                    <span class="text-dark">
                                                        <span class="count-index">{{ $countIndex }}. </span>
                                                        {{ $committee->lead_committee_information->title }} /
                                                        {{ $committee->expanded_committee_information->title }}
                                                    </span>
                                                        </a>
                                                        @php $countIndex++; @endphp
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const searchField = document.querySelector('#searchField');
    const listItems = document.querySelectorAll('.list-group-members-item');
    const noResults = document.querySelector('#noResults');

    (function () {
        let committeeDocuments = document.querySelector('#committeeDocuments');
        let widget = document.querySelector('#spMemberWidget');
        widget.style.height = committeeDocuments.offsetHeight + 70 + 'px';
    }());


    searchField.addEventListener('input', () => {
        const searchTerm = searchField.value.trim().toLowerCase();
        let foundMatch = false;
        listItems.forEach((item) => {
            const searchContent = item.getAttribute('data-search-content');
            if (searchContent.indexOf(searchTerm) !== -1) {
                item.style.display = 'block';
                foundMatch = true;
            } else {
                item.style.display = 'none';
            }
        });
        if (foundMatch) {
            noResults.style.display = 'none';
        } else {
            noResults.style.display = 'block';
        }
    });


    document.querySelectorAll('.sanggunian-member-item').forEach((item) => {


        item.addEventListener('click', function (e) {
            let currentElement = e.currentTarget;

            document.querySelectorAll('.sanggunian-member-item').forEach((element) => {
                if (element.getAttribute('id') != currentElement.getAttribute('id')) {
                    element.classList.remove('bg-dark');
                    element.classList.remove('text-white');
                }
            });

            currentElement.classList.toggle('bg-dark');
            currentElement.classList.toggle('text-white');

            let committees = [];
            item.querySelectorAll('.sanggunian-member-committee').forEach((committee) => {
                committees.push(committee.innerText);
            });
            const cards = document.querySelectorAll('li.kanban-card');
            cards.forEach((card) => {
                const contentElement = card.querySelector('.kanban-content');
                // Remove any existing highlighting
                contentElement.querySelectorAll('.highlighted-text').forEach((highlighted) => {
                    highlighted.outerHTML = highlighted.innerHTML;
                });
                committees.forEach((committee) => {
                    if (contentElement.innerText.toLowerCase().includes(committee.toLowerCase())) {
                        if (currentElement.classList.contains('bg-dark')) {
                            const highlightedText = contentElement.innerHTML.replace(new RegExp(committee, 'gi'), '<span class="highlighted-text">$&</span>');
                            contentElement.innerHTML = highlightedText;
                        }
                    }
                });
            });
        });
    });

</script>
</body>
</html>
