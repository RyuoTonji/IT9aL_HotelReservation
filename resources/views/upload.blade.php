<form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="image">Choose image to upload:</label>
    <input type="file" name="image" required>
    <button type="submit">Upload</button>
</form>
