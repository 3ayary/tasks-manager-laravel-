# Task Management System API

A RESTful API built with **Laravel** for managing tasks, users, and categories. Built as a backend learning project focused on real-world patterns: authentication, authorization, relational data modeling, and clean response structures.

---

## Tech Stack

- **PHP / Laravel**
- **MySQL**
- **Laravel Sanctum** (token-based auth)
- **Eloquent ORM**

---

## Features

- **Authentication** — Register, login, and logout using Laravel Sanctum token-based authentication
- **Task Management** — Full CRUD for tasks with filtering, pagination, and status-based querying
- **User Profiles** — Create and retrieve user profiles linked to accounts
- **Categories** — Attach and retrieve categories per task (Many-to-Many)
- **Authorization** — Ownership-based access control using Laravel Policies (only task owners can modify their tasks)
- **Admin Control** — Middleware-protected routes for admin-only operations
- **Validation** — All inputs validated via Form Request classes
- **API Resources** — Standardized and consistent JSON responses across all endpoints
- **Error Handling** — Centralized exception handling for uniform error responses
- **Seeders & Factories** — Structured database seeding for development and testing

---

## API Endpoints

### Auth
| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| POST | `/api/register` | Register a new user | ❌ |
| GET | `/api/login` | Login and get token | ❌ |
| GET | `/api/logout` | Logout and revoke token | ✅ |

### Users
| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/users` | Get all users | ❌ |
| GET | `/api/user` | Get authenticated user | ✅ |
| GET | `/api/users/profile` | Get user profile | ✅ |
| GET | `/api/users/tasks` | Get tasks for authenticated user | ✅ |
| POST | `/api/profile` | Create user profile | ✅ |

### Tasks
| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/tasks` | Get all tasks (admin only) | ✅ Admin |
| POST | `/api/tasks` | Create a new task | ✅ |
| GET | `/api/tasks/{id}` | Get a single task | ❌ |
| PUT | `/api/tasks/{id}` | Update a task (owner only) | ✅ |
| DELETE | `/api/tasks/{id}` | Delete a task (owner only) | ✅ |
| GET | `/api/tasks/{id}/user` | Get task owner | ❌ |

### Categories
| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| POST | `/api/tasks/{id}/categories` | Add categories to task | ❌ |
| GET | `/api/tasks/{id}/categories` | Get task categories | ❌ |
| GET | `/api/categories/{id}/tasks` | Get tasks by category | ❌ |

---

## Database Structure

```
users
├── id
├── name
├── email
├── password
└── timestamps

tasks
├── id
├── user_id (FK → users)
├── title
├── description
├── status
└── timestamps

categories
├── id
├── name
└── timestamps

category_task (pivot)
├── task_id (FK → tasks)
└── category_id (FK → categories)
```

---

## Getting Started

```bash
# Clone the repo
git clone https://github.com/3ayary/tasks-manager-laravel-
cd tasks-manager-laravel-

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure your DB in .env then run:
php artisan migrate --seed

# Start the server
php artisan serve
```

---

## What I Learned Building This

This project was about understanding how a real backend system is structured — not just making endpoints work, but making them work correctly. I focused on: proper auth flows, policy-based authorization, keeping controllers thin, and returning consistent API responses regardless of success or error.
