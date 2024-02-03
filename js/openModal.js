  // Function to open the modal
  function openProfileModal() {
    document.getElementById("profileModal").style.display = "block";
}

// Function to close the modal
function closeProfileModal() {
    document.getElementById("profileModal").style.display = "none";
}

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
    var modal = document.getElementById("profileModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}