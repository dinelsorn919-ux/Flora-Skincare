# Flora Skincare — Laravel Skincare Storefront (with Admin + Customer Login)

Custom application code for a skincare e-commerce storefront with two roles:

- **Admin** — logs in and gets a full CRUD area for products (create, edit,
  delete, upload images).
- **Customer** — anyone can browse the storefront; creating an account or
  logging in is required to add items to the bag and check out.

Built to drop into a fresh Laravel install. Styling uses Tailwind via CDN and
Google Fonts, so there's no frontend build step needed to see it running.

## What's included

```
app/Models/Product.php
app/Models/User.php                              (adds role support)
app/Http/Controllers/StorefrontController.php
app/Http/Controllers/CartController.php
app/Http/Controllers/Auth/AuthenticatedSessionController.php
app/Http/Controllers/Auth/RegisteredUserController.php
app/Http/Controllers/Admin/ProductController.php
app/Http/Middleware/EnsureUserIsAdmin.php
database/migrations/2024_01_01_000000_create_products_table.php
database/migrations/2024_01_02_000000_add_role_to_users_table.php
database/seeders/ProductSeeder.php
database/seeders/UserSeeder.php
database/seeders/DatabaseSeeder.php     (replace the default one)
routes/web.php                          (replace the default one)
resources/views/layouts/app.blade.php   (storefront layout, now auth-aware)
resources/views/storefront/**
resources/views/cart/index.blade.php
resources/views/auth/login.blade.php
resources/views/auth/register.blade.php
resources/views/admin/**
```

## Setup

1. **Create a fresh Laravel app** (requires internet + PHP 8.2+ and Composer):
   ```bash
   composer create-project laravel/laravel flora-skincare
   cd flora-skincare
   ```

2. **Copy in the files from this package**, overwriting `routes/web.php`,
   `database/seeders/DatabaseSeeder.php`, and `app/Models/User.php`, and
   adding everything else as new files.

3. **Register the `admin` middleware alias.** Open `bootstrap/app.php` and
   add it to the `withMiddleware` call:
   ```php
   ->withMiddleware(function (Middleware $middleware) {
       $middleware->alias([
           'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
       ]);
   })
   ```
   (`auth` and `guest` aliases are already registered by Laravel by default.)

4. **Set up the database.** Easiest option is SQLite — in `.env` set:
   ```
   DB_CONNECTION=sqlite
   ```
   and create the file:
   ```bash
   touch database/database.sqlite
   ```

5. **Link storage** (for uploaded product images):
   ```bash
   php artisan storage:link
   ```

6. **Run migrations and seed sample data:**
   ```bash
   php artisan migrate --seed
   ```
   This creates two test accounts (both password `password`):
   - `admin@floraskincare.test` — admin, can manage products at `/admin/products`
   - `customer@floraskincare.test` — regular customer

   **Change or remove these before going live.**

7. **Serve it:**
   ```bash
   php artisan serve
   ```
   - Storefront: `http://127.0.0.1:8000`
   - Admin login: `http://127.0.0.1:8000/login` → redirects to
     `/admin/products` after logging in as admin.

## How the roles work

- `users.role` is a plain string column (`admin` or `customer`). New
  self-registrations via `/register` are always created as `customer` —
  there's no public way to create an admin account, by design. Promote
  someone to admin manually (e.g. via `php artisan tinker` and
  `User::where('email', '...')->update(['role' => 'admin'])`), or seed one.
- `EnsureUserIsAdmin` middleware guards every `/admin/*` route and aborts
  with a 403 for non-admins.
- Browsing (`/`, `/category/*`, `/product/*`) has no auth requirement.
  Adding to the bag, viewing the bag, and checkout are behind `auth` — a
  guest clicking "Add to bag" is redirected to `/login` and returns to what
  they were doing after logging in.

## Next steps you'll likely want

- Real checkout/payment — Stripe Checkout is the fastest path in Laravel.
- Order history for customers (a simple `orders` + `order_items` table tied
  to `user_id`).
- Password reset flow (`Illuminate\Auth\Notifications\ResetPassword` is
  built in; just needs routes + views, which aren't included here yet).
- Rename "Flora Skincare" to your actual brand — it appears in
  `layouts/app.blade.php`, `admin/layout.blade.php`, and the footer.

## Structure notes

- Categories (`cleansers`, `serums`, `moisturizers`, `makeup`) are a plain
  string column on `products` — simplest thing that works for a small
  catalog. Promote to a `categories` table if you need per-category
  images/descriptions later.
- The cart is stored in the session, scoped per logged-in user's browser
  session. It resets if the session expires.
- Admin product images can be a pasted URL or a direct file upload (stored
  to `storage/app/public/products` and served via `storage:link`).
