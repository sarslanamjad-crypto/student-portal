# StudentPortal - Academic Management System

A streamlined student and course management application featuring an elegant dashboard for fast, responsive CRUD operations.
Built utilizing the latest Laravel 12 features for maximum development efficiency and speed.

## Core Tech Stack
- **Framework:** Laravel 12.0, PHP 8.2
- **Database:** SQLite
- **Frontend Strategy:** Vite asset bundling concurrently serving views and Tailwind styling.

## Key Features
- **Student Enrollment System:** Manage students profiles and track their active course enrollments seamlessly.
- **Course Administration:** Full CRUD operations for academic courses within a responsive dashboard.
- **Modern Asset Bundling:** Integrated with Vite to provide a lightning-fast frontend development experience.
- **Lightweight Database Integration:** Utilizes SQLite for quick setup, making it ideal for rapid prototyping and deployment.

## Installation Guide

Follow these steps to set up the project locally. Note that this project includes automated scripts for a smoother setup.

1. **Install dependencies and compile assets:**
   ```bash
   composer run-script setup
   ```
   *This command runs `composer install`, sets up your `.env`, generates the key, creates the SQLite file, runs migrations, installs NPM packages, and builds frontend assets automatically.*

2. **Start the development server with Vite formatting:**
   ```bash
   composer run-script dev
   ```
   *This single command will concurrently start the artisan server, the queue listener, log viewer, and Vite server.*
