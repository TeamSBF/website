<?php

    class assessment
    {
        private $data;
        
        public function __construct($info)
	    {
		  $this->data = $info;
	    }
        
        public function validateAssessments()
	    {
		  return $this->validateSaveAssessments();
	    }
        
        private function validateSaveAssessments()
        {
            $insert = QueryFactory::Build('insert');
		    $insert->Into("assessments"); 
           // $insert->Set(['userID',$this->data['userID']]);
            $insert = $this->validate($insert);
            if($insert==false)
                return false;
            //Throw error
            $save = DatabaseManager::Query($insert);
            // check for success or failure
            if ($save->RowCount() == 1)
            {
                return "SUCCESS";
            }
            else
            {
               return false;   
            }
        }
        private function validate($insert)
        {
            $p = $this->data;
            $insert->Set(["userID",$p['userID']]);
            if(isset($p['ArmCurl']))
            {
                $insert->Set(['Armcurl',-1]);
            }
            
            if(isset($p['ChairStand']))
            {
                $insert->Set(['Chairstand',-1]);   
            }
            
            if(isset($p['Steptest']))
            {
                $insert->Set(['StepTest',-1]);   
            }
            
            if(isset($p['FootUpandGo']))
            {
                $insert->Set(['FootUpAndGo',-1]);
            }
            
            if(isset($p['Unilateral']))
            {
                $insert->Set(['leftunilateralbalancetest',-1]);
                $insert->Set(['rightunilateralbalancetest',-1]);
            }
            
            if(isset($p['Functional']))
            {
                $insert->Set(['FunctionalReach',-1]);   
            }
            if(isset($p['Functional'])|| isset($p['Unilateral'])|| isset($p['FootUpandGo'])||isset($p['Steptest'])||isset($p['ChairStand'])||isset($p['ArmCurl']))
            {
                $date = QueryFactory::Build('update');
		        $date->Table("users");
                $date->Set(['NextAssessment',"UNIX_TIMESTAMP()"]);
                $s = DatabaseManager::Query($date);
                return $insert;
            }
            else
            {?>
                <script>alert("Please select at least one assessment.");</script><?php
            }

        }


    }
?>