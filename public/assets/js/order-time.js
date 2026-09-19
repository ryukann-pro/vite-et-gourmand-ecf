const dateInput = document.getElementById('dateLivraison');
const timeSelect = document.getElementById('heureLivraison');

function updateAvailableTimes() {
    if (!dateInput || !timeSelect) {
        return;
    }

    const now = new Date();

    const today =
        now.getFullYear() + '-' +
        String(now.getMonth() + 1).padStart(2, '0') + '-' +
        String(now.getDate()).padStart(2, '0');

    const selectedDate = dateInput.value;

    Array.from(timeSelect.options).forEach(option => {
        option.disabled = false;

        if (selectedDate === today) {
            const [hours, minutes] = option.value
                .split(':')
                .map(Number);

            const optionDate = new Date();

            optionDate.setHours(
                hours,
                minutes,
                0,
                0
            );

            if (optionDate <= now) {
                option.disabled = true;
            }
        }
    });

    const selectedOption =
        timeSelect.options[timeSelect.selectedIndex];

    if (selectedOption?.disabled) {
        timeSelect.value = '';
    }
}

dateInput?.addEventListener(
    'change',
    updateAvailableTimes
);

updateAvailableTimes();