<?php
include('../DatabaseConnection.php');
require 'include/Exception.php';
require 'include/PHPMailer.php';
require 'include/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['submit'])) {
    $success = false; // Initialize the success flag

    // If the button is clicked, check whether the student list is in the group list or not
    // If the student is not in the group list, insert them into the group
    // Otherwise, remove the existing group and insert the new group

    $student_list = $_POST['student_list'];
    $program_id = $_POST['program_id'];
    $lecturer_id = $_POST['lecturer_id'];

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prosheng021103@gmail.com';
        $mail->Password = 'hmasmtcewcqrtlex';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('your_email@gmail.com', 'prosheng021103@gmail.com');
        $mail->isHTML(true);

        foreach($student_list as $student_id) {
            $sqlSelectStudentInGroup = "SELECT * FROM group_student_lecturer WHERE Student_Id='$student_id'";
            $resultsqlSelectStudentInGroup = mysqli_query($conn, $sqlSelectStudentInGroup);

            if (mysqli_num_rows($resultsqlSelectStudentInGroup) < 1) {
                $sql = "INSERT INTO group_student_lecturer (Student_Id, Lecturer_Id) VALUES ('$student_id', '$lecturer_id')";
                if (mysqli_query($conn, $sql)) {
                    // Get student's email and name
                    $studentInfoQuery = "SELECT s.Email AS Student_Email, s.Student_Name, l.Lecturer_Name FROM student s
                                        INNER JOIN lecturer l ON l.Lecturer_Id = '$lecturer_id'
                                        WHERE s.Student_Id = '$student_id'";
                    $studentInfoResult = mysqli_query($conn, $studentInfoQuery);
                    $studentInfoRow = mysqli_fetch_assoc($studentInfoResult);
                    $studentEmail = $studentInfoRow['Student_Email'];
                    $studentName = $studentInfoRow['Student_Name'];
                    $lecturerName = $studentInfoRow['Lecturer_Name'];

                    // Get lecturer's email
                    $lecturerEmailQuery = "SELECT Email FROM lecturer WHERE Lecturer_Id = '$lecturer_id'";
                    $lecturerEmailResult = mysqli_query($conn, $lecturerEmailQuery);
                    $lecturerEmailRow = mysqli_fetch_assoc($lecturerEmailResult);
                    $lecturerEmail = $lecturerEmailRow['Email'];

                    // Send emails to student and lecturer
                    $studentMessage = "You have been grouped with lecturer $lecturerName.";
                    $lecturerMessage = "You have been grouped with student $studentName.";

                    $mail->addAddress($studentEmail);
                    $mail->Subject = 'Grouping Notification';
                    $mail->Body = $studentMessage;
                    $mail->send();

                    $mail->clearAddresses();

                    $mail->addAddress($lecturerEmail);
                    $mail->Body = $lecturerMessage;
                    $mail->send();

                    header("location:admin_group.php?success=Updated student list to lecturer successfully!");
                } 
            } else {
                $sqlDeleteOldGroup2 = "DELETE FROM group_student_lecturer WHERE Student_Id='$student_id'";
                mysqli_query($conn, $sqlDeleteOldGroup2);
                $sqlDeleteOldGroup = "DELETE FROM group_student_lecturer WHERE Lecturer_Id='$lecturer_id'";
                mysqli_query($conn, $sqlDeleteOldGroup);

                $sqlInsertNewGroup = "INSERT INTO group_student_lecturer (Student_Id, Lecturer_Id) VALUES ('$student_id', '$lecturer_id')";
                if (mysqli_query($conn, $sqlInsertNewGroup)) {
                    header("location:admin_group.php?success=Updated student list to lecturer successfully!");
                }
            }
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
