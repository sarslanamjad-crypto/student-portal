# StudentPortal - Quick Reference Guide

## 🚀 Getting Started in 30 Seconds

```powershell
cd "d:\CUI Data\5th Semester\Web Dev\Laravel\StudentPortal"
composer install
npm install
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
```

Then visit: **http://localhost:8000**

## 🔑 Test Credentials

```
Email: john@example.com
Password: password123
```

Or use any of these accounts:
- jane@example.com
- ali@example.com

## 📍 Navigation Map

```
Dashboard (/)
├── Students (/students)
│   ├── List all (/students)
│   ├── Create new (/students/create)
│   ├── View details (/students/{id})
│   └── Edit (/students/{id}/edit)
│
├── Courses (/courses)
│   ├── List all (/courses)
│   ├── Create new (/courses/create)
│   ├── View details (/courses/{id})
│   ├── Edit (/courses/{id}/edit)
│   ├── Enroll (/courses/{id}/enroll)
│   └── Drop (/courses/{id}/drop)
│
└── Account
    ├── Login (/login)
    ├── Register (/register)
    └── Logout (POST /logout)
```

## 🎨 Main Colors

```css
Primary:     #667eea (purple-blue)
Secondary:   #764ba2 (darker purple)
Success:     #198754 (green)
Danger:      #dc3545 (red)
Warning:     #ffc107 (yellow)
Info:        #0dcaf0 (cyan)
Light:       #f8f9fa (off-white)
Dark:        #1a1a1a (dark gray)
```

## 📊 Database Tables

| Table | Columns | Purpose |
|-------|---------|---------|
| users | id, name, email, password, timestamps | User authentication |
| students | id, user_id, roll_no, department, semester, phone, address, date_of_birth | Student profiles |
| courses | id, code, name, description, credits, instructor_name, semester, capacity | Course catalog |
| enrollments | id, student_id, course_id, grade, status, timestamps | Student-course links |

## 🔗 Model Relationships

```php
User::has(Student)              // One user has one student
Student::belongsTo(User)        // Student belongs to one user
Student::belongsToMany(Course)  // Student enrolled in many courses
Course::belongsToMany(Student)  // Course has many students
```

## 🛣️ API Endpoints

### Authentication
- `POST /register` - Create new account
- `POST /login` - Login user
- `POST /logout` - Logout user

### Students (REST)
- `GET /students` - List students
- `POST /students` - Create student
- `GET /students/{id}` - View student
- `PUT /students/{id}` - Update student
- `DELETE /students/{id}` - Delete student

### Courses (REST)
- `GET /courses` - List courses
- `POST /courses` - Create course
- `GET /courses/{id}` - View course
- `PUT /courses/{id}` - Update course
- `DELETE /courses/{id}` - Delete course

### Enrollment
- `POST /courses/{id}/enroll` - Enroll in course
- `POST /courses/{id}/drop` - Drop course

## 📝 Useful Artisan Commands

```bash
# Server management
php artisan serve                   # Start dev server
php artisan serve --port=8001      # Use different port

# Database
php artisan migrate                 # Run migrations
php artisan migrate:reset           # Reset all migrations
php artisan db:seed               # Run seeders
php artisan migrate:fresh --seed  # Reset and reseed

# Cache
php artisan cache:clear            # Clear all caches
php artisan config:clear           # Clear config cache
php artisan view:clear             # Clear view cache

# Development
php artisan tinker                 # Interactive shell
php artisan make:model ModelName -m    # Create model with migration
php artisan make:controller ControllerName # Create controller
```

## 💻 Using npm Commands

```bash
npm install              # Install dependencies
npm run build           # Build for production
npm run dev             # Development mode with watch
```

## 🐛 Troubleshooting Quick Fixes

### App won't start
```bash
php artisan cache:clear
php artisan config:clear
```

### Database errors
```bash
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

### Assets not loading
```bash
npm run build
php artisan cache:clear
```

### Port 8000 already in use
```bash
php artisan serve --port=8001
```

## 📱 UI Components

### Available Bootstrap Classes
```html
<!-- Alerts -->
<div class="alert alert-success">Success message</div>
<div class="alert alert-danger">Error message</div>

<!-- Buttons -->
<button class="btn btn-primary">Primary</button>
<button class="btn btn-secondary">Secondary</button>

<!-- Cards -->
<div class="card">
  <div class="card-body">Content</div>
</div>

<!-- Tables -->
<table class="table table-hover">
  <thead><tr><th>Header</th></tr></thead>
  <tbody><tr><td>Data</td></tr></tbody>
</table>

<!-- Forms -->
<input type="text" class="form-control">
<select class="form-select"><option>...</option></select>
```

## 🔒 Security Tips

- ✅ Never commit `.env` file to version control
- ✅ Keep `APP_KEY` secret
- ✅ Use strong passwords
- ✅ Enable HTTPS in production
- ✅ Update dependencies regularly: `composer update`

## 📦 Project Structure Quick View

```
StudentPortal/
├── app/
│   ├── Models/          ← Database models
│   └── Http/
│       └── Controllers/ ← Route handlers
├── database/
│   ├── migrations/      ← Database schemas
│   └── seeders/         ← Sample data
├── resources/
│   ├── css/             ← Stylesheets
│   ├── js/              ← JavaScript
│   └── views/           ← Blade templates
├── routes/
│   └── web.php          ← URL routes
└── public/              ← Public assets
```

## 🎯 Common Tasks

### Add a New Student
1. Go to Students → Add New Student
2. Fill in: Roll No, Department, Semester
3. Optionally: Phone, Address, DOB
4. Click Create

### Create a New Course
1. Go to Courses → Add New Course
2. Fill in: Code, Name, Credits, Semester, Instructor
3. Click Create

### Enroll in a Course
1. Go to Courses
2. Click on a course
3. Click "Enroll in Course"
4. Course appears in dashboard

### Update Profile
1. Click username (top right)
2. Click "My Profile"
3. Click "Edit Profile"
4. Make changes
5. Click "Update Student"

## 🎓 Study Tips

- Explore the `Student` model to understand relationships
- Check `routes/web.php` to see all available routes
- Study `StudentController` for CRUD pattern
- Look at `resources/views/layouts/app.blade.php` for template structure

## 📞 File Locations

| Component | Location |
|-----------|----------|
| Database Models | `app/Models/` |
| Controllers | `app/Http/Controllers/` |
| Routes | `routes/web.php` |
| Views | `resources/views/` |
| CSS | `resources/css/app.css` |
| Migrations | `database/migrations/` |
| Seeders | `database/seeders/` |

## ⚡ Performance Tips

- Use pagination: `User::paginate(15)`
- Load relationships early: `with('courses')`
- Cache queries in production
- Optimize CSS/JS with npm build

## 🆘 Getting Help

1. Check `README.md` for features overview
2. See `SETUP_GUIDE.md` for installation help
3. View `PROJECT_COMPLETION_SUMMARY.md` for what's included
4. Laravel Docs: https://laravel.com/docs
5. Bootstrap Docs: https://getbootstrap.com

---

## ✅ You're All Set!

Everything is installed, configured, and ready to go. 

**Start using it:**
```bash
php artisan serve
```

**Then open:** http://localhost:8000

Happy coding! 🚀
