<?php

    if (isset($_POST['submitQuestionnaireP1']))
    {
      $validator = new FormsModel($_POST);
      $return = $validator->ValidateQuestionnaireP1();
    }
    //$radio = new MakeRadio();
?>

      <div class="container">
        <div class="col-sm-8 col-sm-offset-2">
          <legend><strong>Pre-Study Questionnaire Part 1<br></strong></legend>

          <form class="form-vertical" method="post">

           <div class="panel panel-primary">
            <div class="panel-heading">You and Sit and Be Fit</div>
            <div class="panel-body">
              <div class="alert" id="message" style="diplay:none"></div>
              <div class="form-group">
                <label>*How often do you perform the Sit and Be Fit exercises?</label><br>
                <label class="radio col-sm-offset-2"><input type="radio" name="howOftenPerform" required checked value=0>Less than once a month</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="howOftenPerform" value=1>Once per month</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="howOftenPerform" value=2>Once per week</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="howOftenPerform" value=3>More than once per week</label>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label">*How long have you participated in the Sit and Be Fit program?</label><br>
                <label class="radio col-sm-offset-2"><input type="radio" name="howLongParticipate" required checked value=0>Less than 3 months</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="howLongParticipate" value=1>3 to 6 months</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="howLongParticipate" value=2>6 to 12 months</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="howLongParticipate" value=3>More than 12 months</label>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label">*You exercise:</label><br>
                <label class="radio col-sm-offset-2"><input type="radio" name="whoExerciseWith" required checked value=0>By yourself</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="whoExerciseWith" value=1>With a partner</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="whoExerciseWith" value=2>With a class</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="whoExerciseWith" value=3>Other</label>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label">*Where do you exercise:</label><br>
                <label class="radio col-sm-offset-2"><input type="radio" name="whereExercise" required checked value=0>Home</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="whereExercise" value=1>Gym</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="whereExercise" value=2>Other</label>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label">*Do you consider the Sit and Be Fit program host Mary Ann Wilson to be your exercise partner?:</label><br>
                <label class="radio col-sm-offset-2"><input type="radio" name="isMaryAnnPartner" required checked value=0>Yes</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="isMaryAnnPartner" value=1>No</label>
              </div>

            </div>
          </div>

          <div class="panel panel-primary">
            <div class="panel-heading">Health Questions</div>
            <div class="panel-body">

              <div class="form-group">
                <label class="control-label">*How would you have rated your overall health BEFORE starting the Sit and Be Fit program?:</label><br>
                <label class="radio col-sm-offset-2"><input type="radio" name="beforeHealthRating" required checked value=0>Excellent</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="beforeHealthRating" value=1>Very good</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="beforeHealthRating" value=2>Good</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="beforeHealthRating" value=3>Fair</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="beforeHealthRating" value=4>Poor</label>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label">*How would you rate your current overall health?:</label><br>
                <label class="radio col-sm-offset-2"><input type="radio" name="currentHealthRating" required checked value=0>Excellent</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="currentHealthRating" value=1>Very good</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="currentHealthRating" value=2>Good</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="currentHealthRating" value=3>Fair</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="currentHealthRating" value=4>Poor</label>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label">*Do you use an aid for walking? If so please select the aid usually used:</label><br>
                <label class="radio col-sm-offset-2"><input type="radio" name="walkingAid" required checked value=0>None</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="walkingAid" value=1>Wheel chair</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="walkingAid" value=2>Walker</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="walkingAid" value=3>Cane</label>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label">*How many times have you fallen in the last year?:</label><br>
                <label class="radio col-sm-offset-2"><input type="radio" name="howManyTimesFallen" required checked value=0>None</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="howManyTimesFallen" value=1>1 time</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="howManyTimesFallen" value=2>2 times</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="howManyTimesFallen" value=3>3 or more</label>
              </div> 
              <hr>
              <div class="form-group">
                <label class="control-label">*Do you have pains?:</label><br>
                <label class="radio col-sm-offset-2"><input type="radio" name="havePains" required checked value=0>Yes</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="havePains" value=1>No</label>              
              </div>          
              <hr>
              <div class="form-group">
                <label class="control-label">*Do you have trouble sleeping at night?:</label><br>
                <label class="radio col-sm-offset-2"><input type="radio" name="troubleSleeping" required checked value=0>Yes</label>
                <label class="radio col-sm-offset-2"><input type="radio" name="troubleSleeping" value=1>No</label>              
              </div>

            </div>
          </div>

          <div class="panel panel-primary">
            <div class="panel-heading">Health Problems</div>
            <div class="panel-body">

              <div class="form-group">
                <label class="control-label col-sm-8">*Hearing/Vision problems?</label>
                <label class="radio-inline"><input type="radio" name="hearing/vision-problems" required checked value=1>Yes
                </label>
                <label class="radio-inline"><input type="radio" name="hearing/vision-problems" value=0>No
                </label>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-8">*Heart/Vascular problems?</label>
                <label class="radio-inline"><input type="radio" name="heart/vascular-problems" required checked value=1>Yes
                </label>
                <label class="radio-inline"><input type="radio" name="heart/vascular-problems" value=0>No
                </label>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-8">*Lung problems?</label>
                <label class="radio-inline"><input type="radio" name="lung-problems" required checked value=1>Yes
                </label>
                <label class="radio-inline"><input type="radio" name="lung-problems" value=0>No
                </label>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-8">*Nervous system problems?</label>
                <label class="radio-inline"><input type="radio" name="nervous-system-problems" required checked value=1>Yes
                </label>
                <label class="radio-inline"><input type="radio" name="nervous-system-problems" value=0>No
                </label>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-8">*Hormone/Endoctrine problems?</label>
                <label class="radio-inline"><input type="radio" name="hormone/endoctrine-problems" required checked value=1>Yes
                </label>
                <label class="radio-inline"><input type="radio" name="hormone/endoctrine-problems" value=0>No
                </label>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-8">*Kidney/Bladder problems?</label>
                <label class="radio-inline"><input type="radio" name="kidney/bladder-problems" required checked value=1>Yes
                </label>
                <label class="radio-inline"><input type="radio" name="kidney/bladder-problems" value=0>No
                </label>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-8">*Cancer problems?</label>
                <label class="radio-inline"><input type="radio" name="cancer-problems" required checked value=1>Yes
                </label>
                <label class="radio-inline"><input type="radio" name="cancer-problems" value=0>No
                </label>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-8">*Digestive problems?</label>
                <label class="radio-inline"><input type="radio" name="digestive-problems" required checked value=1>Yes
                </label>
                <label class="radio-inline"><input type="radio" name="digestive-problems" value=0>No
                </label>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-8">*Muscle joints or bone problems?</label>
                <label class="radio-inline"><input type="radio" name="muscle/bone-problems" required checked value=1>Yes
                </label>
                <label class="radio-inline"><input type="radio" name="muscle/bone-problems" value=0>No
                </label>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-8">*Skin problems?</label>
                <label class="radio-inline"><input type="radio" name="skin-problems" required checked value=1>Yes
                </label>
                <label class="radio-inline"><input type="radio" name="skin-problems" value=0>No
                </label>
              </div>
              <hr>
              <div class="form-group">
                <label for="otherConditions" class="control-label col-sm-3">Other medical conditions</label>
                <div class="col-sm-9">
                  <textarea type="text" class="form-control" id="otherConditions" rows="3">
                  </textarea>
                </div>
              </div>

            </div> <!-- end panel-body -->
          </div> <!-- end panel "Health problems" -->

          <div class="panel panel-primary">
            <div class="panel-heading">Demographics</div>
            <div class="panel-body">

             <div class="form-group">
              <label for="age" class="control-label col-sm-4">*Age:</label>
              <div class="col-sm-offset-4">
                <input type="number" pattern="\d{1-3}" class="form-control" id="age" name="age" placeholder="your age"><br>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="col-sm-4">*Gender:</label>
              <div class="col-sm-offset-5">
                <label class="radio"><input type="radio" name="gender" required checked value="Male">Male</label>
                <label class="radio"><input type="radio" name="gender" value="Female">Female</label>
              </div>
            </div><br>
            <hr>
            <div class="form-group">
              <label class="col-sm-4">*Ethnicity:</label>
              <div class="col-sm-offset-5">
                <label class="radio"><input type="radio" name="ethnicity" required checked value="Asian">Asian</label>
                <label class="radio"><input type="radio" name="ethnicity" value="African American">African American</label>
                <label class="radio"><input type="radio" name="ethnicity" value="Caucasian">Caucasian</label>
                <label class="radio"><input type="radio" name="ethnicity" value="Hispanic">Hispanic</label>
                <label class="radio"><input type="radio" name="ethnicity" value="Native American">Native American</label>              
              </div> 
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-4" for="education">*Highest level of Education:</label>
              <div class="col-sm-offset-4">
                <input type="text" class="form-control" id="education" name="education">
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="col-sm-5">*Current Working Status:</label>
              <div class="col-sm-offset-5">
                <label class="radio"><input type="radio" name="workingStatus" required checked value="Employed">Employed</label>
                <label class="radio"><input type="radio" name="workingStatus" value="Unemployed">Unemployed</label>
                <label class="radio"><input type="radio" name="workingStatus" value="Retired">Retired</label>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label for="householdNumber" class="control-label col-sm-4">*Number of members in your household:</label>
              <div class="col-sm-8">
                <input type="number" pattern="\d{1-2}" class="form-control" name="householdNumber" placeholder="household number"><br>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label for="annualIncome" class="control-label col-sm-4">*Annual Income:</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="annualIncome" placeholder="income per year"><br>
              </div>
            </div>

          </div> <!-- end panel-body -->
        </div> <!-- end panel "demographics" -->
        <input class="col-sm-offset-10 col-sm-2 btn-primary" type="submit" id="submitQuestionnaireP1">
      </form>

    </div> <!-- end offset centered -->
  </div> <!-- end container -->

 <?php if(isset($return) && !empty($return)){?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
    $(document).ready(function (){
      $("#message").html('<?= $return;?>');
      $("#message").show();
    });
    </script>
    <?php } ?>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
