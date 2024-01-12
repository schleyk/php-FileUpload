function uploadFile() {
  var emailInput = document.getElementById('email');
  if (!isValidEmail(emailInput.value)) {
    alert('Please enter a valid email address.');
    return false;
  }

  var form = document.getElementById('uploadForm');
  if (!form.checkValidity()) {
    alert('Please fill in all required fields.');
    return false;
  }


  // Show the progress bar container
  var progressBarContainer = document.getElementById('progressBarContainer');
  progressBarContainer.style.display = 'block';


  var formData = new FormData(form);

  var xhr = new XMLHttpRequest();

  // Track the upload progress
  xhr.upload.addEventListener('progress', function(event) {
    if (event.lengthComputable) {
      var percentComplete = (event.loaded / event.total) * 100;
      // Update the progress bar
      updateProgressBar(percentComplete);
    }
  });

  xhr.open('POST', 'upload.php', true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      document.getElementById('status').innerHTML = response.message;
      // Reset the progress bar after the upload is complete
//      updateProgressBar(0);
    } else if (xhr.readyState === 4) {
      document.getElementById('status').innerHTML = 'Error uploading file.';
      // Reset the progress bar on error
//      updateProgressBar(0);
    }
  };

  xhr.send(formData);

  // Prevent the default form submission
  return false;
}

function isValidEmail(email) {
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function updateProgressBar(percent) {
  var progressBar = document.getElementById('progressBar');
  progressBar.style.width = percent + '%';
}
