# Internship Project: User Registration & Profile System

## Problem Statement
Create a signup page where a user can register and a login page to log in with the details provided during registration.  
Successful login redirects to a profile page containing additional details such as age, date of birth (DOB), contact, etc.  
Users can also update their profile information.

**Flow:** Register → Login → Profile

---

## Project Overview
This project is a **local user registration and profile system** built using PHP, MySQL, Redis, and AJAX.  
The system allows users to:

- Register with their details
- Login and maintain sessions via **localStorage + Redis**
- View and update their profile, including profile picture and password (static/local)
- All frontend-backend communication is via **AJAX**  
- Forms are designed in **Bootstrap** for responsiveness  

> ⚠️ Note: This project works fully on a **local machine** using XAMPP. Cloud deployment was not implemented due to time constraints.  

---

## Achievements
- Successfully implemented **registration and login system** with validation  
- **Profile page** allows updating age, DOB, contact, password, and profile picture  
- **AJAX interactions** with PHP backend using prepared statements  
- Session management using **localStorage + Redis**  

---

## Challenges & Limitations
- Cloud deployment not done — project works only on local machine  
- Profile image storage is local, not in cloud storage  
- MongoDB was not used (MySQL was sufficient for structured data)  
- PHP is a new domain for me, so some optimizations were skipped  
- Time constraints prevented containerization and cloud-ready setup  
- Only partially completed — static content remains in some parts  

---

## Technology Stack
- **Frontend:** HTML, CSS (Bootstrap), JS, jQuery (AJAX)  
- **Backend:** PHP  
- **Database:** MySQL (local, XAMPP)  
- **Session Storage:** Redis (local)  
- **Server Environment:** XAMPP  

---

## Folder Structure

hcl_guvi/
│
├─ assets/
│ ├─ css/
│ │ └─ styles.css
│ └─ js/
│ ├─ login.js
│ ├─ profile.js
│ └─ register.js
│
├─ php/
│ ├─ login.php
│ ├─ register.php
│ └─ profile.php
│
├─ login.html
├─ register.html
└─ profile.html


---

## How to Run Locally
1. Install **XAMPP** and start Apache & MySQL  
2. Import the provided MySQL database schema  
3. Place the project folder in `htdocs` (e.g., `C:\xampp\htdocs\hcl_guvi`)  
4. Navigate to `http://localhost/hcl_guvi/login.html` in a browser  
5. Register a new user and test login/profile functionalities  

---

## Screenshots / Images
1. Index.html
<img width="1908" height="385" alt="image" src="https://github.com/user-attachments/assets/bbb4d96f-95c6-496d-8798-e5640dd90b17" />
2.Register.html
<img width="1902" height="1067" alt="image" src="https://github.com/user-attachments/assets/8afa9f9a-05aa-4868-a392-0bf920297749" />
3.Login.html
<img width="1902" height="605" alt="image" src="https://github.com/user-attachments/assets/ae3de9c9-8b66-471b-bfe9-1a4fd0d6ffc0" />
4.Profile.html
<img width="1915" height="1067" alt="image" src="https://github.com/user-attachments/assets/e4b133cc-9c9b-4843-8035-8b8e4f0cd479" />
5.User Details stored in the database using PhpMyAdmin
<img width="1248" height="682" alt="image" src="https://github.com/user-attachments/assets/20a399e9-38d3-431e-ad99-d50d74a991cb" />





