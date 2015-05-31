
<?php
    if (isset($_POST['submitEnrollment']))
    {
      //print_r($_POST);
      if ($user)
      {        
        $_POST['userID'] = $user->id;       
        $enrollmentValidator = new FormsModel($_POST);
        $enrollmentReturn = $enrollmentValidator->validateEnrollment();          
      }
    } 
?>

<div class="background">
    <form method="post">
    <div class="formBackground">
      <legend><strong><h1>Enrollment Form</h1></strong></legend>
      <div id="enrollmentMessage" class="success" style="display:none"></div>
          <div>
              <div class="input"><label for="lName">Last Name</label></div>
              <div class="input"><input type="text" name="lName" placeholder="Doe" required value="<?php if(isset($_POST['lName'])){echo htmlspecialchars($_POST['lName']);} ?>"></div>
          </div>
          
          <div>
              <div class="input"><label for="fName">First Name</label></div>
              <div class="input"><input type="text" class="form-control" name="fName" placeholder="John" required value="<?php if(isset($_POST['fName'])){echo htmlspecialchars($_POST['fName']);} ?>"></div>
          </div>

          <div>
              <div class="input"><label for="streetAddress">Street Address</label></div>
              <div class="input"><textarea type="text" class="form-control" name="streetAddress" placeholder="123 Fake St" rows="3"><?php if(isset($_POST['streetAddress'])){echo htmlspecialchars($_POST['streetAddress']);} ?></textarea></div>
          </div>
          
          <div>
              <div class="input"><label for="city">City</label></div>
              <div class="input"><input type="text" class="form-control" name="city" placeholder="Spokane" value="<?php if(isset($_POST['city'])){echo htmlspecialchars($_POST['city']);} ?>"></div>
          </div>

          <div>
              <div class="input"><label for="phone">Phone</label></div>
              <div class="input"><input type="tel" class="form-control" name="phone" placeholder="(509)555-5555" value="<?php if(isset($_POST['phone'])){echo htmlspecialchars($_POST['phone']);} ?>"></div>
          </div>

          <div>
              <div class="input"><label for="email">E-mail</label></div>
              <div class="input"><input type="email" class="form-control" name="email" placeholder="johnDoe@abc.com" required value="<?php if(isset($_POST['email'])){echo htmlspecialchars($_POST['email']);} ?>"></div>
          </div>

          <div>
              <div class="input"><label for="dob">Date of Birth</label></div>
              <div class="input"><input type="date" class="form-control" name="dob" required value="<?php if(isset($_POST['dob'])){echo htmlspecialchars($_POST['dob']);} ?>"></div>
          </div>

          <div>
              <div class="input"style="font-weight:bold"><label>Gender</label></div>
            <div class="input"><input type="radio" name="gender" required <?php if (isset($_POST['gender']) && $_POST['gender'] == 1) echo "checked";?> value=1>Male</div>
            <div class="input"><input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender'] == 0) echo "checked";?> value=0>Female</div>
          </div>

          <div>
              <div class="input"><label for="healthHistory">Health History</label></div>
              <div class="input"><textarea type="text" class="form-control" name="healthHistory" rows="3"><?php if(isset($_POST['healthHistory'])){echo htmlspecialchars($_POST['healthHistory']);} ?></textarea></div>
          </div>

          <div >
              <div class="input"><label>Do you watch Sit and Be Fit?</label></div>
            <div class="input"><input type="radio" name="watchSbf" required <?php if (isset($_POST['watchSbf']) && $_POST['watchSbf'] == 1) echo "checked";?> value=1>Yes</div>
            <div class="input"><input type="radio" name="watchSbf" <?php if (isset($_POST['watchSbf']) && $_POST['watchSbf'] == 0) echo "checked";?> value=0>No</div>
          </div>

          <div name="howManyTimes">
              <div class="input"><label for="howMany">How many times a week?</label>            </div>
              <div class="input"><input type="number" class="form-control" name="howMany" value="<?php if(isset($_POST['howMany'])){echo htmlspecialchars($_POST['howMany']);}else{echo 1;} ?>"></div>
          </div>

          <div>
              <div class="input"><label for="controlGrp">Control Group (will NOT participate in Sit and Be Fit)</label></div>
            <div class="input"><input type="radio" name="controlGrp" required <?php if (isset($_POST['controlGrp']) && $_POST['controlGrp'] == 1) echo "checked";?> value=1>Yes</div>
            <div class="input"><input type="radio" name="controlGrp" <?php if (isset($_POST['controlGrp']) && $_POST['controlGrp'] == 0) echo "checked";?> value=0>No</div>
          </div>

          <div>
              <div class="input"><label for="experimentalGrp">Experimental Group (participate in Sit and Be Fit)</label></div>
            <div class="input"><input type="radio" name="experimentalGrp" required <?php if (isset($_POST['experimentalGrp']) && $_POST['experimentalGrp'] == 1) echo "checked";?> value=1>Yes</div>            
            <div class="input"><input type="radio" name="experimentalGrp" <?php if (isset($_POST['experimentalGrp']) && $_POST['experimentalGrp'] == 0) echo "checked";?> value=0>No</div>
          </div>

          <div class="enrollInput"><button type="submit" id="submitEnrollment" name="submitEnrollment">Submit</button></div>
        </div>
  </form>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script>
    <?php   if(isset($enrollmentReturn)) { ?>
    // display message upon success  or error
    $(document).ready(function () {
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