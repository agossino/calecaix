<!DOCTYPE html>
<html>

<head>
    @php
        use Carbon\Carbon;
        use App\Models\Content;
        $termini = Content::where("alias", "=", "condizioni")->first();
        $message = "message";
    @endphp
    <title>Condizioni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
 


<body>
    <div class="container mt-5">
      
        <div style="width:400px;border:solid 1px #ccc;padding:5px;">
            <h1>Condizioni</h1><br>
            <p>{{ $termini->introtext }}</p>
        </div>
    </div>
</body>

</html>
