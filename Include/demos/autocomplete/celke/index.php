<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <title>CELKE</title>
</head>
<body>
    <h1>Pesquisar pessoa</h1>

    <form>
        <label>Nome da pessoa:</label>
        <input type="text" name="descricao" id="descricao" placeholder="Digite o nome da pessoa" />
    </form>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#descricao").autocomplete({
                source: 'indexPesqPessoa.php'
            });
        });

    </script>
    
</body>
</html>