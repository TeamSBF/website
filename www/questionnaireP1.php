<?php

    if (isset($_POST['submitQuestionnaireP1']))
    {
      if ($user)
      {
        $_POST['userID'] = $user->id;
        print_r($_POST);
        $qp1validator = new FormsModel($_POST);
        $q1return = $qp1validator->validateQuestionnaireP1();
        echo $q1return;
      }      
    }
?>

      <div class="container">
        <div class="background"><fieldset>
          <legend><strong><h1>Pre-Study Questionnaire Part 1</h1></strong></legend>

          <form method="post">
           <div>
            <div>
              <div id="q1message" style="display:none"></div>
              <div>
                  <div><label>How often do you perform the Sit and Be Fit exercises?</label><br></div>
                  <div class="input"><input type="radio" name="q1" required checked value=0>Less than once a month</div>
                  <div class="input"><input type="radio" name="q1" value=1>Once per month</div>
                  <div class="input"><input type="radio" name="q1" value=2>Once per week</div>
                  <div class="input"><input type="radio" name="q1" value=3>More than once per week</div>
              </div>
              
              <div>
                  <div><label>How long have you participated in the Sit and Be Fit program?</label></div>
                  <div class="input"><input type="radio" name="q2" required checked value=0>Less than 3 months</div>
                  <div class="input"><input type="radio" name="q2" value=1>3 to 6 months</div>
                  <div class="input"><input type="radio" name="q2" value=2>6 to 12 months</div>
                  <div class="input"><input type="radio" name="q2" value=3>More than 12 months</div>
              </div>
              
              <div>
                  <div><label>You exercise:</label>
                  <div class="input"><input type="radio" name="q3" required checked value=0>By yourself</div>
                  <div class="input"><input type="radio" name="q3" value=1>With a partner</div>
                  <div class="input"><input type="radio" name="q3" value=2>With a class</div>
                  <div class="input"><input type="radio" name="q3" value=3>Other</div>
              </div>
              
              <div>
                  <div><label>Where do you exercise:</label></div>
                  <div class="input"><input type="radio" name="q4" required checked value=0>Home</div>
                  <div class="input"><input type="radio" name="q4" value=1>Gym</div>
                  <div class="input"><input type="radio" name="q4" value=2>Other</div>
              </div>
              
              <div>
                  <div><label>Do you consider the Sit and Be Fit program host Mary Ann Wilson to be your exercise partner?:</label></div>
                  <div class="input"><input type="radio" name="q5" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q5" value=0>No</div>
              </div>

            </div>
          </div>

          <div>
              <hr><div><h2>Health Questions</h2></div><hr>
            <div>

              <div>
                  <div><label>How would you have rated your overall health BEFORE starting the Sit and Be Fit program?:</label></div>
                  <div class="input"><input type="radio" name="q6" required checked value=0>Excellent</div>
                  <div class="input"><input type="radio" name="q6" value=1>Very good</div>
                  <div class="input"><input type="radio" name="q6" value=2>Good</div>
                  <div class="input"><input type="radio" name="q6" value=3>Fair</div>
                  <div class="input"><input type="radio" name="q6" value=4>Poor</div>
              </div>
              
              <div>
                  <div><label>How would you rate your current overall health?:</label></div>
                  <div class="input"><input type="radio" name="q7" required checked value=0>Excellent</div>
                  <div class="input"><input type="radio" name="q7" value=1>Very good</div>
                  <div class="input"><input type="radio" name="q7" value=2>Good</div>
                  <div class="input"><input type="radio" name="q7" value=3>Fair</div>
                  <div class="input"><input type="radio" name="q7" value=4>Poor</div>
              </div>
              
              <div>
                  <div><label>Do you use an aid for walking? If so please select the aid usually used:</label></div>
                  <div class="input"><input type="radio" name="q8" required checked value=0>None</div>
                  <div class="input"><input type="radio" name="q8" value=1>Wheel chair</div>
                  <div class="input"><input type="radio" name="q8" value=2>Walker</div>
                  <div class="input"><input type="radio" name="q8" value=3>Cane</div>
              </div>
              
              <div>
                  <div><label>How many times have you fallen in the last year?:</label></div>
                  <div class="input"><input type="radio" name="q9" required checked value=0>None</div>
                  <div class="input"><input type="radio" name="q9" value=1>1 time</div>
                  <div class="input"><input type="radio" name="q9" value=2>2 times</div>
                  <div class="input"><input type="radio" name="q9" value=3>3 or more</div>
              </div> 
              
              <div>
                  <div><label>Do you have pains?:</label></div>
                  <div class="input"><input type="radio" name="q10" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q10" value=0>No</div>
              </div>          
              
              <div>
                  <div><label>Do you have trouble sleeping at night?:</label></div>
                  <div class="input"><input type="radio" name="q11" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q11" value=0>No</div>
              </div>

            </div>
          </div>

          <div>
              <hr><div><h2>Health Problems</h2></div><hr>
            <div>

              <div>
                  <div><label>Hearing/Vision problems?</label></div>
                  <div class="input"><input type="radio" name="q12" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q12" value=0>No</div>
              </div>

              <div>
                  <div><label>Heart/Vascular problems?</label></div>
                  <div class="input"><input type="radio" name="q13" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q13" value=0>No</div>
              </div>

              <div>
                  <div><label>Lung problems?</label></div>
                  <div class="input"><input type="radio" name="q14" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q14" value=0>No</div>
              </div>

              <div>
                  <div> <label>Nervous system problems?</label></div>
                  <div class="input"><input type="radio" name="q15" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q15" value=0>No</div>
              </div>

              <div>
                  <div><label>Hormone/Endoctrine problems?</label></div>
                  <div class="input"><input type="radio" name="q16" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q16" value=0>No</div>
              </div>

              <div>
                  <div> <label>Kidney/Bladder problems?</label></div>
                  <div class="input"><input type="radio" name="q17" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q17" value=0>No</div>
              </div>

              <div>
                  <div><label>Cancer problems?</label></div>
                  <div class="input"><input type="radio" name="q18" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q18" value=0>No</div>
              </div>

              <div>
                  <div><label>Digestive problems?</label></div>
                  <div class="input"><input type="radio" name="q19" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q19" value=0>No</div>
              </div>

              <div>
                  <div><label>Muscle joints or bone problems?</label></div>
                  <div class="input"><input type="radio" name="q20" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q20" value=0>No</div>
              </div>

              <div>
                  <div><label>Skin problems?</label></div>
                  <div class="input"><input type="radio" name="q21" required checked value=1>Yes</div>
                  <div class="input"><input type="radio" name="q21" value=0>No</div>
              </div>
              <div>
                  <div><label for="otherConditions" class="control-label col-sm-3">Other medical conditions</label></div>
                <div class="col-sm-9">
                    <div class="input"><textarea type="text" class="form-control" name="q22" rows="3"></textarea></div>
                </div>
              </div>

            </div> <!-- end panel-body -->
          </div> <!-- end panel "Health problems" -->

          <div>
              <hr><div><h2>Demographics</h2></div><hr>
            <div>

             <div>
                 <div><label for="age" class="control-label col-sm-4">Age:</label></div>
              <div class="col-sm-offset-4">
                  <div class="input"><input type="number" pattern="\d{1-3}" class="form-control" name="q23" placeholder="your age"></div>
              </div>
            </div>
            
            <div>
                <div><label class="col-sm-4">Gender:</label></div>
              <div class="col-sm-offset-5">
                  <div class="input"><input type="radio" name="q24" required checked value=1>Male</div>
                  <div class="input"><input type="radio" name="q24" value=0>Female</div>
              </div>
            </div><br>
            
            <div>
                <div><label class="col-sm-4">Ethnicity:</label></div>
              <div class="col-sm-offset-5">
                  <div class="input"><input type="radio" name="q25" required checked value=0>Asian</div>
                  <div class="input"><input type="radio" name="q25" value=1>African American</div>
                  <div class="input"><input type="radio" name="q25" value=2>Caucasian</div>
                  <div class="input"><input type="radio" name="q25" value=3>Hispanic</div>
                  <div class="input"><input type="radio" name="q25" value=4>Native American</div>
              </div> 
            </div>
            
            <div>
                <div><label class="control-label col-sm-4" for="education">Highest level of Education:</label></div>
              <div class="col-sm-offset-4">
                  <div class="input"><input type="text" class="form-control" name="q26"></div>
              </div>
            </div>
            
            <div>
                <div><label class="col-sm-5">Current Working Status:</label></div>
              <div class="col-sm-offset-5">
                  <div class="input"><input type="radio" name="q27" required checked value=0>Employed</div>
                  <div class="input"><input type="radio" name="q27" value=1>Unemployed</div>
                  <div class="input"><input type="radio" name="q27" value=2>Retired</div>
              </div>
            </div>
        
            <div>
                <div><label for="householdNumber" class="control-label col-sm-4">Number of members in your household:</label></div>
              <div class="col-sm-8">
                  <div class="input"><input type="number" pattern="\d{1-2}" class="form-control" name="q28" placeholder="household number"></div>
              </div>
            </div>
            
            <div>
                <div><label for="q29" class="control-label col-sm-4">Annual Income:</label></div>
              <div class="col-sm-8">
                  <div class="input"><input type="number" class="form-control" name="q29" placeholder="income per year"></div>
              </div>
            </div>

          </div> 
        </div> <!-- end panel "demographics" -->
               <div class="inputs"><button type="submit" name="submitQuestionnaireP1">Submit</button></div>
        </div>
      </form>

            </fieldset> <!-- end offset centered -->
  </div> <!-- end container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 
    <script>
    <?php   if(isset($q1return)) { ?>
    
    // display message upon success  or error
    $(document).ready(function () { 
      var message;
      <?php if ($q1return == false) { ?>
        message = "<strong>Error!</strong> Something went wrong while saving the form data.";
        $("#q1message").removeClass("success").addClass("error");
        $("#q1message").html(message);
        $("#q1message").show();         
        <?php   }
        else if ($q1return === "sucess") { ?>
          message = "<strong>Success!</strong?> Form submitted!";         
          $("#q1message").removeClass("error").addClass("success");
          $("#q1message").html(message);
          $("#q1message").show();         
          <?php } ?>
        }); 
  <?php } ?>
  </script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
