
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Metanext</title>
</head>
<body>
<div class="template">

    <form class="my-form" action="{{route('campaign.store')}}" method="post" >
        @csrf
        <div>
            
            @if (session('message'))
                <div style="color: green">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div>
            <input
                class="input"
                type="text"
                placeholder="نام و نام خانوادگی "
                name="name"
                id="name"
                required
                value="{{ old('name') }}"
            />
            @error('name')
                <div class="alert alert-danger" style="color:red" >

                            {{ $message }}

                </div>
            @enderror
        </div>
        <input
            type="text"
            class="input"
            placeholder="شماره همراه"
            name="mobile"
            required
            value="{{ old('mobile') }}"
        />
        @error('mobile')
        <div class="alert alert-danger" style="color:red" >

            {{ $message }}

        </div>
        @enderror
        <div style="margin-top: 3rem;margin-left: 10%"> :چه زمانی را برای تماس با شما انتخاب می کنید </div>
        <div class="radios">

            <div class="radio">
                <input type="radio" id="1" name="time" value="9 until 13" checked />
                <label for="1">9 تا 13</label>
            </div>

            <div class="radio">
                <input type="radio" id="2" name="time" value="13 until 16" />
                <label for="2">13 تا 16</label>
            </div>

            <div class="radio">
                <input type="radio" id="3" name="time" value="16 until 19" />
                <label for="3">16 تا 19</label>
            </div>
        </div>
        @error('time')
        <div class="alert alert-danger" style="color:red" >

            {{ $message }}

        </div>
        @enderror
        <button class="submit" type="submit">درخواست مشاوره</button>
    </form>
    <img
        class="image"
        src="/img/campaign.png"
        alt=""
    />
</div>

</body>
</html>
<style>
    .my-form {
        padding: 20px;
        display: block;
        width: fit-content;
        font-size: 18px;
    }

    .template {
        display: flex;
        align-items: center;
        justify-content: center;
        width: fit-content;
        margin: 0 auto;
        margin-top: 20vh;
        border-radius: 3rem;
        border: 2px solid rgb(24, 167, 171);
        padding: 40px;
        gap: 30px;
        background-size: cover;
        background-image: url("./digital-art-minimalism-simple-background-dots-wallpaper-b990289d911a3d7be6e7b81fb071161d.jpg");
    }

    .input {
        border: 1px solid rgb(24, 167, 171);
        border-radius: 8px;
        margin-top: 20px;
        background-color: white;
        padding: 10px;
        width: 300px;
        color: white;
    }

    .input:focus {
        outline: 1px solid rgb(24, 167, 171);
        border-radius: 5px;
    }

    .submit {
        padding: 8px 35px;
        width: 100%;
        display: block;
        margin: 0 auto;
        margin-top: 50px;
        border: none;
        border-radius: 5px;
        background-color: rgb(24, 167, 171);
        color: white;
    }

    .radios {
        margin: 0 auto;
        margin-top: 20px;
        background-color: rgba(24, 167, 171, 0.377);
        display: flex;
        padding: 5px;
        border-radius: 5px;
        justify-content: space-around;
    }

    .radio {
    }

    .image {
        border: 2px solid white;
        width: 300px;
        border-radius: 5px;
    }

</style>
