<div id="dynamicdata"></div>
<script type="text/javascript"> 
YAHOO.example.DynamicData = function() {
    var myColumnDefs = [
        {key:"s_id", label:"ID", sortable:true},
        {key:"key_word", label:"Key word", sortable:true},
        {key:"translate", label:"Translate", sortable:true},
        {key:"status", label:"Status", sortable:true}
    ];

    // DataSource instance
    var dataSourceURL = 'http://122.116.58.213:8080/lang/listit?';
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
        sortedBy : {key:"s_id", dir:YAHOO.widget.DataTable.CLASS_DESC},
        paginator: new YAHOO.widget.Paginator({ rowsPerPage:10 }), // Enables pagination
        scrollable:true//, width:"900px"
    };

    var myDataTable = new YAHOO.widget.DataTable("dynamicdata", myColumnDefs, myDataSource, myConfigs);
    //myDataTable.subscribe("rowMouseoverEvent", myDataTable.onEventHighlightRow);
    //myDataTable.subscribe("rowMouseoutEvent", myDataTable.onEventUnhighlightRow);

    myDataTable.handleDataReturnPayload = function(oRequest, oResponse, oPayload) {
      oPayload.totalRecords = oResponse.meta.totalRecords;
      //$('totalRecords').innerHTML = '共 <span style="color:teal;">' + oPayload.totalRecords + '</span> 筆';
      return oPayload;
    }

    return {
        ds: myDataSource,
        dt: myDataTable
    };
}();
</script>

