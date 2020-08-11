<div class="w-11/12 m-auto rounded p-6 border-2">
    <p class="p-2 font-mono text-black text-center text-lg">Upload Album</p>
    <form action=" {{ route('admin.uploadBulk') }} " class="w-full" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="font-sans text-lg text-black">
            <p class="p-2">Album Artist :</p>
            <select id="artist" class="select2 w-2/5" name="artist">
                @foreach ($artists as $artist)
                    <option value=" {{ $artist->id }} ">{{ $artist->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="py-2">
            <p class="px-2">Album Title :</p>
            <input id="title" type="text" name="title"
                class="border-b-2 input focus:border-green-400 outline-none px-2 w-2/4" maxlength="80" required>
        </div>

        <div class="py-2">
            <p class="px-2">Genre :</p>
            <select class="select2 w-1/4" name="genre">
                <option value="">select genre</option>
                @foreach ($genres as $genre)
                    <option value=" {{ $genre->id }} ">{{ $genre->name }}</option>
                @endforeach
            </select>
            <input class="px-2 py-1 m-2 outline-none border-2 rounded input focus:border-green-400" type="text"
                name="c_genre" maxlength="30" placeholder="custom genre">
            <div class="py-2">
                <p class="px-2">Album Front Image :</p>
                <input id="art" type="file" name="art" accept="image/png, image/jpeg, image/svg, image/bmp">
            </div>
        </div>

        <div class="py-2 px-2">
            <p class="px-2 font-mono text-lg">Tracks</p>
            <div id="tracks" class="border-2 rounded p-2">
                <div id="t1" class="py-2">
                    <div class="py-2">
                        Title : <input type="text" name="title1"
                            class="border-b-2 input focus:border-green-400 outline-none px-2 w-2/4 m-1" maxlength="80"
                            required><br>
                        Artist :
                        <select id="artist1" class="select2 w-2/5" name="artist1">
                            @foreach ($artists as $artist)
                                <option value=" {{ $artist->id }} ">{{ $artist->name }}</option>
                            @endforeach
                        </select>
                        <small class="px-2 text-lg">feat : </small>
                        <input type="text" name="feat1"
                            class="outline-none px-2 border-b-2 input focus:border-green-400">
                    </div>
                    <div>
                        <input type="checkbox" checked disabled>
                        <input type="hidden" name="check1" id="check1" value="1" readonly>
                        <input type="file" name="track1" accept="audio/*" class="inline-block" required>
                    </div>
                </div>
                <div id="t2" class="py-2">
                    <div class="py-2">
                        Title : <input type="text" name="title2"
                            class="border-b-2 input focus:border-green-400 outline-none px-2 w-2/4 m-1" maxlength="80"
                            required><br>
                        Artist :
                        <select id="artist2" class="select2 w-2/5" name="artist2">
                            @foreach ($artists as $artist)
                                <option value=" {{ $artist->id }} ">{{ $artist->name }}</option>
                            @endforeach
                        </select>
                        <small class="px-2 text-lg">feat : </small>
                        <input type="text" name="feat2"
                            class="outline-none px-2 border-b-2 input focus:border-green-400">
                    </div>
                    <div>
                        <input type="checkbox" checked disabled>
                        <input type="hidden" name="check2" id="check2" value="1" readonly>
                        <input type="file" name="track2" accept="audio/*" class="inline-block" required>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <button class="text-sm p-1 w-8 bg-blue-500 text-white rounded-full" id="add">+</button>
                <button class="text-sm p-1 w-8 bg-blue-500 text-white rounded-full" id="remove">-</button>
            </div>
        </div>
        <div>
            <div class="progress">
                <div class="bar"></div>
                <div class="percent"></div>
            </div>
            <div id="num"></div>
            <button id="submit" type="submit" class="p-2 bg-blue-500 text-white rounded">Upload</button>
        </div>
    </form>
</div>
<script type="module">
    var num = 2;
    var max = 24;

    $('#add').on('click', function() {
        if (num >= 24) {
            return false;
        }
        ++num;
        $('#tracks').append(
            `<div id="t` + num + `" class="py-2">
                    <div class="py-2">
                        Title : <input type="text" name="title` + num + `" class="border-b-2 input focus:border-green-400 outline-none px-2 w-2/4 m-1" maxlength="80" required><br>
                        Artist :
                        <select id="artist` + num + `" class="select2 w-2/5" name="artist` + num + `">
                            @foreach ($artists as $artist)
                                <option value=" {{ $artist->id }} ">{{ $artist->name }}</option>
                            @endforeach
                        </select>
                        <small class="px-2 text-lg">feat : </small>
                        <input type="text" name="feat` + num + `" class="outline-none px-2 border-b-2 input focus:border-green-400">
                    </div>
                    <div>
                        <input type="checkbox" name="check` + num + `" id="check` + num + `" checked readonly>
                        <input ` + num + `" type="file" name="track` + num + `" accept="audio/*" class="inline-block" required>
                    </div>
                </div>`
        );
        $('.select2').select2();
    });
    $('#remove').on('click', function() {
        for (var i = 3; i <= num; i++) {
            if ($('#check' + i).is(':checked')) {
                $('#t' + i).remove();
            }
        }
    });

    function validate() {
        if ($('input[name=_token]').fieldValue() == "") {
            return false;
        }
    }

    function append() {
        $('#nux').remove();
        $('#num').append(
            `<input id="nux" type="hidden" name="num" value="` + num + `"/>`
        )
    }

    function callback(response) {
        console.log(response)
    }

    function errorcall(response) {
        console.log(response)
    }
    $('form').ajaxForm({
        beforeSubmit: validate,
        beforeSend: append,
        uploadProgress: function(event, position, total, percentComplete) {
            var bar = $('.bar');
            var percent = $('.percent');
            var percentVal = percentComplete + '%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        success: callback,
        error: errorcall
    });

</script>
<style>
    .progress {
        position: relative;
        width: 100%;
        border: 1px solid #7F98B2;
        padding: 1px;
        border-radius: 3px;
    }

    .bar {
        background-color: #B4F5B4;
        width: 0%;
        height: 25px;
        border-radius: 3px;
    }

    .percent {
        position: absolute;
        display: inline-block;
        top: 3px;
        left: 48%;
        color: #7F98B2;
    }

</style>
