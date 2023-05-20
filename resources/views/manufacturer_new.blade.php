<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New manufacturer in {{ $country->name }}</title>
</head>

<body>
    <h1>New manufacturer in {{ $country->name }}</h1>
    <form method="POST" action={{
action([App\Http\Controllers\ManufacturerController::class, 'store']) }}>
        @csrf
        <input type="hidden" name="country_id" value="{{ $country->id }}">
        <label for='manufacturer_name'>Manufacturer name</label>
        <input type="text" name="manufacturer_name" id="manufacturer_name" value="{{old('manufacturer_name')}}">
        <br>
        <label for="founded">Founded year</label>
        <input type="number" name="founded" id="founded" value="{{old('founded')}}">
        <br>
        <label for="website">Website</label>
        <input type="text" name="website" id="website" value="{{old('website')}}">
        <br>
        <button type="submit" value="Add">Save</button>
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