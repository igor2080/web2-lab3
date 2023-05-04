<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car models from {{$manufacturer->name}}</title>
</head>

<body>
    <h1>Car models from {{$manufacturer->name}}</h1>
    @if (count($carmodels) == 0)
    <p color='red'>There are no records in the database!</p>
    @else
    <ul>
        @foreach ($carmodels as $carmodel)
        <li>
            {{ $carmodel->name }}

        </li>
        @endforeach
    </ul>
    @endif
    <a href="{{ action([App\Http\Controllers\ManufacturerController::class,
'create_model'],[$manufacturer->id])}}">Add new car model</a>
    <br>
</body>

</html>