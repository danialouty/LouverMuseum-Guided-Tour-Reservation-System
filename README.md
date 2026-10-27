# Louvre Museum Guided Tour Reservation System

A PHP and MySQL web application for managing Louvre Museum guided-tour reservations.

## Features

### Users

- Register, log in, and log out
- View available tour time slots
- Check remaining capacity
- Create reservations with optional notes
- View reservation status
- Cancel personal reservations before the tour begins

### Administrators

- View dashboard statistics
- Manage reservations
- Confirm, reject, or cancel reservations
- Search and filter reservations
- Manage user accounts
- Activate or deactivate users
- Create and delete available time slots
- View reservation statistics using Chart.js

## Technologies

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript

## Installation

1. Clone the repository:

```bash
git clone https://github.com/danialouty/LouverMuseum-Guided-Tour-Reservation-System.git
```

2. Move the project into your XAMPP `htdocs` folder.

3. Start Apache and MySQL.

4. Create a MySQL database named:

```text
Museum-Guided-Tour-Reservation-System
```

5. Update the database settings in `config.php`.



## Business Rules

- Users cannot book past time slots.
- Users cannot book the same slot more than once.
- Time-slot capacity is enforced.
- Cancelled and rejected reservations do not count toward capacity.
- Only administrators can approve or reject reservations.
- Users can access only their own reservations.
- Deactivated users cannot log in.
- Time slots with active reservations cannot be deleted.

## Testing

The system should be tested for:

- Registration and login
- Reservation creation and cancellation
- Duplicate reservation prevention
- Capacity validation
- Admin access protection
- Reservation status updates
- User activation and deactivation
- Time-slot deletion rules


## Author

Developed by **danialouty** for educational purposes.
