
// Get the input field
var input = document.getElementById("cmd");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("ok").click();
  }
});

function getSrc()
{
    document.getElementById('shellFrame').src ="shellHome.php?cmd=" + document.getElementById('cmd').value + "&regex="+ document.getElementById('regex').value;;
    
}


