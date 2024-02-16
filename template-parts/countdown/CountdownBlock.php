<?php
    $countdown_fields = get_field('countdown');
?>

<?php if ($countdown_fields['end_date'] > date('Y-m-d H:i:s')) : ?>
    <div class="countdown" style="
            display: block; 
            background: linear-gradient(to right, <?= $countdown_fields['color'] ?> 0%, <?= $countdown_fields['color_second'] ?> 100%);"
    >
        <div class="countdown__block">
            <div class="countdown__block__details">
                <div class="countdown__block__details__teams">
                    <p class="countdown__block__details__teams__team-name"><?= $countdown_fields['team1'] ?></p>
                    <span class="countdown__block__details__teams__vs-text">VS</span>
                    <p class="countdown__block__details__teams__team-name"><?= $countdown_fields['team2'] ?></p>
                </div>
                <div class="countdown__block__details__text">
                    <?= $countdown_fields['gambling_responsibility'] ?>
                </div>
            </div>
            <div class="countdown__block__time">
                <p class="countdown__block__time__text"><?= $countdown_fields['text_above_time'] ?></p>
                <p id="countdown" class="countdown__block__time__datatime"><?= $countdown_fields['end_date'] ?></p>
            </div>
            <div class="countdown__block__button" style="background: <?= $countdown_fields['color_for_btn'] ?>">
                <a href="<?= $countdown_fields['link_to_bet'] ?>">
                    <?= $countdown_fields['text_button'] ?>
                </a>
            </div>
        </div>
    </div>
    <script>
        let countdown = document.getElementById('countdown');
        let countDownDate = new Date(countdown.textContent).getTime();
        let x = setInterval(function() {
            let now = new Date().getTime();
            let distance = countDownDate - now;
            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            countdown.innerHTML = (days > 0 ? days + "d:" : '') + hours + ":" + (minutes<10 ? '0' + minutes : minutes) + ":" + (seconds<10 ? '0' + seconds : seconds);
         
            if (distance < 0) {
                clearInterval(x);
                countdown.innerHTML = "expired";
            }
        }, 1000);
    </script>
<?php endif; ?>