<form action="/movie/rate" method="POST" class="d-flex align-items-center mt-4">
    <input type="hidden" name="movie_title" value="<?= htmlspecialchars($movie['Title']) ?>">

    <select name="rating" class="form-select w-auto me-2" required>
        <option value="">Select Rating</option>
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?> Star<?= $i > 1 ? 's' : '' ?></option>
        <?php endfor; ?>
    </select>

    <button type="submit" class="btn btn-success">Submit Rating</button>
</form>
