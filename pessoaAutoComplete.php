<!doctype html>

<html lang="us"><head>
    <title>PESSOA AUTOCOMPLETE</title>
	<meta charset="utf-8">

    <script src="Include\scripts\jquery\jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="Include\scripts\jquery\jquery-ui-1.12.1.custom\jquery-ui.css">
    <script src="Include\scripts\jquery\jquery-ui-1.12.1.custom\jquery-ui.js"></script>
   

</head><body>
<table>
        <tr>
            <td>Single selection</td>
            <td><input type='text' id='autocomplete' ></td>
        </tr>

        <tr>
            <td>Selected User id</td>
            <td><input type='text' id='selectuser_id' /></td>
        </tr>

        <tr>
            <td>Multiple Selection</td>
            <td><input type='text' id='multi_autocomplete' ></td>
        </tr>

        <tr>
            <td>Selected User ids</td>
            <td><input type='text' id='selectuser_ids' /></td>
        </tr>

    </table>

    <!-- Script -->
    <script type="text/javascript">
        $( function() 
        {
            $("#autocomplete").autocomplete(
            {
                source: function( request, response ) 
                {
                    $.ajax({
                        url: "pessoaAutoCompleteData.php",
                        type: "post",
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                },
                select: function (event, ui) 
                {
                    $('#autocomplete').val(ui.item.label); // display the selected text
                    $('#selectuser_id').val(ui.item.value); // save selected id to input
                    return false;
                },
                focus: function(event, ui)
                {
                    $( "#autocomplete" ).val( ui.item.label );
                    $( "#selectuser_id" ).val( ui.item.value );
                    return false;
                },
            });

            // Multiple select
            $("#multi_autocomplete").autocomplete(
            {
                source: function( request, response ) 
                {
                    var searchText = extractLast(request.term);
                    $.ajax({
                        url: "pessoaAutoCompleteData.php",
                        type: "post",
                        dataType: "json",
                        data: {
                            search: searchText
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                },
                select: function( event, ui ) 
                {
                    var terms = split( $('#multi_autocomplete').val() );
                    
                    terms.pop();
                    
                    terms.push( ui.item.label );
                    
                    terms.push( "" );
                    $('#multi_autocomplete').val(terms.join( ", " ));

                    // Id
                    var terms = split( $('#selectuser_ids').val() );
                    
                    terms.pop();
                    
                    terms.push( ui.item.value );
                    
                    terms.push( "" );
                    $('#selectuser_ids').val(terms.join( ", " ));

                    return false;
                }
            
            });
        });

        function split( val ) 
        {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) 
        {
            return split( term ).pop();
        }

    </script>

</body></html>
