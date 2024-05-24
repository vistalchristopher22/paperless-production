@extends('layouts.app-2')
@prepend('page-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endprepend
@section('tab-title', 'Edit Agenda')
@section('content')
    @if (Session::has('success'))
        <div class="card mb-2 bg-success shadow-sm text-white">
            <div class="card-body">
                {{ Session::get('success') }}
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-light p-3 justify-content-between align-items-center d-flex">
            <h6 class="card-title h6 fw-medium">Edit Committee</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('agendas.update', $agenda) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="text" class="form-control d-none" name="index"
                           value="{{ old('index', $agenda->index) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           value="{{ old('title', $agenda->title) }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="chairman" class="form-label">Chairman</label>
                    <div class="@error('chairman') rounded border border-danger @enderror">
                        <select name="chairman" class="form-select">
                            @foreach ($members as $member)
                                <option
                                    {{ $agenda->chairman == $member->id ? 'selected' : '' }} value="{{ $member->id }}">
                                    {{ $member->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('chairman')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Vice Chairman</label>
                    <div class="@error('vice_chairman') rounded border border-danger @enderror">
                        <select name="vice_chairman" class="form-select">
                            @foreach ($members as $member)
                                <option {{ $agenda->vice_chairman == $member->id ? 'selected' : '' }}
                                        value="{{ $member->id }}">{{ $member->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('vice_chairman')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label text-dark">Sanggunian</label>
                    <input type="text" class="form-control @error('sanggunian') is-invalid @enderror" name="sanggunian"
                           value="{{ old('sanggunian', (int) $member->sanggunian ?? \App\Repositories\SettingRepository::getValueByName('current_sanggunian')) }}">
                    @error('sanggunian')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Members</label>
                    <div class="@error('members') rounded border border-danger @enderror">
                        <select name="members[]" class="js-example-basic-multiple js-states form-select" multiple>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('members')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="btn btn-dark fw-medium btn-md float-end mt-3">Update</button>
                </div>
            </form>
        </div>
    </div>
    @push('page-scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                let agendaMembers = @json($agendaMembers);

                let multipleMembers = $('select[name="members[]"]').select2({
                    placeholder: 'Select members',
                });

                multipleMembers.val(agendaMembers).trigger('change');

                $('select[name="vice_chairman"]').select2({
                    placeholder: 'Select Vice chairman',
                });

                $('select[name="chairman"]').select2({
                    placeholder: 'Select Chairman',
                });

                $("select").on("select2:select", function (evt) {
                    var element = evt.params.data.element;
                    var $element = $(element);

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");
                });
            });
        </script>
    @endpush
@endsection
