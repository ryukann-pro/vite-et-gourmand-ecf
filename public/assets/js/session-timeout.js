const SESSION_TIMEOUT = 60 * 1000;
const WARNING_BEFORE = 15 * 1000;

let timeoutId;
let warningId;
let warningVisible = false;

function hideSessionWarning() {
    const warning = document.getElementById('sessionWarning');

    if (warning) {
        warning.classList.add('d-none');
    }

    warningVisible = false;
}

function showSessionWarning() {
    const warning = document.getElementById('sessionWarning');

    if (warning) {
        warning.classList.remove('d-none');
    }

    warningVisible = true;
}

function expireSession() {
    window.location.href =
        'index.php?url=deconnexion&session=expired';
}

function resetSessionTimeout() {
    clearTimeout(timeoutId);
    clearTimeout(warningId);

    hideSessionWarning();

    warningId = setTimeout(
        showSessionWarning,
        SESSION_TIMEOUT - WARNING_BEFORE
    );

    timeoutId = setTimeout(
        expireSession,
        SESSION_TIMEOUT
    );
}

function handleActivity() {
    if (!warningVisible) {
        resetSessionTimeout();
    }
}

[
    'click',
    'keydown',
    'mousemove',
    'scroll',
    'touchstart'
].forEach(eventName => {
    document.addEventListener(
        eventName,
        handleActivity
    );
});

const stayConnectedButton =
    document.getElementById('stayConnected');

if (stayConnectedButton) {
    stayConnectedButton.addEventListener(
        'click',
        resetSessionTimeout
    );
}

resetSessionTimeout();