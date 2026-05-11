MULTI PURPOSE COURT BOOKING SYSTEM
==================================


PROJECT TITLE
-------------
CourtBook.


DESCRIPTION
-----------
The CourtBook. or Multi Purpose Court Booking System is a full-stack web application built
with Laravel 12, Blade templating, and Tailwind CSS v4. It enables members of
a community, school, or sports complex to reserve multi-purpose courts such as
basketball, badminton, futsal, volleyball, and tennis through a secure online
platform. The system replaces manual logbooks and phone-based reservations
with a structured, role-based digital workflow that prevents double bookings,
tracks payment proofs, and provides administrators with real-time visibility
into court utilization and revenue.

The application is designed as a Final Project demonstration of professional
Software Engineering practices in the Laravel ecosystem. It is not a simple
CRUD application. It implements authentication, custom middleware, gates,
policies, service providers, form request validation, file uploads, and rich
Eloquent relationships to model a realistic booking domain.

End users can browse available courts, check live availability, submit booking
requests with payment proof, and track the status of their reservations from
pending through approved, completed, or rejected. Administrators manage courts,
approve or reject bookings, publish announcements, ban abusive users, and
monitor analytics from a dedicated dashboard. The interface uses a modern
glassmorphism design language defined through Tailwind v4 design tokens,
producing a polished, production-quality appearance suitable for a live
defense or demonstration.

Technology stack:
    Backend framework  : Laravel 12 (PHP 8.2 or later)
    Frontend           : Blade templates with Tailwind CSS v4 and Vite
    Database           : MySQL 8 (compatible with MariaDB and SQLite)
    Authentication     : Laravel Breeze (session-based)
    File storage       : Local public disk via php artisan storage:link

User roles:
    Guest   - browse courts and announcements only
    Member  - create bookings, upload payment proof, view personal history
    Admin   - manage courts, approve or reject bookings, post announcements,
              view reports, and ban users


LIST OF IMPLEMENTED FEATURES
----------------------------

Authentication and Account Management
    - User registration, login, logout, and password reset using Laravel Breeze
    - Email verification scaffolding
    - Profile editing for name, email, and password
    - Role field on the users table (admin or user)
    - Account banning controlled by administrators

Authorization (Gates, Policies, and Middleware)
    - Custom AdminMiddleware that restricts access to admin-only routes
    - Custom PreventBannedUsersMiddleware that blocks banned accounts from
      authenticated routes
    - BookingPolicy enforcing view, update, delete, approve, and reject rules
    - CourtPolicy restricting create, update, and delete actions to admins
    - Global Gates registered in AppServiceProvider, including
      access-admin-dashboard, manage-announcements, and manage-users

Court Management
    - Full CRUD for courts including name, sport type, capacity, hourly rate,
      description, and image
    - Image upload with validation through StoreCourtRequest and
      UpdateCourtRequest
    - Toggle to mark a court as active or inactive
    - Protection against deletion when active bookings exist

Booking System (Core Domain)
    - Browse all active courts with filters by sport type and date
    - Real-time availability check by court, date, and time slot
    - Create a booking with court, date, start time, end time, purpose, and
      number of participants
    - Server-side conflict detection that prevents overlapping time slots on
      the same court
    - Upload of payment proof in image or PDF format
    - Booking statuses: pending, approved, rejected, cancelled, and completed
    - Members can cancel their own pending bookings
    - Admin approval workflow with optional rejection reason
    - Automatic calculation of total cost based on duration and hourly rate

Announcements
    - Admin CRUD for system-wide announcements
    - Publish and unpublish toggle
    - Display on the public landing page and the member dashboard

Admin Dashboard and Reporting
    - Key performance indicators for total bookings, revenue, active users,
      and court utilization
    - Bookings per court summary suitable for charting
    - Recent bookings table with quick approve and reject actions
    - Date range filtering for reports

Eloquent Relationships
    - User has many Booking
    - Court has many Booking
    - Booking belongs to User and Court
    - User has many Announcement as author
    - Eager loading applied throughout to prevent N+1 query issues

Software Engineering Practices
    - Form Request validation classes for all state-changing actions
    - Service Provider registration of gates and policies in
      AppServiceProvider::boot
    - Resource controllers following RESTful conventions
    - Database migrations and seeders, including a default administrator and
      sample courts, bookings, and announcements
    - Named routes and route model binding
    - Blade components and shared layouts for consistent UI structure
    - CSRF protection on all state-changing requests
    - Mass-assignment protection through the fillable property on models

User Interface and Experience
    - Responsive glassmorphism design from mobile to desktop
    - Tailwind CSS v4 design tokens defined in resources/css/app.css
    - Flash messages for success and error feedback
    - Empty states, loading states, and confirmation dialogs
    - Accessible forms with proper labels and validation messages

Testing and Demo Data
    - DatabaseSeeder provisions a default administrator account
      (admin@court.test with password "password"), a sample member account,
      five sample courts across different sports, and sample announcements and
      bookings
    - Feature test scaffold for booking creation and conflict detection


QUICK START
-----------
    composer install
    cp .env.example .env
    php artisan key:generate
    (configure database credentials in .env)
    php artisan migrate --seed
    php artisan storage:link
    npm install
    npm run dev
    php artisan serve

Prepared by:
Anne Stephanne Buenaflor
Marclean Forteza