<?php

namespace Tests\Feature;

use App\Models\PastCeeData;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminManualReservationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'manual_test', 'database.connections.manual_test' => [
            'driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '',
        ], 'session.driver' => 'array']);
        $this->withoutMiddleware();
        Carbon::setTestNow(Carbon::parse('2026-11-20', 'Asia/Manila'));
        Schema::create('cee_sessions', function (Blueprint $t) { $t->id(); $t->string('status'); });
        Schema::create('users', function (Blueprint $t) { $t->id(); $t->string('firstname'); $t->string('lastname'); $t->string('birthdate'); $t->string('middlename')->nullable(); $t->string('suffix')->nullable(); $t->string('lrn')->default('123'); });
        Schema::create((new PastCeeData)->getTable(), function (Blueprint $t) { $t->id(); $t->string('firstname'); $t->string('lastname'); $t->string('birthdate'); });
        Schema::create('rooms', function (Blueprint $t) {
            $t->id(); $t->integer('cee_session_id'); $t->string('exam_session'); $t->string('status');
            $t->integer('capacity'); $t->string('room_name'); $t->timestamps();
        });
        Schema::create('operation_logs', function (Blueprint $t) {
            $t->id(); $t->integer('user_id')->nullable(); $t->string('model'); $t->string('action'); $t->text('data'); $t->timestamps();
        });
        Schema::create('reservations', function (Blueprint $t) {
            $t->id(); $t->integer('cee_session_id'); $t->integer('user_id'); $t->string('app_no')->unique();
            $t->integer('checksum')->nullable(); $t->integer('room_id'); $t->timestamps();
            foreach (['campus_id', 'campus_id_prio_prog_2', 'campus_id_prio_prog_3', 'firstpriorty', 'firstpriorty_desc',
                'secondpriorty', 'secondpriority_desc', 'thirdpriorty', 'thirdpriorty_desc', 'firstprogram_policy_id',
                'secondprogram_policy_id', 'thirdprogram_policy_id', 'exam_session', 'is_repeat_exam', 'status'] as $field) {
                $t->string($field)->nullable();
            }
        });
        (require database_path('migrations/2026_11_20_000001_create_reservation_sequences_table.php'))->up();
        DB::table('cee_sessions')->insert([['id' => 3, 'status' => 'active'], ['id' => 4, 'status' => 'inactive']]);
        DB::table('users')->insert(['id' => 1, 'firstname' => 'Test', 'lastname' => 'Applicant', 'birthdate' => '2008-01-01']);
        DB::table('rooms')->insert([
            ['id' => 1, 'cee_session_id' => 3, 'exam_session' => 'Batch 1', 'status' => 'active', 'capacity' => 5, 'room_name' => 'First'],
            ['id' => 2, 'cee_session_id' => 3, 'exam_session' => 'Batch 1', 'status' => 'active', 'capacity' => 2, 'room_name' => 'Manual choice'],
        ]);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow(); DB::purge('manual_test'); parent::tearDown();
    }

    private function reserve(array $overrides = [])
    {
        return $this->post(route('admin.reserve.store'), array_merge([
            'ceesession' => 3, 'user' => 1, 'campus' => '1', 'firstprioprog' => '10', 'secondprioprog' => '20',
            'thirdprioprog' => '30', 'ceeexamsession' => 'Batch 1', 'room' => 2, 'is_repeat_exam' => 'Yes',
        ], $overrides));
    }

    public function test_saves_exact_manual_room_and_decrements_only_that_room(): void
    {
        $this->reserve()->assertRedirect(route('admin.reservation.create.index'));
        $row = DB::table('reservations')->first();
        $this->assertSame(2, (int) $row->room_id);
        $this->assertSame('26300001', $row->app_no);
        $this->assertSame('No', $row->is_repeat_exam);
        $this->assertSame(1, (int) DB::table('rooms')->where('id', 2)->value('capacity'));
        $this->assertSame(5, (int) DB::table('rooms')->where('id', 1)->value('capacity'));
        $this->assertSame(1, DB::table('operation_logs')->where('model', \App\Models\Reservation::class)->where('action', 'created')->count());
        $this->reserve()->assertRedirect();
        $this->assertSame(1, DB::table('reservations')->count());
        $this->assertSame(1, (int) DB::table('rooms')->where('id', 2)->value('capacity'));
    }

    public function test_full_room_is_rejected_without_allocation(): void
    {
        DB::table('rooms')->where('id', 2)->update(['capacity' => 0]);
        $this->reserve()->assertRedirect();
        $this->assertSame(0, DB::table('reservations')->count());
        $this->assertSame(0, DB::table('reservation_sequences')->count());
    }

    public function test_wrong_batch_or_session_or_inactive_room_is_rejected(): void
    {
        foreach ([['exam_session' => 'Batch 2'], ['cee_session_id' => 4], ['status' => 'inactive']] as $change) {
            DB::table('rooms')->where('id', 2)->update(array_merge(['exam_session' => 'Batch 1', 'cee_session_id' => 3, 'status' => 'active'], $change));
            $this->reserve()->assertRedirect();
            $this->assertSame(0, DB::table('reservations')->count());
        }
    }
    private function changeStatus(int $id, string $status)
    {
        return $this->postJson(route('admin.update.reservation.status'), ['id' => $id, 'status' => $status]);
    }

    public function test_cancellation_returns_one_slot_exactly_once_even_when_later_deleted(): void
    {
        $this->reserve();
        $id = (int) DB::table('reservations')->value('id');
        $this->changeStatus($id, 'cancelled')->assertOk();
        $this->assertSame(2, (int) DB::table('rooms')->where('id', 2)->value('capacity'));
        $this->changeStatus($id, 'cancelled')->assertOk();
        $this->deleteJson(route('admin.reservation.destroy', $id))->assertOk();
        $this->assertSame(2, (int) DB::table('rooms')->where('id', 2)->value('capacity'));
        $this->assertSame(1, (int) DB::table('reservation_sequences')->value('last_sequence'));
    }

    public function test_deleting_occupied_reservation_restores_room_and_repeat_delete_cannot_add_again(): void
    {
        $this->reserve();
        $id = (int) DB::table('reservations')->value('id');
        $this->changeStatus($id, 'confirmed')->assertOk();
        $this->assertSame(1, (int) DB::table('rooms')->where('id', 2)->value('capacity'));
        $this->deleteJson(route('admin.reservation.destroy', $id))->assertOk();
        $this->assertSame(2, (int) DB::table('rooms')->where('id', 2)->value('capacity'));
        $this->deleteJson(route('admin.reservation.destroy', $id))->assertNotFound();
        $this->assertSame(2, (int) DB::table('rooms')->where('id', 2)->value('capacity'));
    }

    public function test_reactivation_takes_back_a_slot_and_repeated_active_status_does_not(): void
    {
        $this->reserve();
        $id = (int) DB::table('reservations')->value('id');
        $this->changeStatus($id, 'cancelled')->assertOk();
        $this->changeStatus($id, 'pending')->assertOk();
        $this->changeStatus($id, 'confirmed')->assertOk();
        $this->changeStatus($id, 'pending')->assertOk();
        $this->assertSame(1, (int) DB::table('rooms')->where('id', 2)->value('capacity'));
    }

    public function test_reactivation_with_full_room_or_another_booking_is_rejected(): void
    {
        $this->reserve();
        $id = (int) DB::table('reservations')->value('id');
        $this->changeStatus($id, 'cancelled')->assertOk();
        DB::table('rooms')->where('id', 2)->update(['capacity' => 0]);
        $this->changeStatus($id, 'pending')->assertUnprocessable();
        $this->assertSame('cancelled', DB::table('reservations')->where('id', $id)->value('status'));
        DB::table('rooms')->where('id', 2)->update(['capacity' => 2]);
        $this->reserve();
        $this->changeStatus($id, 'pending')->assertUnprocessable();
        $this->assertSame(1, (int) DB::table('rooms')->where('id', 2)->value('capacity'));
    }

    public function test_failure_to_save_status_rolls_back_returned_capacity(): void
    {
        $this->reserve();
        $id = (int) DB::table('reservations')->value('id');
        $listener = function ($reservation) { throw new \RuntimeException('Simulated audit failure'); };
        $event = 'eloquent.updated: '.\App\Models\Reservation::class;
        app('events')->listen($event, $listener);
        $this->withoutExceptionHandling();
        try {
            $this->changeStatus($id, 'cancelled');
            $this->fail('Expected failure');
        } catch (\RuntimeException $error) {
            $this->assertSame('Simulated audit failure', $error->getMessage());
            $this->assertSame('pending', DB::table('reservations')->where('id', $id)->value('status'));
            $this->assertSame(1, (int) DB::table('rooms')->where('id', 2)->value('capacity'));
        } finally {
            app('events')->forget($event);
            \App\Models\Reservation::clearBootedModels();
        }
    }

    public function test_applicant_search_is_bounded_and_supports_name_tokens_and_lrn(): void
    {
        for ($i = 2; $i <= 40; $i++) {
            DB::table('users')->insert(['id' => $i, 'firstname' => 'Test', 'lastname' => 'Applicant '.$i, 'birthdate' => '2008-01-01', 'lrn' => '900'.$i]);
        }
        $this->getJson(route('admin.reservation.create.search-applicants', ['q' => 'Te']))->assertOk()->assertJsonCount(25, 'users');
        $this->getJson(route('admin.reservation.create.search-applicants', ['q' => 'T']))->assertOk()->assertJsonCount(0, 'users');
        $this->getJson(route('admin.reservation.create.search-applicants', ['q' => 'Applicant, Test']))->assertOk()->assertJsonCount(25, 'users');
        $this->getJson(route('admin.reservation.create.search-applicants', ['q' => '90040']))->assertOk()->assertJsonPath('users.0.id', 40)->assertJsonCount(1, 'users');
        $this->getJson(route('admin.reservation.create.search-applicants', ['q' => 'Te%']))->assertOk()->assertJsonCount(0, 'users');
    }

    public function test_applicant_search_excludes_current_bookings_but_allows_cancelled_reservations(): void
    {
        $url = route('admin.reservation.create.search-applicants', ['q' => 'Test']);
        $this->getJson($url)->assertJsonCount(1, 'users');
        $this->reserve();
        $this->getJson($url)->assertJsonCount(0, 'users');
        $id = (int) DB::table('reservations')->value('id');
        $this->changeStatus($id, 'confirmed')->assertOk();
        $this->getJson($url)->assertJsonCount(0, 'users');
        $this->changeStatus($id, 'cancelled')->assertOk();
        $this->getJson($url)->assertJsonCount(1, 'users');
        DB::table('cee_sessions')->update(['status' => 'inactive']);
        $this->getJson($url)->assertJsonCount(0, 'users');
    }

}
