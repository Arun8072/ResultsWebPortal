This website is a student portal for checking arrear count and detailed semester-wise arrears. The design is clean, user-friendly, and includes PDF download functionality.





1. index.html:
   - Contains login form capturing Register Number, Student Name, and Date of Birth.
   - Utilizes basic HTML form elements with simple styling.

2. total.php:
   - Handles total arrear count functionality.
   - Connects to MySQL database for information retrieval.
   - Sanitizes input data from POST request.
   - Executes SQL query for total arrear count.
   - Renders result with styling and provides button for details.

3. marks.php:
   - Generates detailed marks page for a student.
   - Connects to MySQL database for data extraction based on registration number.
   - Displays a table with subjects, grades, and additional details.
   - Provides a button to download the page as a PDF.
   - Uses JavaScript to dynamically update tooltips with subject names.


4. create_pdf.php:
   - Uses FPDF library to generate a PDF document.
   - Retrieves data from MySQL based on registration number.
   - Determines subject arrears and updates status.
   - Creates a PDF with a table displaying semester-wise subject details.
   - Outputs PDF for user download.

5. update.php:
   - This file is responsible for updating student information.
   - Connects to the MySQL database for data manipulation.
   - Utilizes POST data to update student details such as name and registration number.
   - Performs input validation and sanitization.
   - Executes an SQL query to update the database with new information.
   - Provides feedback on the success or failure of the update operation.

6. styl.css:
   - Defines styles for HTML elements in login form.
   - Utilizes Montserrat-Regular font.
   - Implements clean and responsive design with gradient background, form styling, and input animations.

7. Montserrat-Regular.ttf:
   - Font file for styling in CSS.

8. FPDF186 folder:
   - Contains files related to FPDF library for PDF generation.

