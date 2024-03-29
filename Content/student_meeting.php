<!-- courses.php -->
<?php
  $pageTitle = "Meeting | Etutor";
  $customCssFile = '../Styles/student_meeting.css';

  include('../Header/head.php');
  include('../Header/student_navibar.html');
?>

<body>
<div class="meeting-container">
<div class="container">
  <h2 class="mt-5">Schedule Meeting with "Lecture Name"</h2>
  <form action="schedule_meeting.php" method="post" class="mt-4">
    <div class="form-group">
      <label for="timeSlot">Select Time Slot:</label>
      <select id="timeSlot" name="timeSlot" class="form-control">
        <option value="1">8:00 AM - 9:00 AM</option>
        <option value="2">9:00 AM - 10:00 AM</option>
        <option value="3">10:00 AM - 11:00 AM</option>
      </select>
    </div>
    <div class="form-group">
      <label for="meetingDate">Select Meeting Date:</label>
      <input type="date" id="meetingDate" name="meetingDate" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Schedule Meeting</button>
  </form>
</div>
</div>
</body>
</html>