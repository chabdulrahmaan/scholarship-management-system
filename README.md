# Scholarship Management System

The Scholarship Management System is a web application developed using PHP. It allows students to apply for scholarships, signatories to list their scholarships and validate student applications, and administrators to manage users and scholarship applications. This system aims to streamline the scholarship application and validation process efficiently.

## Features

- **Students**: Apply for scholarships.
- **Signatory**: List scholarships and validate student applications.
- **Admin**: Validate students and signatories, and accept or reject scholarships.

## Setup Instructions

Follow these steps to set up the project on XAMPP:

1. **Install XAMPP**:
   - Ensure that XAMPP is properly installed on your system. You can download it from the official [XAMPP website](https://www.apachefriends.org/index.html) if it is not already installed.

2. **Extract Project Files**:
   - Extract the contents of the project ZIP file to the `htdocs` folder in your XAMPP installation directory.

3. **Start XAMPP Services**:
   - Open the XAMPP Control Panel and start the Apache and MySQL services.

4. **Create the Database**:
   - Open your web browser and navigate to `http://localhost/phpmyadmin`.
   - Click on the "New" button on the top-left side to create a new database.
   - Name the database `scholarship_management_system`.
   - Import the SQL file located in the `database` folder of the project files.

5. **Access the Project**:
   - Open your web browser and go to `http://localhost/your-project-name`. For example, if your project name is `scholarship-management-system`, navigate to `http://localhost/scholarship-management-system`.

6. **Default User Credentials**:
   - All users (admin, signatory, students) have the default password `123`.

By following these instructions, you should be able to set up and run the project successfully on XAMPP.
