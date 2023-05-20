<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New car model for {{ $manufacturer->name }}</title>
</head>

<body>
    <h1>New car model for {{ $manufacturer->name }}</h1>
    <form method="POST" action={{
action([App\Http\Controllers\ManufacturerController::class, 'store_model']) }}>
        @csrf
        <input type="hidden" name="manufacturer_id" value="{{ $manufacturer->id }}">
        <label for='model_name'>Car model name</label>
        <input type="text" name="model_name" id="model_name" value="{{old('model_name')}}">
        <br>
        <label for='production_started'>Production started year</label>
        <input type="number" name="production_started" id="production_started" value="{{old('production_started')}}">
        <br>
        <label for="min_price">Minimum price</label>
        <input type="number" name="min_price" id="min_price" value="{{old('min_price')}}">
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