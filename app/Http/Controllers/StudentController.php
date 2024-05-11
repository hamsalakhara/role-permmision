<?php    
namespace App\Http\Controllers;
    
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
    
class StudentController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:student-list|student-create|student-edit|student-delete', ['only' => ['index','show']]);
         $this->middleware('permission:student-create', ['only' => ['create','store']]);
         $this->middleware('permission:student-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:student-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
       
        $students = Student::latest()->paginate(5);
        return view('student.index',compact('students'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('student.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {

        request()->validate([
            'username' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email_id' => 'required|email|unique:student,email_id', // Ensure email is unique in the 'students' table
            'date_of_birth' => 'required|date',
            'standard' => 'required|string',
            'gender' => 'required|string|in:male,female,other', // Allow only specified gender values
            'entry_year' => 'required|integer|min:1900|max:' . date('Y'),
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add profile field validation
        ]);
        // Handle profile image upload
        if ($request->hasFile('profile')) {
            $profileImage = $request->file('profile');
            $profileName = time() . '_' . $profileImage->getClientOriginalName();
            $profilePath = $request->file('profile')->storeAs('profiles', $profileName,'public');
        }
        $data = $request->except('profile');
        if (isset($profilePath)) {
            $data['profile'] = $profilePath;
        }
        Student::create($data);
    
        return redirect()->route('students.index')
                        ->with('success','student created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student): View
    {
        return view('student.show',compact('student'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student): View
    {
        return view('student.edit',compact('student'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student): RedirectResponse
    {
         request()->validate([
             'username' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email_id' => 'required|email',
            'date_of_birth' => 'required|date',
            'standard' => 'required|string',
            'gender' => 'required|string|in:male,female,other', // Allow only specified gender values
            'entry_year' => 'required|integer|min:1900|max:' . date('Y'), 
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add profile field validation
        ]);
        // Handle profile image upload
        if ($request->hasFile('profile')) {
            $profileImage = $request->file('profile');
            $profileName = time() . '_' . $profileImage->getClientOriginalName();
            $profilePath = $profileImage->storeAs('profiles', $profileName, 'public');
            
            // Delete previous profile image if exists
            if ($student->profile) {
                Storage::disk('public')->delete($student->profile);
            }

            // Update profile path in the database
            $student->profile = $profilePath;
        }

        // Update other fields
        $student->update($request->except('profile'));
    
        return redirect()->route('students.index')
                        ->with('success','Student updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student): RedirectResponse
    {
        
 // Delete the associated image file
    if ($student->profile) {
        Storage::delete($student->profile);
    }

        $student->delete();
    
        return redirect()->route('students.index')
                        ->with('success','Student deleted successfully');
    }
}