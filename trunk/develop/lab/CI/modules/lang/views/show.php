<span id="totalRecords">Loading...</span>
<div id="dynamicdata"></div>
<script type="text/javascript"> 
var $ = YAHOO.util.Dom.get;
YAHOO.example.InlineCellEditing = function() {

    var formatTranslate = function(elCell, oRecord, oColumn, oData) {
        elCell.innerHTML = "<pre class=\"translate\">" + oData + "</pre>";
    };

    var myColumnDefs = [
        {key:"s_id", label:"ID", sortable:true},
        {key:"key_word", label:"Key word", sortable:true},
        {key:"translate", editor: new YAHOO.widget.TextboxCellEditor(), formatter:formatTranslate},
        {key:"status", label:"Status", sortable:true}
    ];

    // DataSource instance
    var dataSourceURL = 'http://122.116.58.213:8080/lang/listit?'+new Date().valueOf()+'&';
    var myDataSource = new YAHOO.util.DataSource(dataSourceURL);
    myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
    myDataSource.responseSchema = {
      resultsList: "records",
      fields: [
          {key:"s_id"},
          {key:"key_word"},
          {key:"translate"},
          {key:"status"}
      ],
      metaFields: {
        totalRecords: "totalRecords" // Access to value in the server response
      }
    };

    // DataTable configuration
    var myConfigs = {
        initialRequest: "sort=s_id&dir=asc&startIndex=0&results=10",
        dynamicData: true, // Enables dynamic server-driven data
        sortedBy : {key:"s_id", dir:YAHOO.widget.DataTable.CLASS_ASC},
        paginator: new YAHOO.widget.Paginator({ rowsPerPage:10 }) // Enables pagination
        //scrollable:true, width:"900px"
    };

    var myDataTable = new YAHOO.widget.DataTable("dynamicdata", myColumnDefs, myDataSource, myConfigs);
    myDataTable.subscribe("cellClickEvent", function(oArgs) {
        current_sid = (document.uniqueID) ? oArgs.target.parentNode.firstChild.innerText : oArgs.target.parentNode.firstChild.textContent;
        myDataTable.onEventShowCellEditor(oArgs);
    }); 

    YAHOO.util.Event.on("yui-textboxceditor0-container", "click", function(e) {
        var targetEl = YAHOO.util.Event.getTarget(e);
        if (YAHOO.util.Dom.hasClass(targetEl, "yui-dt-default")) {
            var new_value = targetEl.parentNode.parentNode.getElementsByTagName('INPUT')[0].value;
            alert('You changed to ' + new_value);
            var dataStr = [
                's_id='+current_sid,
                'translate='+encodeURIComponent(new_value)
            ].join('&'); 
            YAHOO.util.Connect.asyncRequest('POST', 'lang/update/', null, dataStr);
        }
    });

    //myDataTable.onEventShowCellEditor.apply(this.arguments);

    // Set up editing flow
    /*
    var highlightEditableCell = function(oArgs) {
        var elCell = oArgs.target;
        if (YAHOO.util.Dom.hasClass(elCell, "yui-dt-editable")) {
            this.highlightCell(elCell);
        }
    };
     */

    myDataTable.handleDataReturnPayload = function(oRequest, oResponse, oPayload) {
      oPayload.totalRecords = oResponse.meta.totalRecords;
      $('totalRecords').innerHTML = '共 <span style="color:teal;">' + oPayload.totalRecords + '</span> 筆';
      return oPayload;
    }

    return {
        ds: myDataSource,
        dt: myDataTable
    };
}();
</script>

