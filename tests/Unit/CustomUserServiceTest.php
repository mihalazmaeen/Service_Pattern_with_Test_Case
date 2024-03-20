<?php 

namespace Tests\Unit;
use Tests\TestCase;
use App\Models\CustomUser;
use App\Models\UserAddress;
use App\Services\CustomUserService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB; // Add this import if you haven't already


class CustomUserServiceTest extends TestCase
{
    
    protected function refreshCustomUsersTable()
    {
        $this->artisan('migrate:refresh --path=database/migrations/2024_03_14_062319_create_custom_users_table.php');
    }

    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshCustomUsersTable(); // Refresh the custom_users table before each test
        $this->userService = new CustomUserService();
    }

      /** @test */
    public function it_can_list_all_users()
    {
        CustomUser::factory()->count(3)->create();

        // Call the getAll method from your service
        $retrievedUsers = CustomUser::all();

        // Assert that the retrieved users count matches the created users count
        $this->assertCount(3, $retrievedUsers);
    }
     /** @test */
    public function it_can_create_a_new_user()
    {
        $userData = CustomUser::factory()->make()->toArray();

        $user = CustomUser::create($userData);

        $this->assertInstanceOf(CustomUser::class, $user);
        $this->assertDatabaseHas('custom_users', ['email' => $userData['email']]);
    }
     /** @test */
    public function it_can_update_an_existing_user()
    {
        $user = CustomUser::factory()->create();

        $updatedData = [
            'name' => 'New Name',
            'email' => 'testupdate@example.com',
        ];

        $user->update($updatedData);

        // Reload the user from the database
        $user = $user->fresh();

        // Check if the user's name has been updated
        $this->assertEquals('New Name', $user->name);
    }
    /** @test */
    public function it_can_soft_delete_an_existing_user()
    {
        $user = CustomUser::factory()->create();

        $user->delete();

        // Assert that the user is soft deleted
        $this->assertSoftDeleted($user);
    }
    /** @test */
    public function it_can_retrieve_trashed_users()
    {
        $user = CustomUser::factory()->create();

        $user->delete();

        // Retrieve trashed users
        $trashedUsers = CustomUser::onlyTrashed()->get();

        // Assert that the trashed user is in the list of trashed users
        $this->assertTrue($trashedUsers->contains($user));
    }

    /** @test */
    public function it_can_permanently_delete_soft_deleted_user()
    {
        $user = CustomUser::factory()->create();

        $user->delete();

        $user->forceDelete();

        // Attempt to retrieve the soft-deleted user
        $deletedUser = CustomUser::withTrashed()->find($user->id);

        // Assert that the user is not found (permanently deleted)
        $this->assertNull($deletedUser);
    }

    /** @test */
    public function it_can_create_a_user_with_address()
    {
        UserAddress::truncate();
        CustomUser::truncate();
    // Create a user
    $user = CustomUser::factory()->create();

    // Create an address associated with the user
    $address = UserAddress::factory()->create(['user_id' => $user->id]);

    // Retrieve the user's associated address
    $retrievedAddress = $user->addresses->first();

    // Assert that the user's associated address matches the created address
    $this->assertEquals($address->toArray(), $retrievedAddress->toArray());
    }



 
}
