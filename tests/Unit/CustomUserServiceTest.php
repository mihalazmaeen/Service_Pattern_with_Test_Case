<?php 

namespace Tests\Unit;

use App\Models\CustomUser;
use App\Services\CustomUserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomUserServiceTest extends TestCase
{
    use RefreshDatabase; // Ensures a fresh database for each test

    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new CustomUserService();
    }

    /** @test */
    public function it_can_list_all_users()
    {
        // Create some test users directly in the database
        $users = [
            CustomUser::create(['name' => 'test Name1', 'email' => 'test1@example.com', 'password' => '123456']),
            CustomUser::create(['name' => 'test Name2', 'email' => 'test2@example.com', 'password' => '123456']),
            CustomUser::create(['name' => 'test Name3', 'email' => 'test3@example.com', 'password' => '123456']),
        ];

        // Call the getAll method from your service
        $retrievedUsers = $this->userService->getAll();

        // Assert that the retrieved users match the created users
        $this->assertEquals(collect($users)->pluck('id'), $retrievedUsers->pluck('id'));
    }

    /** @test */
    public function it_can_create_a_new_user()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $user = $this->userService->create($userData);

        $this->assertInstanceOf(CustomUser::class, $user);
        $this->assertDatabaseHas('custom_users', ['email' => 'test@example.com']);
    }

    /** @test */
    public function it_can_update_an_existing_user()
    {
        // Create a user manually
        $user = CustomUser::create(['name' => 'Old Name','email' =>'test@example.com','password' =>'123456']);

        // Define the updated data
        $updatedData = [
            'name' => 'New Name',
            'email' => 'testupdate@example.com',
        ];

        // Call the update method from your service
        $this->userService->update($user, $updatedData);

        // Check if the user's name has been updated
        $this->assertEquals('New Name', $user->fresh()->name);
    }

    /** @test */
        public function it_can_soft_delete_an_existing_user()
        {
            // Create a user manually
            $user = CustomUser::create(['name' => 'Test User', 'email' => 'test@example.com', 'password' => 'password']);

            // Soft delete the user
            $this->userService->delete($user);

            // Retrieve soft-deleted users
            $deletedUsers = $this->userService->getDeleted();

            // Assert that the deleted user is in the list of soft-deleted users
            $this->assertTrue($deletedUsers->contains($user));
        }

        /** @test */
        public function it_can_retrieve_trashed_users()
        {
            // Create a user manually
            $user = CustomUser::create(['name' => 'Test User', 'email' => 'test@example.com', 'password' => 'password']);

            // Soft delete the user
            $this->userService->delete($user);

            // Retrieve trashed users
            $trashedUsers = $this->userService->getDeleted();

            // Assert that the trashed user is in the list of trashed users
            $this->assertTrue($trashedUsers->contains($user));
        }

 
}
