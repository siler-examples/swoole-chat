const client = new WebSocket('ws://localhost:8000');
const form = document.querySelector('form#new-message');
const messages = document.querySelector('pre#messages');

form.addEventListener('submit', function (event) {
    event.preventDefault();
    const data = new FormData(event.currentTarget);
    const message = data.get('message');
    client.send(message);
});

client.onmessage = function (message) {
    messages.append(`${message.data}\n`);
};

client.onopen = function () {
    client.send('hello');
};