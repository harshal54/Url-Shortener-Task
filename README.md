url-shortener-taskURL
# Shortener Task
# Overview #
 This project is a URL shortener and invitation-based access system built using Laravel 11 and PHP 8.2. It supports role-based invitations (Super Admin, Admin, Member) and tracks the number of times each generated URL is accessed.

# Tech Stack
PHP: 8.2
Framework: Laravel 11

# Database: MySQL 
# After downloading and extracting the ZIP file, follow these steps: run the following command

-> composer install
-> php artisan key:generate 
-> php artisan migrate:fresh --seed 
-> php artisan serve

# The application will be available at: http://127.0.0.1:8000

# Invitation & Authentication Flow 
Super Admin → Admin A Super Admin can invite an Admin. An Admin can invite an Member.

# How to Test->
1. Log in as Super Admin 
2. Invite an Admin Copy the generated invitation URL 
3. Open the URL in a new browser tab
4. Verify login and access count increment 
5. Repeat the same flow for Members

# Design Note : 
1. ChatGPT was used only for UI/UX design assistance.
2. All application logic, authentication flow, and business rules were implemented manually.
3. ChatGPT was not used for core functionality or system logic.

# Notes & Assumptions
1. Email delivery (SMTP) is intentionally excluded. Invitation URLs act as a temporary access mechanism. 
2. The project focuses on functionality and clean flow rather than external integrations.

# Conclusion 
1. This project demonstrates: Role-based invitation handling Secure URL generation Access count tracking

Clean Laravel 11 architecture
