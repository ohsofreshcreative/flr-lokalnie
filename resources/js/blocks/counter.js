document.addEventListener('DOMContentLoaded', function() {
		const countdown = document.querySelector('.__counter');
		if (!countdown) return;

		const targetDate = new Date(countdown.dataset.date).getTime();

		const interval = setInterval(() => {
			const now = new Date().getTime();
			const distance = targetDate - now;

			const days = Math.floor(distance / (1000 * 60 * 60 * 24));
			const hours = Math.floor(
				(distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
			);
			const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			const seconds = Math.floor((distance % (1000 * 60)) / 1000);

			const daysEl = document.getElementById('days');
			const hoursEl = document.getElementById('hours');
			const minutesEl = document.getElementById('minutes');
			const secondsEl = document.getElementById('seconds');

			if (daysEl)
				daysEl.innerText = days < 10 ? '0' + days : days;
			if (hoursEl)
				hoursEl.innerText =
				hours < 10 ? '0' + hours : hours;
			if (minutesEl)
				minutesEl.innerText =
				minutes < 10 ? '0' + minutes : minutes;
			if (secondsEl)
				secondsEl.innerText =
				seconds < 10 ? '0' + seconds : seconds;

			if (distance < 0) {
				clearInterval(interval);
				countdown.innerHTML = '<div class="text-h2">Odliczanie zakończone!</div>';
			}
		}, 1000);
	});