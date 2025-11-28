# CandForm

A modern, professional web application for managing job application submissions. CandForm streamlines the candidate experience by providing a clean interface for submitting applications, automatic email confirmations, and secure CV storage.

## Features

- **Simple Application Form** — Collect essential candidate information: name, email, address, and CV upload
- **Automatic Email Confirmation** — Candidates receive instant email confirmations with their submission details
- **Secure CV Storage** — PDFs are validated and stored securely on the server (max 10 MB)
- **Real-time Validation** — Client-side and server-side validation for robust data integrity
- **Professional UI** — Built with TailwindCSS for a modern, responsive design
- **Dark Mode Support** — Seamless dark theme for user comfort
- **Database Storage** — All submissions are persisted in the database for future reference

## Tech Stack

- **Framework** — Laravel 12
- **Frontend** — Blade templates, TailwindCSS, JavaScript
- **Database** — MySQL (configurable)
- **Email** — Laravel Mail with SMTP configuration
- **File Storage** — Laravel Storage (Public disk for CV uploads)

## Installation

### Prerequisites

- PHP 8.2+
- Composer
- MySQL or PostgreSQL
- Node.js & npm (for asset compilation)

### Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd candform
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database** (in `.env`)
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=candform
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Configure email** (in `.env`)
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io_OR_smtp.gmail.com
   MAIL_PORT=2525_OR_587
   MAIL_USERNAME=your_username
   MAIL_PASSWORD=your_password
   MAIL_FROM_ADDRESS=noreply@candform.local
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

8. **Build assets**
   ```bash
   npm run build
   ```

9. **Start the server**
   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`

## Usage

### For Users

1. Visit the home page at `/`
2. Click **"Apply Now"** to access the application form
3. Fill in your information: name, email, address, and upload your CV (PDF, max 10 MB)
4. Submit the form
5. You'll receive a confirmation notification and an email with your submission details

### For Administrators

- Access submitted applications through the database
- Download candidate CVs from `/storage/cvs/`
- Customize email templates in `resources/emails/confirmation-candidature.blade.php`
- Modify form fields in `resources/views/form.blade.php`

## File Uploads

- **Accepted format** — PDF only
- **Maximum size** — 10 MB
- **Storage location** — `storage/app/public/cvs/`
- **Access URL** — `/storage/cvs/{filename}`

## API Routes

| Method | Route | Description |
|--------|-------|-------------|
| GET | `/` | Home page |
| GET | `/form` | Application form page |
| POST | `/form` | Submit application (validation & email) |

## Project Structure

```
candform/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── CandidatureController.php
│   ├── Mail/
│   │   └── ConfirmationCandidatureMail.php
│   └── Models/
│       └── Candidature.php
├── resources/
│   ├── views/
│   │   ├── form.blade.php
│   │   ├── home.blade.php
│   │   ├── components/
│   │   └── emails/
│   ├── css/
│   └── js/
├── storage/
│   └── app/
│       └── public/
│           └── cvs/
├── routes/
│   └── web.php
└── database/
    └── migrations/
```

## Database Schema

### Candidatures Table

```sql
CREATE TABLE candidatures (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    last_name VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NULLABLE,
    cv_path VARCHAR(255) NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## Configuration

### Email Notifications

Edit `app/Mail/ConfirmationCandidatureMail.php` to customize the confirmation email template.

### Validation Rules

Modify validation rules in `app/Http/Controllers/CandidatureController.php`:

```php
$validated = $request->validate([
    'last_name' => 'required|string|max:255',
    'first_name' => 'required|string|max:255',
    'email' => 'required|email|max:255',
    'address' => 'nullable|string|max:255',
    'cv' => 'required|file|mimes:pdf|max:10240', // 10 MB in KB
]);
```

### File Upload Limits

Update `php.ini` if needed:

```
upload_max_filesize = 10M
post_max_size = 10M
```

## Security

- ✅ CSRF protection on all forms
- ✅ Server-side file type validation (PDF only)
- ✅ File size limit enforcement (10 MB max)
- ✅ Email validation using Laravel's email rule
- ✅ Automatic cleanup of CVs on submission deletion (via Model observer)
- ✅ Input sanitization & XSS prevention via Blade escaping

## Performance

- Static assets are minified and versioned via Laravel Mix
- Database queries are optimized
- Consider adding pagination for large submission lists
- Use a queue driver (Redis, database) for email sending in production

## Troubleshooting

### Emails not sending
- Verify SMTP credentials in `.env`
- Check `MAIL_FROM_ADDRESS` is set
- Test with Laravel Tinker: `Mail::raw('test', fn($m) => $m->to('test@example.com'));`

### File uploads fail
- Run `php artisan storage:link` if symlink is missing
- Check directory permissions: `chmod -R 775 storage bootstrap/cache`
- Verify `upload_max_filesize` and `post_max_size` in `php.ini`

### Validation messages not showing
- Clear config cache: `php artisan config:cache`
- Verify locale is set to 'en' or 'fr' in `config/app.php`

## License

This project is licensed under the MIT License — see the [LICENSE](LICENSE) file for details.

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Support

For questions or issues, please open an issue on the repository or contact the development team.

## Author

**Hermas Francisco** — Initial development and maintenance

---

**Last Updated:** November 2025
