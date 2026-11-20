@extends('admin.layouts.master')
@section('title', 'USM-AES | CEE - Create Reservation')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/assets/choices/choices.min.css') }}">
@endpush
@section('contents')
<div class="py-4"><h5 class="text-lg font-bold">Create CEE Reservation</h5><p class="text-sm text-slate-500">Reserve an examination slot on behalf of an applicant.</p></div>
@if(session('message'))<div role="alert" class="card p-4">{{ session('message') }}</div>@endif
@if($errors->any())<div role="alert" class="card p-4 text-red-600"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
@if($ceeSession)
<div class="card p-4 mb-4"><strong>{{ $ceeSession->name }}</strong><p class="text-sm">Review all details before submitting. Select an examination batch and assign an available room manually.</p></div>
<div class="overflow-hidden bg-white border shadow-sm card rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">
<div class="px-6 py-5 border-b border-slate-200"><h6 class="text-lg font-bold">Reservation Details</h6><p class="text-sm text-slate-500">Choose the applicant, priority programs, examination batch, and room.</p></div><div class="p-6">
<form id="reservation-form" action="{{ route('admin.reserve.store') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="ceesession" value="{{ $ceeSession->id }}" readonly>

                                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

<div class="xl:col-span-12">
<label for="user-select" class="inline-block mb-2 text-sm font-semibold">Search applicant <span class="text-red-500">*</span></label>
<select id="user-select" name="user" required data-reservation-search class="form-input">
<option value="">Choose applicant</option>
@foreach($users as $user)
<option value="{{ $user->id }}" @selected((string) old('user') === (string) $user->id) data-fullname="{{ $user->fullname }}" data-userlrn="{{ $user->lrn }}" data-firstname="{{ $user->firstname }}" data-lastname="{{ $user->lastname }}" data-birthdate="{{ $user->birthdate }}">{{ $user->fullname }} - {{ $user->lrn }}</option>
@endforeach
</select></div>
<div class="xl:col-span-4"><label for="fullname" class="inline-block mb-2 text-sm font-semibold">Full name</label><input id="fullname" class="form-input" readonly></div>
<div class="xl:col-span-4"><label for="lrn" class="inline-block mb-2 text-sm font-semibold">LRN</label><input id="lrn" class="form-input" readonly></div>
<div class="xl:col-span-4"><label for="is_repeat_exam" class="inline-block mb-2 text-sm font-semibold">CEE Retaker?</label><input id="is_repeat_exam" class="form-input" readonly></div>
                                        {{-- Priority Programs Header --}}
                                        <div class="pt-2 xl:col-span-12">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex items-center justify-center rounded-xl size-10 bg-sky-100 text-sky-600 dark:bg-sky-500/20 dark:text-sky-300">
                                                    <i data-lucide="graduation-cap" class="size-5"></i>
                                                </div>
                                                <div>
                                                    <h6
                                                        class="text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                                        Priority Programs
                                                    </h6>
                                                    <p class="text-sm text-slate-500 dark:text-zink-300">
                                                        Choose your first, second, and third priority programs.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- First Priority --}}
                                        <div class="xl:col-span-4">
                                            <label for="campus-select"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Select Campus <span class="text-red-500">*</span>
                                            </label>
                                            <select id="campus-select" name="campus" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100" required>
                                                <option selected disabled>Choose Campus</option>
                                                @foreach ($campusNames as $campusName)
                                                    <option value="{{ $campusName->real_campus_id }}"
                                                        data-termid="{{ $campusName->termid }}">
                                                        {{ $campusName->campus_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="xl:col-span-8">
                                            <label for="program-select"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                First Priority Program <span class="text-red-500">*</span>
                                            </label>
                                            <select id="program-select" name="firstprioprog" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100" required>
                                                <option selected disabled>Choose Program</option>
                                            </select>
                                            <input type="hidden" name="firstprioprog_desc" id="firstprioprog_desc">
                                            <input type="hidden" name="firstprogram_policy_id"
                                                id="firstprogram_policy_id">
                                        </div>

                                        {{-- Second Priority --}}
                                        <div class="xl:col-span-4">
                                            <label for="campus-select2"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Select Campus <span class="text-red-500">*</span>
                                            </label>
                                            <select id="campus-select2" name="campus2" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100" required>
                                                <option selected disabled>Choose Campus</option>
                                                @foreach ($campusNames as $campusName)
                                                    <option value="{{ $campusName->real_campus_id }}"
                                                        data-termid="{{ $campusName->termid }}">
                                                        {{ $campusName->campus_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="xl:col-span-8">
                                            <label for="program-select2"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Second Priority Program <span class="text-red-500">*</span>
                                            </label>
                                            <select id="program-select2" name="secondprioprog" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100" required>
                                                <option selected disabled>Choose Program</option>
                                            </select>
                                            <input type="hidden" name="secondprioprog_desc" id="secondprioprog_desc">
                                            <input type="hidden" name="secondprogram_policy_id"
                                                id="secondprogram_policy_id">
                                        </div>

                                        {{-- Third Priority --}}
                                        <div class="xl:col-span-4">
                                            <label for="campus-select3"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Select Campus <span class="text-red-500">*</span>
                                            </label>
                                            <select id="campus-select3" name="campus3" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100" required>
                                                <option selected disabled>Choose Campus</option>
                                                @foreach ($campusNames as $campusName)
                                                    <option value="{{ $campusName->real_campus_id }}"
                                                        data-termid="{{ $campusName->termid }}">
                                                        {{ $campusName->campus_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="xl:col-span-8">
                                            <label for="program-select3"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Third Priority Program <span class="text-red-500">*</span>
                                            </label>
                                            <select id="program-select3" name="thirdprioprog" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100" required>
                                                <option selected disabled>Choose Program</option>
                                            </select>
                                            <input type="hidden" name="thirdprioprog_desc" id="thirdprioprog_desc">
                                            <input type="hidden" name="thirdprogram_policy_id"
                                                id="thirdprogram_policy_id">
                                        </div>

                                        {{-- Examination Assignment Header --}}
                                        <div class="pt-2 xl:col-span-12">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex items-center justify-center text-green-600 bg-green-100 rounded-xl size-10 dark:bg-green-500/20 dark:text-green-300">
                                                    <i data-lucide="map-pinned" class="size-5"></i>
                                                </div>
                                                <div>
                                                    <h6
                                                        class="text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                                        Examination Assignment
                                                    </h6>
                                                    <p class="text-sm text-slate-500 dark:text-zink-300">
                                                        Select your preferred examination venue.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

<div class="xl:col-span-6">
<label for="ceeexamsession" class="inline-block mb-2 text-sm font-semibold">USMCEE Batch <span class="text-red-500">*</span></label>
<select id="ceeexamsession" name="ceeexamsession" required data-reservation-search class="form-input">
<option value="">Choose examination batch</option>
@foreach($batches as $batch)<option value="{{ $batch }}" @selected(old('ceeexamsession') === $batch)>{{ $batch }}</option>@endforeach
</select></div>
<div class="xl:col-span-6">
<label for="room-select" class="inline-block mb-2 text-sm font-semibold">Room Assignment <span class="text-red-500">*</span></label>
<select id="room-select" name="room" required data-reservation-search class="form-input"><option value="">Choose a batch first</option></select>
<p id="room-status" class="mt-2 text-sm text-slate-500" role="status" aria-live="polite">Only active rooms with available slots are listed.</p>
</div>
                                        <div class="flex justify-end gap-3 pt-2 xl:col-span-12">
                                            <button type="button" onclick="window.location.href = @js(route('admin.reservation.index'))"
                                                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-red-600 transition-all duration-200 bg-white border border-red-200 rounded-xl hover:bg-red-50 dark:bg-zink-700 dark:border-red-500/20 dark:text-red-300 dark:hover:bg-red-500/10">
                                                <i data-lucide="x" class="size-4"></i>
                                                Cancel
                                            </button>

                                            <button type="submit"
                                                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                <i data-lucide="check" class="size-4"></i>
                                                Submit Reservation
                                            </button>
                                        </div>
                                    </div>
                                </form>
</div></div>
@else
<div class="card p-5" role="status">There is no active CEE session. Activate a session before creating reservations.</div>
@endif
@endsection
@push('scripts')
<script src="{{ asset('backend/assets/swal/sweetalert2@11.js') }}"></script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!document.getElementById('reservation-form')) return;
            const campusSelect1 = document.getElementById('campus-select');
            const programSelect1 = document.getElementById('program-select');
            const firstPriorityDescInput = document.getElementById('firstprioprog_desc');
            const firstprogram_policy_id_Input = document.getElementById('firstprogram_policy_id');

            const campusSelect2 = document.getElementById('campus-select2');
            const programSelect2 = document.getElementById('program-select2');
            const secondPriorityDescInput = document.getElementById('secondprioprog_desc');
            const secondprogram_policy_id_Input = document.getElementById('secondprogram_policy_id');

            const campusSelect3 = document.getElementById('campus-select3');
            const programSelect3 = document.getElementById('program-select3');
            const thirdPriorityDescInput = document.getElementById('thirdprioprog_desc');
            const thirdprogram_policy_id_Input = document.getElementById('thirdprogram_policy_id');


            const users = new Map(Array.from(document.getElementById('user-select').options, option => [option.value, {...option.dataset}]));
            const searchableSelects = new Map();
            const campusTerms = new Map();
            const programDetails = new Map();
            [campusSelect1, campusSelect2, campusSelect3].filter(Boolean).forEach(select => {
                campusTerms.set(select, new Map(Array.from(select.options, option => [option.value, option.dataset.termid])));
            });
            document.querySelectorAll('[data-reservation-search]').forEach(select => {
                searchableSelects.set(select, new Choices(select, {
                    searchEnabled: true,
                    searchPlaceholderValue: 'Type to search...',
                    shouldSort: false,
                    itemSelectText: '',
                    allowHTML: false,
                }));
            });

            function replacePrograms(select, options) {
                const choices = searchableSelects.get(select);
                choices.removeActiveItems();
                choices.clearChoices();
                choices.setChoices(options, 'value', 'label', true);
            }

            function loadPrograms(campusSelect, programSelect) {
                const realCampusId = campusSelect.value;
                const termId = campusTerms.get(campusSelect)?.get(realCampusId);

                if (!realCampusId || !termId) return; // Exit if missing values

                programDetails.set(programSelect, new Map());
                replacePrograms(programSelect, [{ value: '', label: 'Please wait...', selected: true, disabled: true }]);

                document.getElementById(programSelect.id === 'program-select' ? 'firstprioprog_desc' : programSelect.id === 'program-select2' ? 'secondprioprog_desc' : 'thirdprioprog_desc').value = '';
                document.getElementById(programSelect.id === 'program-select' ? 'firstprogram_policy_id' : programSelect.id === 'program-select2' ? 'secondprogram_policy_id' : 'thirdprogram_policy_id').value = '';
                fetch(`/admin/cee/get-programs-by-campus?termId=${encodeURIComponent(termId)}&realCampusId=${encodeURIComponent(realCampusId)}`)
                    .then(response => { if (!response.ok) throw new Error('Unable to load programs'); return response.json(); })
                    .then(data => {
                        if (campusSelect.value !== realCampusId) return;
                        programDetails.set(programSelect, new Map(data.map(program => [String(program.programId), program])));
                        replacePrograms(programSelect, [
                            { value: '', label: 'Choose Program', selected: true, disabled: true },
                            ...data.map(program => ({
                                value: String(program.programId),
                                label: program.majorDiscDesc ? `${program.programName} - ${program.majorDiscDesc}` : program.programName,
                            }))
                        ]);
                    })
                    .catch(error => {
                        console.error('Error loading programs:', error);
                        if (campusSelect.value !== realCampusId) return;
                        replacePrograms(programSelect, [{ value: '', label: 'Error loading programs', selected: true, disabled: true }]);
                    });
            }

            campusSelect1.addEventListener('change', () => loadPrograms(campusSelect1, programSelect1));
            campusSelect2.addEventListener('change', () => loadPrograms(campusSelect2, programSelect2));
            campusSelect3.addEventListener('change', () => loadPrograms(campusSelect3, programSelect3));

            // Update priority description inputs when a program is selected
            programSelect1.addEventListener('change', () => {
                const program = programDetails.get(programSelect1)?.get(programSelect1.value);
                firstPriorityDescInput.value = program?.programName ?? '';
                firstprogram_policy_id_Input.value = program?.id ?? '';
            });

            programSelect2.addEventListener('change', () => {
                const program = programDetails.get(programSelect2)?.get(programSelect2.value);
                secondPriorityDescInput.value = program?.programName ?? '';
                secondprogram_policy_id_Input.value = program?.id ?? '';
            });

            programSelect3.addEventListener('change', () => {
                const program = programDetails.get(programSelect3)?.get(programSelect3.value);
                thirdPriorityDescInput.value = program?.programName ?? '';
                thirdprogram_policy_id_Input.value = program?.id ?? '';
            });

            const userSelect = document.getElementById('user-select');
            let applicantRequest = 0;
            async function selectApplicant() {
                const token = ++applicantRequest;
                const user = users.get(userSelect.value) ?? {};
                document.getElementById('fullname').value = user.fullname ?? '';
                document.getElementById('lrn').value = user.userlrn ?? '';
                const retaker = document.getElementById('is_repeat_exam');
                retaker.value = '';
                if (!user.firstname || !user.lastname || !user.birthdate) return;
                try {
                    const params = new URLSearchParams({firstname: user.firstname, lastname: user.lastname, birthdate: user.birthdate});
                    const response = await fetch(@js(route('admin.reservation.create.validate-type')) + '?' + params);
                    if (!response.ok) throw new Error('Unable to check applicant type');
                    const data = await response.json();
                    if (token === applicantRequest) retaker.value = data.isRetaker ? 'Yes' : 'No';
                } catch (error) { if (token === applicantRequest) retaker.value = 'Checked when saved'; }
            }
            userSelect.addEventListener('change', selectApplicant);
            selectApplicant();
            const batchSelect = document.getElementById('ceeexamsession');
            const roomSelect = document.getElementById('room-select');
            const roomChoices = searchableSelects.get(roomSelect);
            const roomStatus = document.getElementById('room-status');
            let roomRequest = 0;
            async function loadRooms() {
                const token = ++roomRequest;
                replacePrograms(roomSelect, [{value: '', label: batchSelect.value ? 'Loading rooms...' : 'Choose a batch first', selected: true}]);
                roomChoices.disable();
                roomStatus.textContent = 'Only active rooms with available slots are listed.';
                if (!batchSelect.value) return;
                try {
                    const response = await fetch(@js(route('admin.res.rooms.by-exam-session')) + '?ceesession=' + encodeURIComponent(batchSelect.value));
                    if (!response.ok) throw new Error('Unable to load rooms');
                    const rooms = await response.json();
                    if (token !== roomRequest) return;
                    replacePrograms(roomSelect, [{value: '', label: rooms.length ? 'Choose room' : 'No available rooms', selected: true}, ...rooms.map(room => ({
                        value: String(room.id), label: `${room.campus} / ${room.college_name} / ${room.room_name} - ${room.schedule ?? ''} ${room.time ?? ''} (${room.capacity} slots)`
                    }))]);
                    roomChoices.enable();
                    const previousRoom = @js((string) old('room', ''));
                    if (rooms.some(room => String(room.id) === previousRoom)) roomChoices.setChoiceByValue(previousRoom);
                    roomStatus.textContent = rooms.length ? 'Choose a room manually. Availability is rechecked when saved.' : 'No active rooms have available slots in this batch.';
                } catch (error) {
                    if (token !== roomRequest) return;
                    replacePrograms(roomSelect, [{value: '', label: 'Unable to load rooms', selected: true}]);
                    roomStatus.textContent = 'Room loading failed. Reselect the batch to try again.';
                }
            }
            batchSelect.addEventListener('change', loadRooms);
            loadRooms();
            const form = document.getElementById('reservation-form');
            let confirming = false;
            form.addEventListener('submit', async event => {
                event.preventDefault();
                if (confirming || !form.reportValidity()) return;
                if (!roomSelect.value) { Swal.fire({icon: 'warning', title: 'Choose an available room first'}); return; }
                confirming = true;
                const result = await Swal.fire({title: 'Create reservation?', text: 'Confirm the applicant, priority programs, examination batch and manually assigned room.', icon: 'question', showCancelButton: true, confirmButtonText: 'Save reservation'});
                if (result.isConfirmed) {
                    form.querySelector('[type="submit"]').disabled = true;
                    HTMLFormElement.prototype.submit.call(form);
                } else { confirming = false; }
            });
        });

</script>
@endpush
