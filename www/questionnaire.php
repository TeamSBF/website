<?php

if (isset($_POST['submitQuestionnaire']))
{
    $_POST['userID'] = $user->id;
    $qp1validator = new FormsModel($_POST);
    $q1return = $qp1validator->validateQuestionnaire();
}

if($questionnaire = FormsModel::isQuestionnaireComplete($user->id))
{
    $select = QueryFactory::Build("select");
    $grab = [];
    for($i = 0; $i < 64; $i++)
    {
        $grab[] = "q".($i+1);
    }
    $select->Select($grab)->From('questionnaire_form')->Where(['userID','=',$user->id])->Limit();
    $select = DatabaseManager::Query($select);
    $result = $select->Result();
    foreach(array_keys($result) as $key)
    {
        $_POST[$key] = $result[$key];
    }
}
?>


<div class="background">
  <strong><h1>Pre-Study Questionnaire Part 1</h1></strong>
  <fieldset>
    <form method="post">
      <div>
        <div id="questionnaireMessage" style="display:none"></div>
        <?php
        $questions = array("How often do you perform the Sit and Be Fit exercises?:", "How long have you participated in the Sit and Be Fit program?:",
          "You exercise:", "Where do you exercise:", "Do you consider the Sit and Be Fit program host Mary Ann Wilson to be your exercise partner?:");
        $options = array( array("Less than once a month", "Once per month", "Once per week", "More than once per week"),
          array("Less than 3 months", "3 to 6 months", "6 to 12 months", "More than 12 months"),
          array("By yourself", "With a partner", "With a class", "Other"),
          array("Home", "Gym", "Other"),
          array("No", "Yes"));

        for ($i = 1; $i <= count($questions); $i++)
        {
          echo '<div><div><label>' . $questions[$i-1] . '</label><br></div>';
          for ($j = 0; $j < count($options[$i-1]); $j++)
          {
            echo '<div class="input"><input type="radio" name="q'.$i.'" required '. ((isset($_POST["q$i"]) && $_POST["q$i"] == $j)? "checked":"") .' checked value='.$j.'>' . $options[$i-1][$j] . '</div>';
          }
          echo '</div>';
        }
        ?>
      </div>

      <div>
        <hr><div><h2>Health Questions</h2></div><hr>
        <div>
          <?php
          $questions = array( "How would you have rated your overall health BEFORE starting the Sit and Be Fit program?:",
            "How would you rate your current overall health?:", "Do you use an aid for walking? If so please select the aid usually used:",
            "How many times have you fallen in the last year?:", "Do you have pains?:", "Do you have trouble sleeping at night?:");
          $options = array( array("Excellent", "Very good", "Good", "Fair", "Poor"),
            array("Excellent", "Very good", "Good", "Fair", "Poor"),
            array("None", "Wheel Chair", "Walker", "Cane"),
            array("None", "1 time", "2 times", "3 or more"),
            array("No", "Yes"),
            array("No", "Yes"));

          for ($x = $i; $x < count($questions)+$i; $x++)
          {
            echo '<div><div><label>' . $questions[$x-$i] . '</label><br></div>';
            for ($j = 0; $j < count($options[$x-$i]); $j++)
            {
              echo '<div class="input"><input type="radio" name="q'.$x.'" required '. ((isset($_POST["q$x"]) && $_POST["q$x"] == $j)? "checked":"") .' checked value='.$j.'>' . $options[$x-$i][$j] . '</div>';
            }
            echo '</div>';
          }                
          ?>
        </div>
      </div>

      <div>
        <hr><div><h2>Health Problems</h2></div><hr>
        <div>
          <?php
          $questions = array( "Hearing/Vision problems?", "Heart/Vascular problems?", "Lung problems?", "Nervous system problems?",
            "Hormone/Endoctrine problems?", "Kidney/Bladder problems?", "Cancer problems?", "Digestive problems?",
            "Muscle joints or bone problems?", "Skin problems?");

          for ($k = $x; $k < count($questions)+$x; $k++)
          {
            echo '<div><div><label>' . $questions[$k-$x] . '</label></div>';                   
            echo '<div class="input"><input type="radio" name="q'.$k.'" required '. ((isset($_POST["q$k"]) && $_POST["q$k"] == 0)? "checked":"") .' checked value=0>No</div>';
            echo '<div class="input"><input type="radio" name="q'.$k.'" required '. ((isset($_POST["q$k"]) && $_POST["q$k"] == 1)? "checked":"") .' checked value=1>Yes</div>';
            echo '</div>';
          }                
          ?>
          <div>
            <div><label for="otherConditions">Other medical conditions:</label></div>
            <div class="input"><textarea type="text" name="q22" rows="3"></textarea></div>
          </div>
        </div>
      </div>

      <div>
        <hr><div><h2>Demographics</h2></div><hr>
        <div>
          <div>
           <div><label for="age">Age:</label></div>
           <div>
            <div class="input"><input type="number" pattern="\d{1-3}" name="q23" placeholder="your age"></div>
          </div>
        </div>

        <div>
          <div><label>Gender:</label></div>
          <div>
            <div class="input"><input type="radio" name="q24" required <?php ((isset($_POST["q24"]) && $_POST["q24"] == 0)? "checked":"") ?> checked  value=0>Female</div>
            <div class="input"><input type="radio" name="q24" <?php ((isset($_POST["q24"]) && $_POST["q24"] == 1)? "checked":"") ?> checked  value=1>Male</div>
          </div>
        </div><br>

        <div>
          <div><label class="col-sm-4">Ethnicity:</label></div>
          <div class="col-sm-offset-5">
            <div class="input"><input type="radio" name="q25" required <?php ((isset($_POST["q$i"]) && $_POST["q$i"] == $j)? "checked":"") ?> checked  value=0>Asian</div>
            <div class="input"><input type="radio" name="q25" value=1>African American</div>
            <div class="input"><input type="radio" name="q25" value=2>Caucasian</div>
            <div class="input"><input type="radio" name="q25" value=3>Hispanic</div>
            <div class="input"><input type="radio" name="q25" value=4>Native American</div>
          </div> 
        </div>

        <div>
          <div><label for="education">Highest level of Education:</label></div>
          <div>
            <div class="input"><input type="text" name="q26"></div>
          </div>
        </div>

        <div>
          <div><label>Current Working Status:</label></div>
          <div>
            <div class="input"><input type="radio" name="q27" required checked value=0>Employed</div>
            <div class="input"><input type="radio" name="q27" value=1>Unemployed</div>
            <div class="input"><input type="radio" name="q27" value=2>Retired</div>
          </div>
        </div>

        <div>
          <div><label for="householdNumber">Number of members in your household:</label></div>
          <div>
            <div class="input"><input type="number" pattern="\d{1-2}" name="q28" placeholder="household number"></div>
          </div>
        </div>

        <div>
          <div><label for="q29">Annual Income:</label></div>
          <div>
            <div class="input"><input type="number" name="q29" placeholder="income per year"></div>
          </div>
        </div>

        <!-- ****************************************************************************************** -->

        <div>
          <div><label for="q30">Current Height (in inches): </label></div>
          <div class="input"><input type="number" name="q30" placeholder="Your height"></div>
        </div>  

        <div>
          <div><label for="q31">Current Weight (in pounds): </label></div>
          <div class="input"><input type="number" name="q31" placeholder="Your weight"></div>
        </div>

        <div>
          <div><label for="q32">Describe how the Sit and Be Fit exercise program has affected the listed medical conditions in part 1</label></div>
          <div class="input"><textarea type="text" name="q32"></textarea></div>
        </div>


        <hr><label><strong><h2>Please rate your ability to perform certain activities that might occur during a typical day</h2></strong></label><hr>

        <?php
        $question1 = array("Lifting or carrying groceries:", "Climbing one flight of stairs:", "Stepping up and down a small curb:", "Picking up small object from the floor:",
          "Walking a mile or more:", "Walking 2-3 blocks:", "Walking around in your home:", "Bathing or dressing yourself:", "Getting in and out of a car:", "Writing on a computer Keyboard:",
          "Preparing meals:", "Cleaning your home:");

        for ($i = 33; $i < count($question1)+33; $i++)
        {
          echo '<div>';
          echo '<div><label>'.$question1[$i-33].'</label></div>';
          echo '<div class="input"><input type="radio" name="q'. ($i) .'"' . ((isset($_POST["q$i"]) && $_POST["q$i"] == 0)? "checked":"") .' checked  required value=0>No help</div>';
          echo '<div class="input"><input type="radio" name="q'. ($i) .'"' . ((isset($_POST["q$i"]) && $_POST["q$i"] == 1)? "checked":"") .' value=1>Some help</div>';
          echo '<div class="input"><input type="radio" name="q'. ($i) .'"' . ((isset($_POST["q$i"]) && $_POST["q$i"] == 2)? "checked":"") .' value=2>Unable to perform</div>';
          echo '</div>';
        }
        ?>
        <div>
          <div><label for="affectActivities">Describe how the Sit and Be Fit exercise program affects your ability to perform the activities listed above?:</label></div>                
          <div class="input"><textarea type="text" name="q45"></textarea></div>
        </div>
        <!-- end panel "More About Yourself" -->

        <hr><label><strong><h2>The following questions are about your feelings. For each question, please choose the one answer that comes closest to the way you felt BEFORE ever doing the Sit and Be Fit exercise program.</h2></strong></label><hr>

        <label>How much of the time did you...</label>
        <?php
        $question2 = array("Feel full of life?:", "Feel nervous?:", "Feel that you are playing a useful part in things?:", "Feel calm and peaceful?:", "Have a lot of energy?:",
          "Feel depressed?:", "Feel worn out?:", "Feel happy?:", "Feel satisfied with your life?:");
        $i++;
        for ($j = $i; $j < count($question2)+$i; $j++)
        {
          echo '<div>';
          echo '<div><label>'.$question2[$j - $i].'</label></div>';
          echo '<div class="input"><input type="radio" name="q'. ($j) .'"' . ((isset($_POST["q$j"]) && $_POST["q$j"] == 0)? "checked":"") .' checked  required value=0>Always</div>';
          echo '<div class="input"><input type="radio" name="q'. ($j) .'"' . ((isset($_POST["q$j"]) && $_POST["q$j"] == 1)? "checked":"") .' value=1>Mostly</div>';
          echo '<div class="input"><input type="radio" name="q'. ($j) .'"' . ((isset($_POST["q$j"]) && $_POST["q$j"] == 2)? "checked":"") .' value=2>Half the time</div>';
          echo '<div class="input"><input type="radio" name="q'. ($j) .'"' . ((isset($_POST["q$j"]) && $_POST["q$j"] == 3)? "checked":"") .' value=3>Rarely</div>';
          echo '</div>';
        }
        ?>  

        <hr><label><strong><h2>The following questions are about how you feel currently.</h2></strong></label><hr>

        <label>How much of the time did you...</label>
        <?php

        for ($k = $j; $k < count($question2)+$j; $k++)
        {
          echo '<div>';
          echo '<div><label>'.$question2[$k - $j].'</label></div>';
          echo '<div class="input"><input type="radio" name="q'. ($k) .'"' . ((isset($_POST["q$k"]) && $_POST["q$k"] == 0)? "checked":"") .' checked  required value=0>Always</div>';
          echo '<div class="input"><input type="radio" name="q'. ($k) .'"' . ((isset($_POST["q$k"]) && $_POST["q$k"] == 1)? "checked":"") .' value=1>Mostly</div>';
          echo '<div class="input"><input type="radio" name="q'. ($k) .'"' . ((isset($_POST["q$k"]) && $_POST["q$k"] == 2)? "checked":"") .' value=2>Half the time</div>';
          echo '<div class="input"><input type="radio" name="q'. ($k) .'"' . ((isset($_POST["q$k"]) && $_POST["q$k"] == 3)? "checked":"") .' value=3>Rarely</div>';
          echo '</div>';
        }
        ?>  

        <div>
          <div><label for="q64">How are the feelings that are listed above affected when you participate in a Sit and Be Fit exercise class?:</label></div>                    
          <div><textarea type="text" name="q64"></textarea></div>
        </div>


        <div class="inputs"><button type="submit" id="submitQuestionnaire" name="submitQuestionnaire">Submit</button></div>

      </form>
    </fieldset>
  </div>

  <script>
  <?php   if(isset($q1return)) { ?>

    // display message upon success  or error
    $(document).ready(function () { 
      var message;
      <?php if ($q1return == false) { ?>
        message = "<strong>Error!</strong> Something went wrong while saving the form data.";
        $("#questionnaireMessage").removeClass("success").addClass("error");
        $("#questionnaireMessage").html(message);
        $("#questionnaireMessage").show();         
        <?php   }
        else if ($q1return === "sucess") { ?>
          message = "<strong>Success!</strong?> Form submitted!";         
          $("#questionnaireMessage").removeClass("error").addClass("success");
          $("#questionnaireMessage").html(message);
          $("#questionnaireMessage").show();         
          <?php } ?>
        }); 
    <?php } ?>
    </script>

