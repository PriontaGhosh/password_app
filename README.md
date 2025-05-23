# Password Manager Project (PHP OOP)

This project is something I worked on for my Object-Oriented Programming class at VU Šiauliai Academy. It's a simple web app where a user can create an account, log in, generate a password, and save it securely in the database.

---

## What It Does

- Lets users sign up and log in
- Generates passwords based on options like length, uppercase/lowercase, numbers, etc.
- Saves the generated password securely using encryption
- Shows saved passwords for the logged-in user

---

## What I Used

- PHP with object-oriented code
- MySQL database (used phpMyAdmin to manage it)
- `mysqli` for connecting PHP to the database
- Basic HTML and CSS for the form layout
- AES encryption for password saving

---

## How I Tested It

I tested all the parts manually in the browser using `localhost`. I created a few test users, generated passwords for different platforms (like Gmail), and checked if they were saved properly. I also logged in again to make sure session worked and passwords were still showing.

---

## How To Run

1. Download or clone this project
2. Place the folder in `htdocs` if you're using XAMPP
3. Make a database in phpMyAdmin called `password_app`
4. Create two tables:
   - `users` (id, username, password, aes_key)
   - `passwords` (id, user_id, platform, password_data, created_at)
5. Edit `connect.php` if your MySQL password is different
6. Start XAMPP and go to this in browser:  
   `http://localhost/password_app/pages/signup.php`

---

## Notes

I committed after each part that I built or fixed. This includes things like fixing the login, saving passwords, showing them in a table, etc. All testing was done by me, and screenshots were added in the test report.

---

## About Me

**Name:** Prionta Ghosh  
**Course:** Object-Oriented Programming  
**University:** VU Šiauliai Academy
