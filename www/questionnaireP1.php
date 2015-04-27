<?php
    require_once"header.php";

    if (isset($_POST['submitQuestionnaireP1']))
    {
      $validator = new FormsModel($_POST);
      $return = $validator->ValidateQuestionnaireP1();
    }
    //$radio = new MakeRadio();
?>

      <div class="background">
        <fieldset>
          <legend><strong>Pre-Study Questionnaire Part 1<br></strong></legend>

          <form class="form-vertical" method="post">

           <fieldset>
            <div class="panel-heading">You and Sit and Be Fit</div>
            <div class="panel-body">
              <div class="alert" id="message" style="diplay:none"></div>
              <div>
                <label>*How often do you perform the Sit and Be Fit exercises?</label><br>
                <div><input type="radio" name="howOftenPerform" required checked value=0>Less than once a month</div>
                <div><input type="radio" name="howOftenPerform" value=1>Once per month</div>
                <div><input type="radio" name="howOftenPerform" value=2>Once per week</div>
                <div><input type="radio" name="howOftenPerform" value=3>More than once per week</div>
              </div>
              <hr>
              <div>
                <label>*How long have you participated in the Sit and Be Fit program?</label><br>
                <div><input type="radio" name="howLongParticipate" required checked value=0>Less than 3 months</div>
                <div><input type="radio" name="howLongParticipate" value=1>3 to 6 months</div>
                <div><input type="radio" name="howLongParticipate" value=2>6 to 12 months</div>
                <div><input type="radio" name="howLongParticipate" value=3>More than 12 months</div>
              </div>
              <hr>
              <div>
                <label>*You exercise:</label><br>
                <div><input type="radio" name="whoExerciseWith" required checked value=0>By yourself</label>
                <div><input type="radio" name="whoExerciseWith" value=1>With a partner</label>
                <div><input type="radio" name="whoExerciseWith" value=2>With a class</label>
                <div><input type="radio" name="whoExerciseWith" value=3>Other</label>
              </div>
              <hr>
              <div>
                <label>*Where do you exercise:</label><br>
                <div><input type="radio" name="whereExercise" required checked value=0>Home</div>
                <div><input type="radio" name="whereExercise" value=1>Gym</div>
                <div><input type="radio" name="whereExercise" value=2>Other</div>
              </div>
              <hr>
              <div>
                <label>*Do you consider the Sit and Be Fit program host Mary Ann Wilson to be your exercise partner?:</label><br>
                <div><input type="radio" name="isMaryAnnPartner" required checked value=0>Yes</div>
                <div><input type="radio" name="isMaryAnnPartner" value=1>No</div>
              </div>

            </div>
          </fieldset><br><br>

          <fieldset>
              <div>
                <label>*How would you have rated your overall health BEFORE starting the Sit and Be Fit program?:</label><br>
                <div><input type="radio" name="beforeHealthRating" required checked value=0>Excellent</label>
                <div><input type="radio" name="beforeHealthRating" value=1>Very good</div>
                <div><input type="radio" name="beforeHealthRating" value=2>Good</div>
                <div><input type="radio" name="beforeHealthRating" value=3>Fair</div>
                <div><input type="radio" name="beforeHealthRating" value=4>Poor</div>
              </div>
              <hr>
              <div>
                <label>*How would you rate your current overall health?:</label><br>
                <div><input type="radio" name="currentHealthRating" required checked value=0>Excellent</div>
                <div><input type="radio" name="currentHealthRating" value=1>Very good</div>
                <div><input type="radio" name="currentHealthRating" value=2>Good</div>
                <div><input type="radio" name="currentHealthRating" value=3>Fair</div>
                <div><input type="radio" name="currentHealthRating" value=4>Poor</div>
              </div>
              <hr>
              <div>
                <label>*Do you use an aid for walking? If so please select the aid usually used:</label><br>
                <div><input type="radio" name="walkingAid" required checked value=0>None</div>
                <div><input type="radio" name="walkingAid" value=1>Wheel chair</div>
                <div><input type="radio" name="walkingAid" value=2>Walker</div>
                <div><input type="radio" name="walkingAid" value=3>Cane</div>
              </div>
              <hr>
              <div>
                <label>*How many times have you fallen in the last year?:</label><br>
                <div><input type="radio" name="howManyTimesFallen" required checked value=0>None</div>
                <div><input type="radio" name="howManyTimesFallen" value=1>1 time</div>
                <div><input type="radio" name="howManyTimesFallen" value=2>2 times</div>
                <div><input type="radio" name="howManyTimesFallen" value=3>3 or more</div>
              </div> 
              <hr>
              <div>
                <label>*Do you have pains?:</label><br>
                <div><input type="radio" name="havePains" required checked value=0>Yes</div>
                <div><input type="radio" name="havePains" value=1>No</div>              
              </div>          
              <hr>
              <div>
                <label>*Do you have trouble sleeping at night?:</label><br>
                <div><input type="radio" name="troubleSleeping" required checked value=0>Yes</div>
                <div><input type="radio" name="troubleSleeping" value=1>No</div>              
              </div>
          </fieldset><br><br>

          <fieldset>
              <div>
                <label>*Hearing/Vision problems?</label>
                <div><input type="radio" name="hearing/vision-problems" required checked value=1>Yes</div>
                <div><input type="radio" name="hearing/vision-problems" value=0>No</div>
              </div>

              <div>
                <label>*Heart/Vascular problems?</label>
                <div><input type="radio" name="heart/vascular-problems" required checked value=1>Yes</div>
                <div><input type="radio" name="heart/vascular-problems" value=0>No</div>
              </div>

              <div>
                <label>*Lung problems?</label>
                <div><input type="radio" name="lung-problems" required checked value=1>Yes</div>
                <div><input type="radio" name="lung-problems" value=0>No</div>
              </div>

              <div>
                <label>*Nervous system problems?</label>
                <div><input type="radio" name="nervous-system-problems" required checked value=1>Yes</div>
                <div><input type="radio" name="nervous-system-problems" value=0>No</div>
              </div>

              <div>
                <label>*Hormone/Endoctrine problems?</label>
                <div><input type="radio" name="hormone/endoctrine-problems" required checked value=1>Yes</div>
                <div><input type="radio" name="hormone/endoctrine-problems" value=0>No</div>
              </div>

              <div>
                <label>*Kidney/Bladder problems?</label>
                <div><input type="radio" name="kidney/bladder-problems" required checked value=1>Yes</div>
                <div><input type="radio" name="kidney/bladder-problems" value=0>No</div>
              </div>

              <div>
                <label>*Cancer problems?</label>
                <div><input type="radio" name="cancer-problems" required checked value=1>Yes</div>
                <div><input type="radio" name="cancer-problems" value=0>No</div>
              </div>

              <div>
                <label>*Digestive problems?</label>
                <div><input type="radio" name="digestive-problems" required checked value=1>Yes</div>
                <div><input type="radio" name="digestive-problems" value=0>No</div>
              </div>

              <div>
                <label>*Muscle joints or bone problems?</label>
                <div><input type="radio" name="muscle/bone-problems" required checked value=1>Yes</div>
                <div><input type="radio" name="muscle/bone-problems" value=0>No</div>
              </div>

              <div>
                <label>*Skin problems?</label>
                <div><input type="radio" name="skin-problems" required checked value=1>Yes</div>
                <div><input type="radio" name="skin-problems" value=0>No</div>
              </div>
              <hr>
              <div>
                <label for="otherConditions">Other medical conditions</label>
                  <textarea type="text" name="otherConditions" rows="3"></textarea>
              </div>
          </fieldset><br><br> <!-- end panel "Health problems" -->

          <fieldset>
             <div>
              <label for="age">*Age:</label>
                <input type="number" pattern="\d{1-3}" name="age" placeholder="your age"><br>
            </div>
            <hr>
            <div>
              <label>*Gender:</label>
                <div><input type="radio" name="gender" required checked value="Male">Male</div>
                <div><input type="radio" name="gender" value="Female">Female</div>
            </div><br>
            <hr>
            <div>
              <label>*Ethnicity:</label>
                <div><input type="radio" name="ethnicity" required checked value="Asian">Asian</div>
                <div><input type="radio" name="ethnicity" value="African American">African American</div>
                <div><input type="radio" name="ethnicity" value="Caucasian">Caucasian</div>
                <div><input type="radio" name="ethnicity" value="Hispanic">Hispanic</div>
                <div><input type="radio" name="ethnicity" value="Native American">Native American</div>              
            </div>
            <hr>
            <div>
              <label for="education">*Highest level of Education:</label>
                <input type="text" name="education">
            </div>
            <hr>
            <div>
              <label>*Current Working Status:</label>
                <div><input type="radio" name="workingStatus" required checked value="Employed">Employed</div>
                <div><input type="radio" name="workingStatus" value="Unemployed">Unemployed</div>
                <div><input type="radio" name="workingStatus" value="Retired">Retired</div>
            </div>
            <hr>
            <div>
              <label for="householdNumber">*Number of members in your household:</label>
                <input type="number" pattern="\d{1-2}" name="householdNumber" placeholder="household number"><br>
              </div>
            <hr>
            <div>
              <label for="annualIncome">*Annual Income:</label>
                <input type="number" name="annualIncome" placeholder="income per year"><br>
            </div>
        </fieldset><br><br> <!-- end panel "demographics" -->
        <input class="btn-primary" type="submit" name="submitQ1">
      </form>

    </fieldset><br><br> <!-- end offset centered -->
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
<?php require_once"footer.php";?>