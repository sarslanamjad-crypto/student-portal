<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentApiController extends Controller
{
    /**
     * Return a JSON list of students (paginated).
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);
        $students = Student::with('user')->paginate($perPage);

        return response()->json($students);
    }

    /**
     * Return a single student as JSON.
     */
    public function show(Student $student)
    {
        return response()->json($student->load('user', 'courses'));
    }

    /**
     * Safe search using query builder / Eloquent bindings (prevents SQL injection).
     */
    public function search(Request $request)
    {
        $term = (string) $request->query('term', '');

        $results = Student::where('roll_no', 'like', "%{$term}%")
            ->orWhere('department', 'like', "%{$term}%")
            ->limit(50)
            ->get();

        return response()->json(['safe' => true, 'count' => $results->count(), 'data' => $results]);
    }

    /**
     * Vulnerable search (demonstration only) — uses raw SQL concatenation and is registered
     * only when the app environment is 'local'. DO NOT enable in production.
     */
    public function searchVulnerable(Request $request)
    {
        $term = (string) $request->query('term', '');

        // Intentionally vulnerable raw SQL concatenation for demonstration.
        $sql = "SELECT * FROM students WHERE roll_no LIKE '%" . $term . "%' OR department LIKE '%" . $term . "%' LIMIT 50";
        $rows = DB::select($sql);

        return response()->json(['safe' => false, 'query' => $sql, 'count' => count($rows), 'data' => $rows]);
    }

    /**
     * Export a small CSV using Laravel's Storage facade (platform-specific API).
     * This demonstrates interacting with the filesystem and a simple platform constraint.
     */
    public function exportCsv(Request $request)
    {
        $students = Student::with('user')->limit(200)->get();

        $lines = [];
        $lines[] = 'id,roll_no,department,semester,user_email';

        foreach ($students as $s) {
            $lines[] = implode(',', [
                $s->id,
                '"' . str_replace('"', '""', $s->roll_no) . '"',
                '"' . str_replace('"', '""', $s->department) . '"',
                $s->semester,
                $s->user?->email ?? '',
            ]);
        }

        $csv = implode("\n", $lines);

        // Store CSV on the default disk (platform-specific) and return as download.
        $path = 'exports/students-' . time() . '.csv';
        Storage::disk('local')->put($path, $csv);

        // Return the file contents with CSV headers (no streaming to keep it simple).
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="students.csv"',
        ]);
    }
}
