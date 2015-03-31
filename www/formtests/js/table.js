<!-- hide from older browsers

var TableFactory = new function() {
    var _tableCount = 0;

    this.CreateTable = function (name) {
        var table = new aTable(_tableCount);
        _tableCount++;
        if(name != undefined)
            table.AddTableAttribute("id", name);
        return table;
    };

    function aTable(id) {

        var _table, _rowCount, _cellCount, _tableID;
        _table = $('<div id="' + id + '" class="table"></div>');
        _tableID = _table.attr("id");
        _rowCount = _cellCount = 0;

        this.AddTableAttribute = function (name, value) {
            _table.attr(name, value);
        };

        this.AddRow = function () {

            _table.append('<div id="row' + _rowCount + '" class="row"></div>');
            _rowCount++;
            return this;
        };

        this.AddCell = function (content, rowID) {
            var row = findRow(getRowID(rowID));
            row.append('<div id="cell' + _cellCount + '" class="cell"></div>');
            _cellCount++;

            // add any ready-to-go content
            if (content != undefined)
                // attempt to determine if the content is html, the regex should probably be improved.
                if (content.search("^<") > -1)
                    this.AddHTML(content, row.attr("id"));
                else
                    this.AddText(content, row.attr("id"));

            return this;
        };

        this.AddText = function (obj, rowID, cellID) {
            var cell = findCell(getRowID(rowID), getCellID(cellID));
            cell.text(obj);
            return this;
        };

        this.AddHTML = function (obj, rowID, cellID) {
            var cell = findCell(getRowID(rowID), getCellID(cellID))
            cell.html(obj);
            return this;
        };

        this.GetTable = function () {
            return _table;
        };

        function getRowID(rowID) {
            return rowID || ("row" + (_rowCount - 1));
        }

        function getCellID(cellID) {
            return cellID || ("cell" + (_cellCount - 1));
        }

        function findRow(rowID) {
            var row = _table.find("#" + rowID);
            if (rowID == undefined || row == undefined)
                err(rowID, undefined);

            return row;
        }

        function findCell(rowID, cellID) {
            var row = findRow(rowID);
            var cell = row.find("#" + cellID);
            if (cell == undefined)
                err(rowID, cellID);

            return cell;
        }

        function err(rowID, cellID) {
            var cell = "Cell[" + cellID + "] in ";
            var row = "Row[" + rowID + "] in ";

            throw new Error(cell + row + "Table[" + _tableID + "] was not found");

        }
    }
};

-->