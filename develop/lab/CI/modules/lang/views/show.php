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

    var updCallback = {
        success: function(o) {
            if (o.responseText == '') {
                alert('Please login!');
                window.location = '/login/';
            } else {
                alert('Translation OK!');
            }
        },
        failure: function(o) {
            alert('System busy, wait for a while... Code:' + o.responseText);
            window.location = '/l10n/';
        }
    };

    var updRequest = function(El) {
        alert('el : ' + El.value);
        var dataStr = [
            's_id='+current_sid,
            'translate='+encodeURIComponent(El.value)
        ].join('&'); 
        YAHOO.util.Connect.asyncRequest('POST', 'lang/update/', updCallback, dataStr);
    };

    myDataTable.subscribe("editorKeydownEvent", function(oArgs) {
        if (oArgs.event.keyCode == 13) {
            updRequest(oArgs.event.target);
        }
    });

    YAHOO.util.Event.on("yui-textboxceditor0-container", "click", function(e) {
        var targetEl = YAHOO.util.Event.getTarget(e);
        if (YAHOO.util.Dom.hasClass(targetEl, "yui-dt-default")) {
            updRequest(targetEl.parentNode.parentNode.getElementsByTagName('INPUT')[0]);
        }
    });

    myDataTable.handleDataReturnPayload = function(oRequest, oResponse, oPayload) {
      oPayload.totalRecords = oResponse.meta.totalRecords;
      $('totalRecords').innerHTML = 'Total <span style="color:teal;">' + oPayload.totalRecords + '</span> records';
      return oPayload;
    }

    return {
        ds: myDataSource,
        dt: myDataTable
    };
}();
</script>

