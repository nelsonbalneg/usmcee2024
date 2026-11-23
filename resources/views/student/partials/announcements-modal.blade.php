@if ($announcements->isNotEmpty())
    <button type="button" id="openAnnouncements" class="mb-5 text-white bg-green-500 btn hover:bg-green-600">
        Announcements ({{ $announcements->count() }})
    </button>
    <dialog id="announcementsModal" aria-labelledby="announcementsTitle" class="w-full max-w-3xl p-0 rounded-2xl bg-white text-slate-800 dark:bg-zink-800 dark:text-zink-100">
        <div class="flex items-center justify-between gap-4 p-5 border-b border-slate-200 dark:border-zink-700">
            <h2 id="announcementsTitle" class="text-xl font-bold">Announcements</h2>
            <button type="button" id="closeAnnouncements" autofocus class="btn border border-slate-200" aria-label="Close announcements">Close</button>
        </div>
        <div class="announcements-modal-body p-5 space-y-5 overflow-y-auto">
            @foreach ($announcements as $announcement)
                <article class="p-5 border rounded-xl border-slate-200 dark:border-zink-700">
                    <h3 class="mb-2 text-lg font-semibold">{{ $announcement->title }}</h3>
                    @if ($announcement->publish_at)
                        <p class="mb-3 text-sm text-slate-500 dark:text-zink-300">{{ $announcement->publish_at->format('F j, Y g:i A') }}</p>
                    @endif
                    @if ($announcement->summary)
                        <p class="mb-3 font-medium">{{ $announcement->summary }}</p>
                    @endif
                    <div class="student-announcement-content">{!! $announcement->renderedContent() !!}</div>
                </article>
            @endforeach
        </div>
    </dialog>
    @push('styles')
        <style>
            #announcementsModal {
                position: fixed;
                inset: 0;
                margin: 0 auto;
                height: 100vh;
                height: 100dvh;
                max-height: none;
                overflow: hidden;
                border-radius: 0;
            }
            #announcementsModal[open] { display: flex; flex-direction: column; }
            #announcementsModal > :first-child { flex-shrink: 0; }
            #announcementsModal .announcements-modal-body { flex: 1; min-height: 0; }
            #announcementsModal::backdrop { background: rgb(15 23 42 / .6); }
            .student-announcement-content { overflow-wrap: anywhere; line-height: 1.7; }
            .student-announcement-content p { margin: .75em 0; }
            .student-announcement-content ul { list-style: disc; padding-left: 1.5em; }
            .student-announcement-content ol { list-style: decimal; padding-left: 1.5em; }
            .student-announcement-content a { color: #2563eb; text-decoration: underline; }
            .student-announcement-content pre { overflow: auto; }
            .student-announcement-content img { display: block; max-width: 100%; height: auto; margin: 1em 0; }
            .student-announcement-content h1, .student-announcement-content h2, .student-announcement-content h3 { font-weight: 700; margin: .75em 0; }
        </style>
    @endpush
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('announcementsModal');
                document.getElementById('openAnnouncements').addEventListener('click', () => modal.showModal());
                document.getElementById('closeAnnouncements').addEventListener('click', () => modal.close());
                modal.addEventListener('click', event => { if (event.target === modal) modal.close(); });
                modal.showModal();
            });
        </script>
    @endpush
@endif
