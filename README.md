DEIVIDAS URBANAVIČIUS - NFQ PHP INTERNSHIP
--
This project is made with **PHP**.

All data is stored in MySQL database.

Task is implemented as a web application using OOP principles with **PHP**.

**Functional requirements results**:

1. On first visit user can create a new project by providing a title of the project and
a number of groups that will participate in the project and a maximum number of
students per group. Also, Groups are automatically initialized when a project is created. Also, there're validations: if user enters not number - he can see error that he must enter only number, if user enters in name input only numbers - he can see error that he must enter only letters. If user don't enter anything in any input and submits - he can see error that he can't leave inputs empty.

2. When project exists, user can add new students using the “Add new student” button. Popup (used JavaScript for that) will be shown to enter full name of student. If student's name already exists in database, user gets validation that this student already exists. User gets a chance to go back and try again. If user enters only numbers - user also sees validation, that he can't enter number. If user don't enter anything - he can see error, that he must enter name.

3. When everything is correct with registration - student is successfully stored to the database and is visible on a students' list.

4. User can delete a student. In such a case, the student is removed from the group and project.

5. User can assign a student to any of the groups. Any student can only be assigned to a single group. When student is assigned to the group, his **group_id** and new **date** (by current time) being updated. In all groups students are ordered by their date ASC. So ho was added first to the group - he will be first. And if the group is full, information text "Group is full" (orange color) is visible.

6. I have uploaded this project to my own website: **https://urba.website** , so it's publicly accessible. You can test it, also delete project with all information and start per new.

**Bonus requirements results**:

1. Information (students, groups) on the page automatically updates every 10 seconds, so when user change any information from one browser, and another user who also use the same page in another browser, he can see every updated information every 10 seconds.

In **project.php Line:30** you can find my solution to this update. With **jQuery** help information in <div class="groups" id="groupsUpdate"></div> is shown from groups.php file and in <table class="projectInfoTable" id="projectInfoTable"></table> info is shown from **students_list.php**.

2. Implemented RESTful API in **classes/Student.php Line:35 getStudents() function** and with this API I've mapped all information in **groups.php** and **students_list.php** so that al information could be visible in project.

3. Automated test is created with **phpunit: ^9.5**. I couldn't upload **vendor** folder files here. Test can be found at **tests/StudentTest.php**.
