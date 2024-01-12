<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Upload Upload</title>
</head>
<body>
  <div class="container">
    <h1>Upload Portal</h1>
    <form id="uploadForm" enctype="multipart/form-data">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <label for="file">Choose a file:</label>
      <input type="file" id="file" name="file" accept=".pdf" required>
      <button type="button" onclick="uploadFile()">Upload</button>

<!-- Add this inside the <div class="container"> -->
<div id="progressBarContainer" style="display: none;">
  <div id="progressBar"></div>
</div>

    </form>
    <div id="status"></div>
  </div>
  <script src="script.js"></script>
</body>
</html>
