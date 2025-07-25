<form method="post" action="/movie/rate">
    <input type="hidden" name="movie_title" value="<?= htmlspecialchars($movie['Title']) ?>">

    <h4 class="mt-5">Rate this movie:</h4>
    <div class="star-rating">
        <?php for ($i = 5; $i >= 1; $i--): ?>
            <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>">
            <label for="star<?= $i ?>" title="<?= $i ?> stars">&#9733;</label>
        <?php endfor; ?>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Submit Rating</button>
</form>

<style>
    .star-rating {
        direction: rtl;
        display: inline-flex;
        font-size: 2rem;
    }
    .star-rating input[type="radio"] {
        display: none;
    }
    .star-rating label {
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s;
    }
    .star-rating input[type="radio"]:checked ~ label {
        color: #ffc107;
    }
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
</style>
