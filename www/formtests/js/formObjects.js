<!-- hide the script from old browsers

var FormElements = new function ()
{
    var _numTextFields = 0;
    //this.TextFieldCount = function(){return _numTextFields;}
    var _numRadioGroups = 0;
    //this.RadioGroupCoiu = function(){return _numRadioGroups;}
    var _numRadioButtons = 0;
    //this.RadioButtonCount = function(){return _numRadioButtons;}


    this.CreateElement = function(type)
    {
        var input;
        switch(type) {
            case "text":
                input = textElement(_numTextFields++);
                break;
            case "radioGroup":
                input = radioGroup(_numRadioGroups++);
                break;
        }

        return input;
    };

    function textElement(num) {
        var element;
        var name = "text" + num;
        // gear icon
        // http://findicons.com/icon/176020/gear?id=176363
        element = '<div id="' + name + 'Container">' +
        '   <div id="preview">' +
        '       <input type="hidden" id="outName" name="outName" value="' + name + '" />' +
        '       <img src="assets/icons/gear.png" id="gearIcon" />' +
        '       <div id="title">' +
        '           <label id="displayText" for="' + name + '">' + name + '</label> ' +
        '       </div>' +
        '       <div id="content">' +
        '           <input type="text" name="' + name + '" id="' + name + '" placeholder="" />' +
        '       </div>' +
        '   </div>' +
        '</div>';

        return element;
    }

    function radioGroup(num) {
        var element;
        var name = "radioGroup" + num;

        element = '<div id="' + name + 'Container">' +
        '   <div id="preview">' +
        '       <input type="hidden" name="outName" id="outName" value="' + name + '" />' +
        '       <input type="hidden" name="dbName" id="dbName" value="' + name + '" />' +
        '       <img src="assets/icons/gear.png" id="gearIcon" />' +
        '       <label id="displayText">' + name + '</label> ' +
        '   </div>' +
        '   <button type="button" id="addRadio">Add Radio Button</button>' +
        '   <div id="radioButtons"></div>' +
        '</div>';

        return element;
    }

    this.CreateRadioElement = function(groupName)
    {
        var element;
        var name = "radioButton" + _numRadioButtons;
        var displayName = "RadioButton " + _numRadioButtons;

        element = '<div id="' + name + 'Container">' +
        '   <div id="preview">' +
        '       <img src="assets/icons/gear.png" id="gearIcon" />' +
        '       <input type="radio" name="' + groupName + '" id="'+name+'" value="' + displayName + '" />' +
        '       <label id="displayText" for="'+name+'">' +displayName +'</label>' +
        '   </div>' +
        '</div>';

        _numRadioButtons++;

        return element;
    };
};

function GetElement(target, e)
{
    var maxLevel = 20, curLevel = 0;
    while(e.attr("id") != target && curLevel < maxLevel) {
        e = e.parent();
        curLevel++
    }
    if(curLevel == maxLevel)
        throw new Error("max levels exceeded in GetElement looking for '" + target + "'");

    return e;
}

function GetContainer(e)
{
    var maxLevel = 20, curLevel = 0;
    while(e.attr("id").toLowerCase().indexOf("container") < 0 && curLevel < maxLevel) {
        e = e.parent();
        curLevel++;
    }
    if(curLevel == maxLevel)
        throw new Error("max levels exceeded in GetContainer looking for '" + target + "'");
    return e;
}

-->