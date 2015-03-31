<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 3/26/2015
 * Time: 8:14 PM
 */

require_once "header.php"; ?>
<!-- -->
<?php if(isLoggedIn()){ ?>
    <script type="text/javascript" src="js/formObjects.js"></script>
    <script type="text/javascript" src="js/table.js"></script>
    <script type="text/javascript" src="js/text.js"></script>
    <script type="text/javascript" src="js/radio.js"></script>
    <script>
        // functions provided by
        // http://stackoverflow.com/questions/646628/how-to-check-if-a-string-startswith-another-string
        // http://stackoverflow.com/a/646643
        if (typeof String.prototype.startsWith != 'function') {
            String.prototype.startsWith = function (str){
                return this.slice(0, str.length) == str;
            };
        }

        if (typeof String.prototype.endsWith != 'function') {
            String.prototype.endsWith = function (str){
                return this.slice(-str.length) == str;
            };
        }
        $(function() {
            var newForm = $('#newForm');
            var newElements = $('#newFormElements');
            var rootID = newElements.attr("id");

            //newForm.hide();
            $('button#createForm').click(function () {
                newForm.slideToggle('fast');
            });
            $('#addText').click(function () {
                addElement("text");
            });
            $('#addRadioGroup').click(function () {
                addElement("radioGroup");
            });

            // add elements
            function addElement(data) {
                var input = FormElements.CreateElement(data);
                newElements.append(input);
            }

            // add radio buttons to group
            newElements.on('click', '#addRadio', function (e) {
                var element = GetContainer($(e.target));
                //alert(element.attr("id"));
                var radio = FormElements.CreateRadioElement(element.find("#displayText").text());
                element.find("#radioButtons").append(radio);
            });

            // edit
            newElements.on('click', '#gearIcon', function (e) {
                var element = GetContainer($(e.target));
                // we only need to edit once
                if (element.children("#edit").length > 0) {
                    //alert("already editing '" + element.attr("id") + "'");
                    return;
                }
                var type = element.attr("id").toLowerCase();
                // function pointer, or JS's version of one
                var func;
                if (type.startsWith("text")) {
                    func = AddTextEdit;
                } else if (type.startsWith("radio")) {
                    func = AddRadioEdit;
                }
                func(element);
            });

            // save
            newElements.on('click', '#save', function (e) {
                var element = GetContainer($(e.target));
                var type = element.attr("id").toLowerCase();
                var func;
                if (type.startsWith("text")) {
                    func = SaveTextChanges;
                } else if (type.startsWith("radio")) {
                    func = SaveRadioChanges;
                }
                var edit = element.find("#edit");
                var hidden = element.find("#" + edit.attr("hide"));
                func(edit, hidden);
                edit.remove();
                hidden.show();
            });

            // cancel
            newElements.on('click', '#cancel', function (e) {
                var element = GetContainer($(e.target));
                var edit = element.find("#edit");
                var hidden = element.find("#" + edit.attr("hide"));
                edit.remove();
                hidden.show();
            });
        });
    </script>
    <button type="button" id="createForm">Create Form</button>
    <!-- the new form -->
    <div id="newForm" class="newFormContainer">
        <div class="formOptions">
            <button type="button" id="addText">Add Text Field</button>
            <button type="button" id="addRadioGroup">Add Radio Group</button>
        </div>
        <!-- the new form elements -->
        <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
        <div id="newFormElements" class="formElements"></div>
        </form>
        <!-- the new form elements -->
        <div class="formOptions">
            <button type="button" id="saveForm">Save Form</button>
        </div>
    </div>
<?php }?>
<!-- -->
<?php require_once "footer.php";?>