<!-- head.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- this is for icon boostrap 4.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      padding-top: 56px; /* Adjust this value based on your navigation bar height */
    }
  </style>
  <?php
    if (isset($customCssFile)) {
      echo '<link rel="stylesheet" href="' . $customCssFile . '">';
    }
  ?>
  <!-- Include jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript to set active link -->
<script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the current page filename (e.g., "dashboard.php")
            var currentPage = window.location.href.split('/').pop();

            // Find the link corresponding to the current page and add the 'active' class
            var navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            navLinks.forEach(function (link) {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                }
            });
        });
</script>
</head>