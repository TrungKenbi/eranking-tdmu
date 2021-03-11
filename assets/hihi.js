var editor; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax: "/proccess.php",
        table: "#sinhvien",
        fields: [ {
                label: "Coder:",
                name: "coder"
            }, {
                label: "NTU:",
                name: "ntu"
            }, {
                label: "Kattis:",
                name: "kattis"
            }, {
                label: "Point:",
                name: "point"
            }
        ]
    } );
    
    // editor.on( 'initEdit', function () {
    //   var ids = editor.ids( true );
    //   var data = table.rows( ids ).data();
     
    //   // Do something with `data`...
    // } );

 
    var table = $('#sinhvien').DataTable( {
        lengthChange: false,
        ajax: "/proccess.php",
        columns: [
            { data: "rank" },
            { data: "coder" },
            { data: "ntu" },
            { data: "kattis" },
            { data: "point" }
        ],
        select: true
    } );
 
    // Display the buttons
    // new $.fn.dataTable.Buttons( table, [
    //     { extend: "create", editor: editor, text: "New" },
    //     { extend: "edit",   editor: editor },
    //     { extend: "remove", editor: editor }
    // ] );
 
    table.buttons().container()
        .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
} );