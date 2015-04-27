<?php

    if (isset($_POST['submitEnrollment']))
    {
      //print_r($_POST);
      if ($user)
      {
        $_POST['userID'] = $user->id;
        $enrollmentValidator = new FormsModel($_POST);
        $enrollmentReturn = $enrollmentValidator->validateEnrollment();
        //print_r($enrollmentReturn);      
      }      
    } 
?>


<div class="background">
    <form method="post" class="form-horizontal">
      <legend>ENROLLMENT FORM</legend>
      <div id="enrollmentMessage" class="success" style="display:none"></div>
      <fieldset>
          <div>
            <label for="lName">Last Name</label>
            <input type="text" name="lName" placeholder="Last Name" required value="<?php if(isset($_POST['lName'])){echo htmlspecialchars($_POST['lName']);} ?>">
          </div>

          <div>
            <label for="fName">First Name</label>
            <input type="text" class="form-control" name="fName" placeholder="First Name" required value="<?php if(isset($_POST['fName'])){echo htmlspecialchars($_POST['fName']);} ?>">            
          </div>

          <div>
            <label for="streetAddress">Street Address</label>
              <textarea type="text" class="form-control" name="streetAddress" placeholder="Street Address" rows="3" value="<?php if(isset($_POST['streetAddress'])){echo htmlspecialchars($_POST['streetAddress']);} ?>"></textarea>
          </div>

          <div>
            <label for="city">City</label>
              <input type="text" class="form-control" name="city" placeholder="City" value="<?php if(isset($_POST['city'])){echo htmlspecialchars($_POST['city']);} ?>">
          </div>

          <div>
            <label for="phone">Phone</label>
              <input type="tel" class="form-control" name="phone" placeholder="Phone Number" value="<?php if(isset($_POST['phone'])){echo htmlspecialchars($_POST['phone']);} ?>">
          </div>

          <div>
            <label for="email">Email</label>
              <input type="email" class="form-control" name="email" placeholder="johnDoe@abc.com" required value="<?php if(isset($_POST['email'])){echo htmlspecialchars($_POST['email']);} ?>">
          </div>

          <div>
            <label for="dob">Date of Birth</label>
              <input type="date" class="form-control" name="dob" required value="<?php if(isset($_POST['dob'])){echo htmlspecialchars($_POST['dob']);} ?>">
          </div>

          <div>
            <div style="font-weight:bold">Gender</div>
            <div><input type="radio" name="gender" required <?php if (isset($_POST['gender']) && $_POST['gender'] == 'Male') echo "checked";?> value="Male">Male</div>
            <div><input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'Female') echo "checked";?> value="Female">Female</div>
          </div>

          <div>
            <label for="healthHistory">Health History</label>
              <textarea type="text" class="form-control" name="healthHistory" rows="3"></textarea>
          </div>

          <div>
            <label class="control-label col-sm-4">Do you watch Sit and Be Fit?</label>
            <div><input type="radio" name="watchSbf" required <?php if (isset($_POST['watchSbf']) && $_POST['watchSbf'] == 'Yes') echo "checked";?> value="Yes">Yes</div>
            <div><input type="radio" name="watchSbf" <?php if (isset($_POST['watchSbf']) && $_POST['watchSbf'] == 'No') echo "checked";?> value="No">No</div>
          </div>

          <div name="howManyTimes">
            <label for="howMany">How many times a week?</label>            
              <input type="number" class="form-control" name="howMany" value="<?php if(isset($_POST['howMany'])){echo htmlspecialchars($_POST['howMany']);}else{echo 1;} ?>">
          </div>

          <div>
            <label for="controlGrp">Control Group (will NOT participate in Sit and Be Fit)</label>
            <div><input type="radio" name="controlGrp" required <?php if (isset($_POST['controlGrp']) && $_POST['controlGrp'] == 'Yes') echo "checked";?> value="Yes">Yes</div>
            <div><input type="radio" name="controlGrp" <?php if (isset($_POST['controlGrp']) && $_POST['controlGrp'] == 'No') echo "checked";?> value="No">No</div>
          </div>

          <div>
            <label for="experimentalGrp">Experimental Group (participate in Sit and Be Fit)</label>
            <div><input type="radio" name="experimentalGrp" required <?php if (isset($_POST['experimentalGrp']) && $_POST['experimentalGrp'] == 'Yes') echo "checked";?> value="Yes">Yes</div>            
            <div><input type="radio" name="experimentalGrp" <?php if (isset($_POST['experimentalGrp']) && $_POST['experimentalGrp'] == 'No') echo "checked";?> value="No">No</div>
          </div>

          <input class="btn-primary" type="submit" name="submitEnrollment">
      </fieldset>
  </form>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    <?php   if(isset($enrollmentReturn)) { ?>
    // display message upon success  or error
    $(document).ready(function () {
      debugger;
      var message;
      <?php if ($enrollmentReturn == false) { ?>
        message = "<strong>Error!</strong> Something went wrong while saving the form data.\nHave you already completed and submitted this form?.";
        $("#enrollmentMessage").removeClass("success").addClass("error");
        $("#enrollmentMessage").html(message);
        $("#enrollmentMessage").show();         
        <?php   }
        else if ($enrollmentReturn == "success") { ?>
          message = "<strong>Success!</strong?> Form submitted!";          
          $("#enrollmentMessage").removeClass("error").addClass("success");
          $("#enrollmentMessage").html(message);
          $("#enrollmentMessage").show();         
          <?php }
        else { ?>
          message = "<strong>Error!</strong?> ";
          $("#enrollmentMessage").removeClass("success").addClass("error");
          $("#enrollmentMessage").html(message + '<?= $enrollmentReturn; ?>');
          $("#enrollmentMessage").show();
          <?php } ?>
        }); 
  <?php } ?>
</script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

















