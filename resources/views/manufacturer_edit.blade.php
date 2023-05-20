<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editing manufacturer {{ $manufacturer->name }}</title>
</head>

<body>
    <h1>Editing manufacturer {{ $manufacturer->name }}</h1>
    <form method="POST" action={{ action([App\Http\Controllers\ManufacturerController::class,
'update'], [ 'manufacturer' => $manufacturer]) }}>
        @csrf
        @method('put')
        <label for='manufacturer_name'>Manufacturer name</label>
        <input type="text" name="manufacturer_name" id="manufacturer_name" value="{{old('manufacturer_name',$manufacturer->name) }}">
        <br>
        <label for="founded">Founded year</label>
        <input type="number" name="founded" id="founded" value="{{old('founded',$manufacturer->founded)}}">
        <br>
        <label for="website">Website</label>
        <input type="text" name="website" id="website" value="{{old('website',$manufacturer->website)}}">
        <br>
        <button type="submit" value="Update">Save changes</button>
        @if (count($errors) > 0)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
</body>

</html>