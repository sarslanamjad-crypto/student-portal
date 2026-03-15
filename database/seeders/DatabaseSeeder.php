<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample users and students
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
        ]);

        $student1 = Student::create([
            'user_id' => $user1->id,
            'roll_no' => 'CS-2021-001',
            'department' => 'Computer Science',
            'semester' => 3,
            'phone' => '+92-300-1234567',
            'address' => '123 Main Street, Islamabad',
            'date_of_birth' => '2003-05-15',
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
        ]);

        $student2 = Student::create([
            'user_id' => $user2->id,
            'roll_no' => 'CS-2021-002',
            'department' => 'Computer Science',
            'semester' => 3,
            'phone' => '+92-300-2345678',
            'address' => '456 Oak Avenue, Lahore',
            'date_of_birth' => '2003-08-20',
        ]);

        $user3 = User::create([
            'name' => 'Ali Khan',
            'email' => 'ali@example.com',
            'password' => Hash::make('password123'),
        ]);

        $student3 = Student::create([
            'user_id' => $user3->id,
            'roll_no' => 'SE-2021-001',
            'department' => 'Software Engineering',
            'semester' => 2,
            'phone' => '+92-300-3456789',
            'address' => '789 Pine Road, Karachi',
            'date_of_birth' => '2003-12-10',
        ]);

        // Create sample courses
        $course1 = Course::create([
            'code' => 'CS-301',
            'name' => 'Data Structures',
            'description' => 'Learn fundamental data structures including arrays, linked lists, stacks, queues, trees, and graphs.',
            'credits' => 3,
            'instructor_name' => 'Dr. Ahmed Hassan',
            'semester' => 3,
            'capacity' => 50,
        ]);

        $course2 = Course::create([
            'code' => 'CS-302',
            'name' => 'Algorithms',
            'description' => 'Study algorithm design and analysis, including sorting, searching, and dynamic programming.',
            'credits' => 3,
            'instructor_name' => 'Prof. Fatima Khan',
            'semester' => 3,
            'capacity' => 45,
        ]);

        $course3 = Course::create([
            'code' => 'CS-303',
            'name' => 'Database Management Systems',
            'description' => 'Master SQL, database design, normalization, and transaction management.',
            'credits' => 4,
            'instructor_name' => 'Dr. Muhammad Ali',
            'semester' => 3,
            'capacity' => 40,
        ]);

        $course4 = Course::create([
            'code' => 'CS-304',
            'name' => 'Web Development',
            'description' => 'Build dynamic web applications using HTML, CSS, JavaScript, and modern frameworks.',
            'credits' => 3,
            'instructor_name' => 'Eng. Sara Malik',
            'semester' => 3,
            'capacity' => 55,
        ]);

        $course5 = Course::create([
            'code' => 'CS-305',
            'name' => 'Object-Oriented Programming',
            'description' => 'Learn OOP concepts using Java/Python, including inheritance, polymorphism, and design patterns.',
            'credits' => 3,
            'instructor_name' => 'Dr. Hassan Raza',
            'semester' => 2,
            'capacity' => 50,
        ]);

        $course6 = Course::create([
            'code' => 'CS-306',
            'name' => 'Operating Systems',
            'description' => 'Understand OS fundamentals, processes, memory management, and file systems.',
            'credits' => 3,
            'instructor_name' => 'Prof. Ayesha Siddiqui',
            'semester' => 4,
            'capacity' => 45,
        ]);

        // Enroll students in courses
        $student1->courses()->attach([
            $course1->id => ['status' => 'enrolled'],
            $course2->id => ['status' => 'enrolled'],
            $course4->id => ['status' => 'enrolled'],
        ]);

        $student2->courses()->attach([
            $course1->id => ['status' => 'enrolled'],
            $course3->id => ['status' => 'enrolled'],
            $course4->id => ['status' => 'enrolled'],
        ]);

        $student3->courses()->attach([
            $course5->id => ['status' => 'enrolled'],
        ]);
    }
}
