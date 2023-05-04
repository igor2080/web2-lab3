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
        <input type="text" name="model_name" id="model_name">
        <button type="submit" value="Add">Save</button>
    </form>
</body>

</html>