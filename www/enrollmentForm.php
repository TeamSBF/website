<?php
    require_once"header.php";

    if (isset($_POST['submitEnrollment']))
    {
      //echo var_dump($_POST); //DEBUG
      $validator = new FormsModel($_POST);
      $return = $validator->ValidateEnrollment();
    } 
?>


<div class="container">
<div class="background">
    
  <div><form method="post" class="form-horizontal">
      <div class="alert" id="message" style="display:none"></div>
      <div><h2>Enrollment</h2>
          <div><label>Last Name</label>
            <div><input type="text" name="lName" placeholder="Doe" value="<?php if(isset($_POST['lName'])){echo htmlspecialchars($_POST['lName']);} ?>"></div>
          </div>

          <div><label for="fName">First Name</label></div>
              <input type="text" name="fName" placeholder="John" value="<?php if(isset($_POST['fName'])){echo htmlspecialchars($_POST['fName']);} ?>">
          </div>

          
            <div><label>Street Address</label></div>
              <textarea type="text" name="streetAddress" placeholder="Street Address" rows="3" value="<?php if(isset($_POST['streetAddress'])){echo htmlspecialchars($_POST['streetAddress']);} ?>">
              </textarea>

            <div><label>City</label></div>
              <input type="text" name="city" placeholder="Spokane" value="<?php if(isset($_POST['city'])){echo htmlspecialchars($_POST['city']);} ?>">

           <div><label>Phone</label></div>
              <input type="tel" name="phone" placeholder="(509)-555-5555" value="<?php if(isset($_POST['phone'])){echo htmlspecialchars($_POST['phone']);} ?>">
            
            <div><label>Email</label></div>
              <input type="email" name="email" placeholder="johnDoe@abc.com" value="<?php if(isset($_POST['email'])){echo htmlspecialchars($_POST['email']);} ?>">

            <div><label>Date of Birth</label></div>
              <input type="date" name="dob" value="<?php if(isset($_POST['dob'])){echo htmlspecialchars($_POST['dob']);} ?>">


            <div><label>Gender</label></div>
            <div><input type="radio" name="gender" required checked value="Male">Male</div>
            <div><input type="radio" name="gender" value="Female">Female</div>

          <div class="form-group">
            <label for="healthHistory" class="control-label col-sm-3">Health History</label>
            <div class="col-sm-9">
              <textarea type="text" class="form-control" name="healthHistory" rows="3">
              </textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4">Do you watch Sit and Be Fit?</label>
            <label class="radio-inline"><input type="radio" name="watchSbf" required checked value="yes">Yes</label>
            <label class="radio-inline"><input type="radio" name="watchSbf" value="no">No</label>
          </div>

          <div class="form-group" name="howManyTimes">
            <label for="howMany" class="control-label col-sm-3">How many times a week?</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="howMany" value="<?php if(isset($_POST['howMany'])){echo htmlspecialchars($_POST['howMany']);}else{echo 1;} ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4">Control Group (will NOT participate in Sit and Be Fit)
            </label>
            <label class="radio-inline"><input type="radio" name="controlGrp" required checked value="yes">Yes</label>
            <label class="radio-inline"><input type="radio" name="controlGrp" value="no">No</label>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4">Experimental Group (participate in Sit and Be Fit)
            </label>
            <label class="radio-inline"><input type="radio" name="experimentalGrp" required checked value=1>Yes
            </label>
            <label class="radio-inline"><input type="radio" name="experimentalGrp" value=0>No
            </label>
          </div>

          <button type="submit" name="submitEnrollment">Submit</button>
        </div>
      </div>
    </div>
  </form>

  <div id="returnMessage" class="alert"></div>
    
</div>
</div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <?php if(isset($return) && !empty($return)){?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
    $(document).ready(function (){
      $("#message").addClass('alert-danger');
      $("#message").html('<?= $return;?>');
      $("#message").show();
    });
    </script>
    <?php } ?>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
<?php require_once"footer.php";?>

















