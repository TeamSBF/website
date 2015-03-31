<!-- hide from older browsers

function AddRadioEdit(e)
{
    var preview = e.children("#preview");
    var outName = preview.find("#outName").val();
    var dbName = preview.find("#dbName").val();
    var displayText = preview.find("#displayText").text();

    preview.hide();
    var edit = TableFactory.CreateTable("edit");
    edit.AddTableAttribute("hide", preview.attr("id"));
    if(dbName != undefined)
        edit.AddRow().AddCell("Database Name (no spaces)").AddCell('<input type="text" id="dbName" value="' + dbName + '" />');
    if(outName != undefined)
        edit.AddRow().AddCell("Output Name").AddCell('<input type="text" id="outName" value="' + outName + '" />');
    if(displayText != undefined)
        edit.AddRow().AddCell("Display Text").AddCell('<input type="text" id="displayText" value="' + displayText + '" />');
    edit.AddRow().AddCell('<button type="button" id="save">Save</button>').AddCell('<button type="button" id="cancel">Cancel</button>');
    edit.GetTable().insertAfter(preview);
}

function SaveRadioChanges(edit, hidden)
{
    var dbName = edit.find("#dbName").val();
    var outName = edit.find("#outName").val();
    var displayText = edit.find("#displayText").val();

    hidden.find("#displayText").text(displayText);
    hidden.find("#outName").val(outName);
    hidden.find("#dbName").val(dbName);
    // are we saving the button or the group
    if(hidden.parent().attr("id").toLowerCase().indexOf("button") >= 0)
        $("#" + hidden.find("#displayText").attr("for")).val(displayText);
    var buttons = hidden.parent().find("#radioButtons");
    buttons.find(":input").each(function() {
        $(this).attr("name", dbName);
    });
}

-->