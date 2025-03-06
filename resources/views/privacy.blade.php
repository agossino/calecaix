<!DOCTYPE html>
<html>
<head>
    @php
    use Carbon\Carbon;
    use App\Models\Content;
    $privacy = Content::where("alias", "=", "privacy")->first();
    $message = "message";
@endphp
    <title>Privacy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

 

<body>
    

    <h1 style="text-align:center;">Privacy</h1><br>
    <div class="container mt-5">
        
        <div style="border:solid 1px #ccc;padding:5px;">
            {{$privacy->introtext}}</div>
    </div>
</body>
</html>
