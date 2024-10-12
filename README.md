# Vaccination Scheduling Application

This is a web application that allows users to register for COVID-19 vaccination at available vaccine centers. Users can select a vaccine center, and the system automatically schedules their vaccination based on availability. Additionally, users can check their vaccination status by entering their NID (National ID).

## Features

- **User Registration**: Users can register for vaccination by selecting a vaccine center.
- **Center Capacity Management**: Each vaccine center has a daily limit for the number of people it can serve.
- **Automatic Scheduling**: Users are scheduled on a first-come-first-serve basis based on center availability.
- **Email Notifications**: Registered users receive a reminder email the night before their scheduled vaccination date.
- **Vaccination Status Check**: Users can check their registration and vaccination status by entering their NID on the status page.


## Installation Steps

Follow these steps to set up and run the application on your local environment.

### 1. Clone the repository

```bash
git clone https://github.com/belalkhandev/covid-vaccine.git
cd covid-vaccine
```

### 2. Install dependencies

Run the following command to install the necessary PHP dependencies:

```bash
composer install
```

### 3. Set up environment configuration

Copy the `.env.example` file to a new `.env` file:

```bash
cp .env.example .env
```

### 4. Generate application key

Generate the Laravel application key:

```bash
php artisan key:generate
```

### 5. Configure the database

Update your `.env` file with your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 6. Run database migrations and seed data

Run the following command to create the necessary tables and seed initial data:

```bash
php artisan migrate --seed
```

### 7. Install frontend dependencies

Install Node.js dependencies:

```bash
npm install
```

### 8. Build frontend assets

Run the following command to compile and build frontend assets:

```bash
npm run dev   # For development mode
npm run build # For production mode
```

### 9. Run the application

Start the Laravel development server:

```bash
php artisan serve
```

You can now access the application at `http://127.0.0.1:8000` or `http://localhost:8000`.

## Routes

The following routes are available in the application:

- **Home Page**: Displays the home screen with options to check vaccine status or register for vaccination.
    - `GET /`: Home page.

- **Registration**: Displays the registration page where users can register for vaccination.
    - `GET /register`: Registration form page.

- **Check Vaccine Status**: Allows users to check their registration and vaccination status by entering their NID.
    - `GET /vaccine/check-status`: Status check form page.

- **Admin Vaccine List**: Displays the list of vaccine registrations (admin only) which has also search filtering options.
    - `GET /vaccine/list`: List of vaccine registrations.

## Scheduled Commands

The application uses the Laravel Task Scheduler to automate several processes:

1. **Assign Vaccine Schedule**:
    - This command assigns vaccination dates to users based on center availability using a first-come-first-serve strategy.
    - **Schedule**: Runs daily at 8 PM.
   ```php
   Schedule::command('vaccine:assign-scheduled')
       ->daily()
       ->at('20:00');
   ```

2. **Send Email Notification**:
    - This command sends an email to users at 9 PM the night before their scheduled vaccination date, reminding them of the schedule.
    - **Schedule**: Runs daily at 9 PM.
   ```php
   Schedule::command('vaccine:send-schedule-mail-to-recipients')
       ->daily()
       ->at('21:00');
   ```

3. **Update Recipient Status**:
    - This command updates the status of vaccine recipients. For instance, if their scheduled date has passed, their status is updated to `Vaccinated`.
    - **Schedule**: Runs daily at 7 PM.
   ```php
   Schedule::command('vaccine:update-recipient-status')
       ->daily()
       ->at('19:00');
   ```

## Command Line Utilities

- **Assign Vaccine Schedule**:
    - Manually assign schedules to registered users.
   ```bash
   php artisan vaccine:assign-scheduled
   ```

- **Send Schedule Notification**:
    - Manually send schedule emails to recipients.
   ```bash
   php artisan vaccine:send-schedule-mail-to-recipients
   ```

- **Update Recipient Status**:
    - Manually update the status of vaccine recipients.
   ```bash
   php artisan vaccine:update-recipient-status
   ```
