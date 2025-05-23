# Password Manager Project (PHP OOP)

This project is something I worked on for my Object-Oriented Programming class at VU Šiauliai Academy. It's a simple web app where a user can create an account, log in, generate a password, and save it securely in the database. I added basic styling and small user experience features like success messages and password visibility.

---

## What It Does

- Lets users sign up and log in
- Generates passwords based on options like length, uppercase/lowercase, numbers, etc.
- Saves the generated password securely using AES encryption
- Shows a success message after saving
- Lets user click a button to view saved passwords on the dashboard

---

## What I Used

- PHP with object-oriented code
- MySQL database (managed with phpMyAdmin)
- `mysqli` to connect PHP with the database
- Basic HTML and CSS for form layouts
- AES-128-ECB encryption for storing passwords securely

---

## How I Tested It

I tested all the parts manually in the browser using `localhost`. I created a few users through the signup form, generated passwords for different platforms (like Gmail or Facebook), and then checked if they were saved properly. I also used phpMyAdmin to check the actual encrypted entries in the database. I added a button to show saved passwords only when needed, and tested the visual feedback after each generation.

---

## How To Run

1. Download or clone this project
2. Place the folder in `htdocs` (if you're using XAMPP)
3. Create a MySQL database called `password_app`
4. Create two tables:
   - `users` (id, username, password, aes_key)
   - `passwords` (id, user_id, platform, password_data, created_at)
5. Open and update `database/connect.php` if your MySQL password is different
6. Start XAMPP and open this in your browser:  
   `http://localhost/password_app/pages/signup.php`

---

## Notes

I committed after every part I built or fixed — like after creating forms, adding password logic, fixing login, and adding the table to show saved passwords. I also improved the layout slightly to make it more readable. Screenshots and test steps were added in my report for each feature.

---

## About Me

**Name:** Prionta Ghosh  
**Course:** Object-Oriented Programming  
**University:** VU Šiauliai Academy
