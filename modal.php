<?php
echo "
<div id='myModal' class='modal'>

<!-- Modal content -->
<div class='modal-content'>
            <div class='modal-header'>
                <span class='close'>&times;</span>
                    <h2>$headerModal</h2>
            </div>
        <div class='modal-body'>
            <p>
                $usernameErr
                $passwordErr
                $modalSucess
            </p>
        </div>
        <div id='button' class='facebook'> 
          <a href='Signin.php'>Back to Signin</a>
        </div>
    </div>
</div>";
?>


<script>
  window.onload = function(){
  // Get the modal
  var modal = document.getElementById('myModal');
  
  // Get the button that opens the modal
  var btn = document.getElementById('submit');
  
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName('close')[0];
  modal.style.display = 'block';
  // When the user clicks the button, open the modal 
  // btn.onclick = function() {
  //     modal.style.display = 'block';
  // }
  
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
      modal.style.display = 'none';
  }
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = 'none';
      }
  }
}
  </script>
