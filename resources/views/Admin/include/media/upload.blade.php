<div class="w-11/12 m-auto rounded p-6 border-2">
    <p class="p-2 font-mono text-black text-center text-lg">Upload Single</p>
    <form action=" {{ route('admin.upload') }} " class="w-full" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="font-sans text-lg text-black">
            <p class="p-2">Artist :</p>
            <select id="artist" class="select2 w-2/5" name="artist">
                @foreach ($artists as $artist)
                <option value=" {{ $artist->id }} ">{{ $artist->name }}</option>
                @endforeach
            </select>
            <small class="px-2">feat : </small>
            <input id="feat" type="text" name="feat" class="outline-none px-2 border-b-2 input focus:border-green-400">
        </div>
        <div class="py-2">
            <p class="px-2">Title :</p>
            <input id="title" type="text" name="title" class="border-b-2 input focus:border-green-400 outline-none px-2 w-2/4"  maxlength="80" required>
        </div>

        <div class="py-2">
            <p class="px-2">Genre :</p>
            <select class="select2 w-1/4" name="genre">
                <option value="">select genre</option>
                @foreach ($genres as $genre)
                <option value=" {{ $genre->id }} ">{{$genre->name}}</option>
                @endforeach
            </select>
            <input class="px-2 py-1 m-2 outline-none border-2 rounded input focus:border-green-400" type="text" name="c_genre" maxlength="30" placeholder="custom genre">
        </div>

        <div class="py-2">
            <p class="px-2">Upload File</p>
            <input id="track" type="file" name="track" accept="audio/*" required>

            <div class="py-2">
                <p class="px-2">Art :</p>
                <input id="art" type="file" name="art" accept="image/png, image/jpeg, image/svg, image/bmp">
            </div>
        </div>
        <div>
            <div class="preview p-1 my-2 bg-gray-200 w-2/4">
                <p id="preview">preview</p>
            </div>
            <button type="submit" class="p-2 bg-blue-500 text-white rounded">Upload</button>
        </div>
    </form>
</div>
<script type="module">
$('#track').on('change',function () {

})

function preview () {
    var feat = $('#feat').val();
    if (feat) {
        feat = ' (feat. '+feat+' )';
    } else {
        feat = '';
    }
    $('#preview').remove();
    $('.preview').append(`<p id="preview">`+$('#title').val()+feat+`.mp3</p>`);
}
$('#feat').on('change', function () {
    preview();
})
$('#artist').on('change', function () {
    preview();
})
$('#title').on('change', function () {
    preview();
})
</script>
