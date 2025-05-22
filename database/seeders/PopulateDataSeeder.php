<?php

namespace Database\Seeders;

use App\Models\AssignedRoom;
use App\Models\Room;
use App\Models\User;
use App\Models\RoomSize;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PopulateDataSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    DB::table('assignedrooms')->truncate();
    DB::table('bookingcostdetails')->truncate();
    DB::table('paymentinfos')->truncate();
    DB::table('paymenttype_cash')->truncate();
    DB::table('bookingdetails')->truncate();
    DB::table('users')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1');

    // Create Admin user
    User::create([
      'id' => 1,
      'Name' => 'Black Manager',
      'Username' => 'Black Manager',
      'Role' => 'Admin',
      'email' => 'manager@black.com',
      'password' => Hash::make('password'),
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // Create 30 users
    $users = [];
    for ($i = 1; $i <= 30; $i++) {
      $users[] = User::create([
        'id' => $i + 1,
        'Name' => "User $i",
        'Username' => "user$i",
        'Role' => 'Customer',
        'email' => "user$i@example.com",
        'password' => Hash::make('password'),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // Get all room types and sizes
    $roomTypes = RoomType::all()->pluck('ID')->toArray(); // [1, 2, 3]
    $roomSizes = RoomSize::all()->pluck('ID')->toArray(); // [1, 2, 3]

    // Booking statuses
    $statuses = [
      'Pending' => array_slice($users, 0, 10),   // Users 1-10
      'Confirmed' => array_slice($users, 10, 10), // Users 11-20
      'Ongoing' => array_slice($users, 20, 10),   // Users 21-30
    ];

    $bookingId = 1;
    $paymentId = 1;
    $cashPaymentId = 1;

    foreach ($statuses as $status => $statusUsers) {
      foreach ($statusUsers as $index => $user) {
        // Random room type and size
        $roomTypeId = $roomTypes[array_rand($roomTypes)];
        $roomSizeId = $roomSizes[array_rand($roomSizes)];

        // Create booking
        $checkInDate = Carbon::today(); // 2025-05-22
        $checkOutDate = $checkInDate->copy()->addDays(3); // 2025-05-25
        $nights = 3;

        $roomType = RoomType::find($roomTypeId);
        $roomSize = RoomSize::find($roomSizeId);

        // Calculate costs
        $roomBasePrice = $roomType->RoomPrice;
        $roomSucceedingNightsPrice = $roomType->SucceedingNights * ($nights - 1);
        $guestFee = $roomSize->PricePerPerson * 1; // 1 guest
        $subtotal = $roomBasePrice + $roomSucceedingNightsPrice + $guestFee;
        $totalAmount = $subtotal; // No discounts

        $booking = DB::table('bookingdetails')->insertGetId([
          'ID' => $bookingId,
          'UserID' => $user->id,
          'RoomTypeID' => $roomTypeId,
          'RoomSizeID' => $roomSizeId,
          'CheckInDate' => $checkInDate,
          'CheckOutDate' => $checkOutDate,
          'NumberOfGuests' => 1,
          'BookingStatus' => $status,
          'created_at' => now(),
          'updated_at' => now(),
        ]);

        // Create booking cost details
        DB::table('bookingcostdetails')->insert([
          'ID' => $bookingId,
          'BookingDetailID' => $bookingId,
          'RoomBasePrice' => $roomBasePrice,
          'RoomSucceedingNightsPrice' => $roomSucceedingNightsPrice,
          'Nights' => $nights,
          'GuestFee' => $guestFee,
          'ServiceBasePrice' => 0.00,
          'ServiceSucceedingNightsPrice' => 0.00,
          'Subtotal' => $subtotal,
          'Discount' => 0.00,
          'TotalAmount' => $totalAmount,
          'created_at' => now(),
          'updated_at' => now(),
        ]);

        // Create payment info
        $paymentStatus = ($status === 'Pending') ? 'Pending' : 'Verified';
        DB::table('paymentinfos')->insert([
          'ID' => $paymentId,
          'BookingDetailID' => $bookingId,
          'TotalAmount' => $totalAmount,
          'PaymentStatus' => $paymentStatus,
          'PaymentMethod' => 'Cash',
          'created_at' => now(),
          'updated_at' => now(),
        ]);

        // Create cash payment record
        DB::table('paymenttype_cash')->insert([
          'ID' => $cashPaymentId,
          'PaymentInfoID' => $paymentId,
          'CashAmount' => $totalAmount,
          'created_at' => now(),
          'updated_at' => now(),
        ]);

        // Assign room for Confirmed and Ongoing bookings
        if (in_array($status, ['Confirmed', 'Ongoing'])) {
          // Get available rooms matching room type and size, not assigned
          $availableRooms = Room::where('RoomTypeID', $roomTypeId)
            ->where('RoomSizeID', $roomSizeId)
            ->whereNotIn('ID', function ($query) use ($checkInDate, $checkOutDate) {
              $query->select('RoomID')
                ->from('assignedrooms')
                ->join('bookingdetails', 'assignedrooms.BookingDetailID', '=', 'bookingdetails.ID')
                ->whereIn('bookingdetails.BookingStatus', ['Confirmed', 'Ongoing'])
                ->where('bookingdetails.CheckInDate', '<=', $checkOutDate)
                ->where('bookingdetails.CheckOutDate', '>=', $checkInDate);
            })
            ->inRandomOrder()
            ->first();

          if ($availableRooms) {
            AssignedRoom::create([
              'ID' => $bookingId,
              'BookingDetailID' => $bookingId,
              'RoomID' => $availableRooms->ID,
              'Status' => 'Ongoing',
              'created_at' => now(),
              'updated_at' => now(),
            ]);
          }
        }

        $bookingId++;
        $paymentId++;
        $cashPaymentId++;
      }
    }
  }
}
