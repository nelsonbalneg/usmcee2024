<?php

namespace Tests\Feature;

use App\Models\Announcement;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class StudentAnnouncementsTest extends TestCase
{
    public function test_only_current_student_announcements_are_selected(): void
    {
        if (!extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('PDO SQLite is required for the isolated database test.');
        }
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('visibility');
            $table->timestamp('publish_at')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->softDeletes();
        });
        $this->travelTo(now()->startOfSecond());
        $base = ['status' => 'published', 'visibility' => 'students', 'publish_at' => null, 'expire_at' => null, 'deleted_at' => null];
        foreach ([[], ['visibility' => 'public'], ['status' => 'scheduled', 'publish_at' => now()->subMinute()], ['expire_at' => now()->addMinute()], ['status' => 'draft'], ['status' => 'archived'], ['visibility' => 'employees'], ['expire_at' => now()], ['expire_at' => now()->subMinute()], ['publish_at' => now()->addMinute()], ['deleted_at' => now()]] as $changes) {
            DB::table('announcements')->insert(array_replace($base, $changes));
        }
        $this->assertSame([1, 2, 3, 4], Announcement::visibleToStudents()->orderBy('id')->pluck('id')->all());
        $this->travelBack();
    }

    public function test_modal_lists_every_announcement_and_is_absent_when_empty(): void
    {
        $announcements = collect([
            new Announcement(['title' => 'First notice', 'content' => 'First body', 'content_format' => 'plain_text']),
            new Announcement(['title' => 'Second notice', 'content' => '**Second body**', 'content_format' => 'markdown']),
        ]);
        $html = view('student.partials.announcements-modal', compact('announcements'))->render();
        $this->assertStringContainsString('First notice', $html);
        $this->assertStringContainsString('Second notice', $html);
        $this->assertStringContainsString('<strong>Second body</strong>', $html);
        $this->assertStringNotContainsString('<dialog', view('student.partials.announcements-modal', ['announcements' => collect()])->render());
    }

    public function test_html_content_removes_scripts_and_unsafe_links(): void
    {
        $announcement = new Announcement(['content_format' => 'html', 'content' => '<p onclick="alert(1)">Notice</p><script>alert(1)</script><a href="javascript:alert(1)">Unsafe</a><a href="https://example.com">Safe</a>']);
        $html = $announcement->renderedContent();
        $this->assertStringContainsString('<p>Notice</p>', $html);
        $this->assertStringContainsString('href="https://example.com"', $html);
        $this->assertStringNotContainsString('alert', $html);
    }

    public function test_shared_images_use_the_student_route_for_markdown_and_html(): void
    {
        $url = 'https://cee-admin.test/admin/announcements/media/example.png';
        foreach (['markdown' => '![Example]('.$url.')', 'html' => '<img src="'.$url.'" alt="Example" onerror="alert(1)">'] as $format => $content) {
            $announcement = new Announcement(['content_format' => $format, 'content' => $content]);
            $announcement->id = 123;
            $html = $announcement->renderedContent();
            $this->assertStringContainsString('/student/announcements/123/images/media/example.png', $html);
            $this->assertStringNotContainsString('cee-admin.test', $html);
            $this->assertStringNotContainsString('onerror', $html);
        }
    }
}
