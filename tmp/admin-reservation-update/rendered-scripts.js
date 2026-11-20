

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
                    ...(select.id === 'user-select' ? {searchChoices: false, searchFloor: 2, searchResultLimit: 25, renderChoiceLimit: 25, noChoicesText: 'Type at least 2 characters to search', noResultsText: 'No matching applicants'} : {}),
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
            const applicantChoices = searchableSelects.get(userSelect);
            const searchStatus = document.getElementById('applicant-search-status');
            let searchTimer;
            let searchController;
            let searchVersion = 0;
            userSelect.addEventListener('search', event => {
                const term = (event.detail.value ?? '').trim();
                clearTimeout(searchTimer);
                searchController?.abort();
                const version = ++searchVersion;
                // Keep the selected applicant while replacing only the search results.
                applicantChoices.clearChoices();
                const selected = users.get(userSelect.value);
                users.clear();
                if (selected) users.set(userSelect.value, selected);
                if (term.length < 2) {
                    searchStatus.textContent = 'Type at least 2 characters to search.';
                    return;
                }
                searchStatus.textContent = 'Searching applicants...';
                searchTimer = setTimeout(async () => {
                    searchController = new AbortController();
                    try {
                        const response = await fetch('http:\/\/127.0.0.1:8000\/admin\/reservation\/create-reservation\/search-applicants' + '?q=' + encodeURIComponent(term), {signal: searchController.signal, headers: {'Accept': 'application/json'}});
                        if (!response.ok) throw new Error('Unable to search applicants');
                        const data = await response.json();
                        if (version !== searchVersion) return;
                        data.users.forEach(user => users.set(String(user.id), {...user, userlrn: user.lrn}));
                        applicantChoices.setChoices(data.users.filter(user => String(user.id) !== userSelect.value).map(user => ({value: String(user.id), label: `${user.fullname} - ${user.lrn}`})), 'value', 'label', true);
                        searchStatus.textContent = data.users.length === 25 ? 'Showing 25 matches. Type more characters to narrow your search.' : data.users.length ? `${data.users.length} matching applicants.` : 'No eligible applicants found.';
                    } catch (error) {
                        if (error.name === 'AbortError' || version !== searchVersion) return;
                        searchStatus.textContent = 'Applicant search failed. Please type again to retry.';
                    }
                }, 300);
            });
            window.addEventListener('pagehide', () => { clearTimeout(searchTimer); searchController?.abort(); }, {once: true});
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
                    const response = await fetch('http:\/\/127.0.0.1:8000\/admin\/reservation\/create-reservation\/validate-type' + '?' + params);
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
                    const response = await fetch('http:\/\/127.0.0.1:8000\/admin\/cee\/rooms-by-session\/res' + '?ceesession=' + encodeURIComponent(batchSelect.value));
                    if (!response.ok) throw new Error('Unable to load rooms');
                    const rooms = await response.json();
                    if (token !== roomRequest) return;
                    replacePrograms(roomSelect, [{value: '', label: rooms.length ? 'Choose room' : 'No available rooms', selected: true}, ...rooms.map(room => ({
                        value: String(room.id), label: `${room.campus} / ${room.college_name} / ${room.room_name} - ${room.schedule ?? ''} ${room.time ?? ''} (${room.capacity} slots)`
                    }))]);
                    roomChoices.enable();
                    const previousRoom = '';
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

