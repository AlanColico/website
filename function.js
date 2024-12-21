// Toggle Menu Visibility
function toggleMenu() {
  const menu = document.getElementById('menu1');
  if (menu.classList.contains('show')) {
    menu.classList.remove('show');
    menu.classList.add('hide');
  } else {
    menu.classList.remove('hide');
    menu.classList.add('show');
  }
}

function scrollToSection(sectionId) {
  const section = document.getElementById(sectionId);
  if (section) {
    section.scrollIntoView({ behavior: 'smooth' });
  }
}

function handleSearch() {
  const searchInput = document.querySelector('.search-input').value.trim();
  if (searchInput) {
    console.log(`Searching for: ${searchInput}`);
  } else {
    console.log('Please enter a search term.');
  }
}

// Add event listener to menu icon
document.getElementById('menu-icon').addEventListener('click', function() {
  toggleMenu();
});

// Close menu on mobile when clicking outside
document.addEventListener('click', function (event) {
  const menu = document.getElementById('menu1');
  const menuIcon = document.getElementById('menu-icon');

  if (!menu.contains(event.target) && !menuIcon.contains(event.target)) {
    menu.classList.remove('show');
    menu.classList.add('hide');
  }
});

// Add event listener to unlock button
document.addEventListener("DOMContentLoaded", () => {
  const correctPasskey = "alanpogi"; // Replace with your desired passkey
  const unlockButton = document.getElementById("unlockButton");
  const passkeyInput = document.getElementById("passkey");
  const errorMessage = document.getElementById("error-message");
  const uploadBox = document.getElementById("upload-box");
  const accessDiv = document.getElementById("access");

  uploadBox.style.display = "none"; // Hide the upload form by default
  accessDiv.style.display = "block"; // Show the access section by default
  errorMessage.style.display = "none"; // Hide the error message by default

  unlockButton.addEventListener("click", () => {
    const enteredPasskey = passkeyInput.value;

    console.log("Entered Passkey:", enteredPasskey);
    console.log("Correct Passkey:", correctPasskey);

    if (enteredPasskey === correctPasskey) {
      accessDiv.style.display = "none"; // Hide the access section
      uploadBox.style.display = "block"; // Show the upload form
      toggleActionsVisibility(true); // Show Edit and Delete buttons
    } else {
      errorMessage.style.display = "block"; // Show error message
    }
  });

  passkeyInput.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
      unlockButton.click(); // Simulate button click when Enter key is pressed
    }
  });
  
    // Dummy announcements array (will now be loaded from localStorage)
    let announcements = JSON.parse(localStorage.getItem('announcements')) || [];

    document.getElementById('upload-box').addEventListener('submit', function(event) {
      event.preventDefault();  // Prevent form submission

      // Get the form values
      const title = document.getElementById('title').value;
      const description = document.getElementById('description').value;
      const link = document.getElementById('link').value;
      const fileInput = document.getElementById('fileUpload');
      const file = fileInput.files[0]; // Get the first selected file

      let fileUpload = ''; // Default value for fileUpload

      if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
              fileUpload = e.target.result;

              // Create the announcement object
              const announcement = { title, description, fileUpload, link };

              // Add the new announcement to the array and save it
              announcements.push(announcement);
              localStorage.setItem('announcements', JSON.stringify(announcements));

              // Render announcements and reset the form
              renderAnnouncements();
              resetUploadForm();
          };
          reader.readAsDataURL(file);
      } else {
          // Create announcement without file upload
          const announcement = { title, description, fileUpload, link };

          // Add to array and save to localStorage
          announcements.push(announcement);
          localStorage.setItem('announcements', JSON.stringify(announcements));

          // Render announcements and reset the form
          renderAnnouncements();
          resetUploadForm();
      }
    });

  window.editAnnouncement = function (index) {
    const announcement = announcements[index];

    // Populate the form fields with the selected announcement's details
    document.getElementById('title').value = announcement.title;
    document.getElementById('description').value = announcement.description;
    document.getElementById('link').value = announcement.link;

    // Show upload section for editing
    uploadBox.style.display = "block";

    // Update the submit button to save changes
    const submitButton = document.querySelector('#upload-box button[type=submit]');
    submitButton.textContent = "Save Changes";

    // Reset file input
    document.getElementById('fileUpload').value = "";

    // Add a temporary save handler
    submitButton.onclick = function (event) {
      event.preventDefault(); // Prevent default form submission
  
      // Update the announcement details
      announcement.title = document.getElementById('title').value;
      announcement.description = document.getElementById('description').value;
      announcement.link = document.getElementById('link').value;
  
      // Handle file upload
      const fileInput = document.getElementById('fileUpload');
      const file = fileInput.files[0];
  
      if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
              announcement.fileUpload = e.target.result; // Update the fileUpload field with the new image
  
              // Save updates to localStorage
              localStorage.setItem('announcements', JSON.stringify(announcements));
  
              // Render announcements without refreshing the page
              renderAnnouncements();
  
              // Reset the form
              resetUploadForm();
          };
          reader.readAsDataURL(file); // Read the file as a base64 URL
      } else {
          // Save updates without changing the fileUpload field
          localStorage.setItem('announcements', JSON.stringify(announcements));
  
          // Render announcements without refreshing the page
          renderAnnouncements();
  
          // Reset the form
          resetUploadForm();
      }
  };  
};


    // Function to reset the upload form and submit button text
    function resetUploadForm() {
      // Clear form fields
      document.getElementById('title').value = '';
      document.getElementById('description').value = '';
      document.getElementById('link').value = '';
      document.getElementById('fileUpload').value = '';
  
      // Reset the submit button text to "Submit Announcement"
      const submitButton = document.querySelector('#upload-box button[type=submit]');
      submitButton.textContent = "Submit Announcement";
  
      // Remove any temporary onclick handlers
      submitButton.onclick = null;
  
      // Hide the upload box (if necessary)
      uploadBox.style.display = "none";
  }


    window.deleteAnnouncement = function (index) {
      // Remove the announcement from the array
      announcements.splice(index, 1);

      // Save updated announcements to localStorage
      localStorage.setItem('announcements', JSON.stringify(announcements));

      // Refresh the page to reflect changes
      location.reload();
    };

    // Ensure Edit and Delete buttons are only visible after unlocking
    function toggleActionsVisibility(isUnlocked) {
      const editButtons = document.querySelectorAll('.Editactions');
      const deleteButtons = document.querySelectorAll('.Deleteactions');

      editButtons.forEach(button => {
          button.style.display = isUnlocked ? 'inline-block' : 'none';
      });

      deleteButtons.forEach(button => {
          button.style.display = isUnlocked ? 'inline-block' : 'none';
      });
    }

    // Modify the unlock button logic to show the buttons when unlocked
    unlockButton.addEventListener("click", () => {
      const enteredPasskey = passkeyInput.value;

      if (enteredPasskey === correctPasskey) {
          accessDiv.style.display = "none"; // Hide the access section
          uploadBox.style.display = "block"; // Show the upload form
          toggleActionsVisibility(true); // Show Edit and Delete buttons
      } else {
          errorMessage.style.display = "block"; // Show error message
      }
    });

    // Ensure buttons are hidden initially for public view
    toggleActionsVisibility(false);

// Function to render the announcements
function renderAnnouncements() {
  const announcementList = document.getElementById('announcementList');
  announcementList.innerHTML = ''; // Clear previous announcements

  announcements.forEach((announcement, index) => {
      const announcementCard = document.createElement('div');
      announcementCard.classList.add('card', 'hidden'); // Add hidden class initially

      // Constructing the inner HTML for each announcement card
      announcementCard.innerHTML = `
          <div class="content">
              ${announcement.fileUpload ? `<img src="${announcement.fileUpload}" alt="${announcement.title}" />` : ''}
              <h3 class="title">${announcement.title}</h3>
              <p class="desc">${announcement.description}</p>
              <div class="action">${announcement.link ? `<a href="${announcement.link}" target="_blank"><span>Find out more</span></a>` : ''}</div>
              <div class="Editactions" style="display: none;" id="Editactions-${index}">
                  <button class="action" onclick="editAnnouncement(${index})">Edit</button>
              </div>
              <div class="Deleteactions" style="display: none;" id="Deleteactions-${index}">
                  <button class="action" onclick="deleteAnnouncement(${index})">Delete</button>
              </div>
          </div>
      `;

      // Append the new card to the announcement list
      announcementList.appendChild(announcementCard);

      // Remove the hidden class to show the announcement card with an animation
      setTimeout(() => {
          announcementCard.classList.remove('hidden');
      }, 100);
  });
}

// Initial render of announcements
renderAnnouncements();

// Helper function to add 'show' class when an element enters the viewport
function handleScrollAnimation() {
  const cards = document.querySelectorAll('.card');
  const animatedText = document.querySelector('.animated-text');

  // Animate cards
  cards.forEach((card) => {
    const rect = card.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom >= 0) {
      card.classList.add('show'); // Add 'show' class for animation
    }
  });

  // Animate welcome text
  if (animatedText) {
    const rect = animatedText.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom >= 0) {
      animatedText.classList.add('show'); // Add 'show' class for animation
    }
  }
}

// Attach scroll event listener
document.addEventListener('scroll', handleScrollAnimation);
document.addEventListener('DOMContentLoaded', handleScrollAnimation); // Trigger on page load
      

});