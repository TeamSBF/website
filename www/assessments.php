<?php require_once"header.php";
if (isset($_POST['submitAssessments']))
    {
        $_POST['userID'] = $user->id;
        $assessmentValidator = new assessment($_POST);
        $assessmentReturn = $assessmentValidator->validateAssessments();
        if($assessmentReturn =="SUCCESS")?>
            <script>alert("Assessment Selection Completed.");</script><?php           
    } 
if (isset($_POST['submitData']))
{
    $_POST['userID'] = $user->id;
    unset($_POST['submitData']);
    printr($_POST);
    $assessmentValidator = new assessment($_POST);
    $assessmentReturn = $assessmentValidator->validateAssessmentData();
   // $assessmentReturn="SUCCESS";
    if($assessmentReturn =="SUCCESS")
        $assessmentReturn = "Assessment submitted successfully.";
    
    
}
$array = ["Chairstand" =>["30 Second Chair Stand","Lower body strength evaluation. Assess strength for climbing stairs, walking, and getting out of a chair, car, or tub. Number of full stands that can be completed in 30 seconds with arms folded across chest. If the arms are pulled away from the chest or you rock back and forward to help you stand that is unacceptable and the test will be stopped at that point. You may rest while siting on the chair and continue if you are still within the 30 seconds.","ChairStand","m0APvLqZr5E"],
              "ArmCurl"=>["Arm Curl","Assess upper body strength, needed for performing household and other activities involving lifting and carrying things such as groceries, suitcases and grandchildren. Number of bicep curls – lifting the weight from the arm extended up to the shoulder and back down – that can be completed in 30 seconds holding a 5 lb weight (for women) or an 8 lb weight (for men). You may not use the back to help “throw” the weight up. The weight must come up and touch the shoulder and the return to the lowered position should be with control, not just dropping the arm. You may rest in the down position and continue with lifts if you are still within the 30 seconds.","ArmCurl","m0APvLqZr5E" ],
             "StepTest"=>["2-Minute Step Test","Aerobic endurance test. Number of full steps completed in 2 minutes, raising the knee to a point halfway between the kneecap and the hip on each step. If the knee does not come up high enough you will be reminded to lift it higher. If you are testing yourself at home stand in front of a mirror so you can assess the knee height.","Steptest","m0APvLqZr5E" ],
             "FootUpAndGo"=>["8 Foot Up and Go","Assess agility and dynamic balance needed for quick maneuvering such as getting on or off a bus, getting up to attend to something in the kitchen, going to the bathroom, or getting up to answer the phone. Number of seconds it takes to get up out of a chair, walk 8 feet, turn around a cone, and return to the chair and sit down. The entire movement must be in control. You may use your hands to help get up from the chair and to sit back down.","FootUpandGo","m0APvLqZr5E"],
             "unilateralbalancetest"=>["Unilateral Balance Test","Fall risk evaluation.  Balance test determined by how long you can stand on one foot without moving, or touching the lifted foot back to the ground.  The lifted leg may not be braced against the support leg, lift the lower leg up and to the rear till the knee is at 90 degrees. Not acceptable is excessive movement of arms or body to hold position","Unilateral","m0APvLqZr5E"],
            "FunctionalReach"=>["Functional Reach","Assess balance in a forward motion. Reach as far forward as you can keep your arm parallel to the yardstick without touching the wall or taking a step forward. Do not overreach and risk falling.","Functional","m0APvLqZr5E"] 
         ];?>
<div class="background">
<!-- Accordion -->
    
<?php
$find = QueryFactory::Build('select');
$find->Select("Chairstand","ArmCurl","StepTest","FootUpAndGo","leftunilateralbalancetest","rightunilateralbalancetest","FunctionalReach")->From('assessments')->Where(['userID', '=', $user->id,"AND"],['DateCompleted','=',0]);
$find->Limit();
$res = DatabaseManager::Query($find);
$result=$res->Result();
$left = $result["leftunilateralbalancetest"];
$right =$result["rightunilateralbalancetest"];
$result["unilateralbalancetest"]=[$left,$right];
unset($result["leftunilateralbalancetest"],$result["rightunilateralbalancetest"]);
?>


    <h1 class="demoHeaders">Assessments</h1>
    <form method="post">
        <?php
            if(!empty($assessmentReturn))
            {?>
               <div><?=$assessmentReturn;?> </div>
            <?php }
        ?>
        <div id="accordion">
        
        <?php 
            $keys = array_keys($array);
            $rowCount = $res->RowCount();
            for($x=0;$x<count($keys);$x++){
                $key = $keys[$x];
                if($rowCount > 0)
                {
                    if($result[$key] < -1)
                    {
                        continue;   
                    }
                    else if(is_array($result[$key]))
                    {
                        $con = true;
                        foreach($result[$key] as $val)
                        {
                            if($val > -2)
                            {
                                 $con = false;
                            }
                        }
                        if($con)
                        {
                            continue;   
                        }
                    }
                }?>
                
                <h2><?php echo $array[$key][0];?></h2>  
                <div>
                    <?php
                   if($rowCount<1)
                   {?>
                      <input type="checkbox" name="<?php echo $array[$key][2];?>">Select if you would like to do 
                   <?php }
                    else
                    {?>
                        
                        <?php if($key==="unilateralbalancetest") {
                                if($result[$key][0]>= -1) {
                                $seconds =intval($result[$key][0]);
                                $minutes =(int)($seconds/60);
                                $seconds%=60;
                                    
                                $seconds=($seconds<0?"":$seconds);
                                $minutes=($minutes<0?"":$minutes);?>
                                    Left Unilateral: <input  type="number"  name="left<?=$key;?>[]" value="<?=$minutes?>"> minutes
                                    <input  type="number"  name="left<?=$key;?>[]" value="<?=$seconds?>"> seconds<br>
                        <?php   }
                                if($result[$key][1]>= -1) {
                                $seconds =intval($result[$key][1]);
                                $minutes =(int)($seconds/60);
                                $seconds%=60;
                                    
                                $seconds=($seconds<0?"":$seconds);
                                $minutes=($minutes<0?"":$minutes);?>
                                   Right Unilateral: <input  type="number"  name="right<?=$key;?>[]" value="<?=$minutes?>"> minutes
                                    <input  type="number"  name="right<?=$key;?>[]" value="<?=$seconds?>"> seconds<br>
                        <?php   }
                              }
                              else
                              {?>
                                <input type="number" name="<?php echo $keys[$x];?>" value="<?=$result[$key];?>">
                    <?php }
                    }?>
                    <p>Definition:<?php echo $array[$keys[$x]][1];?></p>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $array[$keys[$x]][3];?>" frameborder="0" allowfullscreen></iframe>
                </div>               
        <?php }?>
        
        </div>
            <button type="submit" name="<?php echo($rowCount<1?"submitAssessments":"submitData"); ?>" >Submit</button>
    </form> 
    <h2>Previous Tests</h2>
    <table>
        <thead>
            <?php 
                foreach($keys as $key) 
                {
                    echo "<th>$key</th>";   
                }
            ?>
        </thead>
        
    </table>

</div>
    

<?php require_once"footer.php";?>