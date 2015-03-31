<!-- hide the script from old browsers

function AddTextEdit(element)
{
    var preview = element.find("#preview");
    preview.hide();
    var input = preview.find("#content").find(":input");
    var placeholder = input.attr("placeholder");
    if(placeholder == undefined) placeholder = "";

    var edit = TableFactory.CreateTable("edit");
    edit.AddTableAttribute("hide", preview.attr("id"));
    edit.AddRow().AddCell("Database Name (no spaces)").AddCell('<input type="text" id="dbName" value="' + input.attr("name") + '" />');
    edit.AddRow().AddCell("Output Name").AddCell('<input type="text" id="outName" value="' + preview.find("#outName").val() + '" />');
    edit.AddRow().AddCell("Display Text").AddCell('<input type="text" id="displayText" value="' + preview.find("#displayText").text() + '" />');
    edit.AddRow().AddCell("Placeholder Text").AddCell('<input type="text" id="placeholder" value="' + placeholder + '" placeholder="none" />');
    edit.AddRow().AddCell('<button type="button" id="save">Save</button>').AddCell('<button type="button" id="cancel">Cancel</button>');
    edit.GetTable().insertAfter(preview);
}

function SaveTextChanges(edit, changes)
{
    // values to put back into the element
    var dbname = edit.find("#dbName").val();
    var outname = edit.find("#outName").val();
    var disp = edit.find("#displayText").val();
    var holder = edit.find("#placeholder").val();

    var content = changes.find("#content").find(":input");
    var displayText = changes.find("#displayText");
    // set the values back into the preview
    content.attr("name", dbname);
    content.attr("id", dbname);
    displayText.attr("for", dbname);
    changes.find("#outName").val(outname);
    displayText.text(disp);
    content.attr("placeholder", holder);
}

-->