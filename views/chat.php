<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.45/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div id="app" class="p-4 max-w-lg mx-auto bg-gray-100 rounded shadow">
    <h1 class="text-xl font-bold text-center mb-4">Real-Time Chat</h1>
    <div v-for="msg in messages" class="bg-white p-2 rounded shadow mb-2">
        <strong>{{ msg.sender_name }}</strong>: {{ msg.message }}<br>
        <small>{{ msg.created_at }}</small>
    </div>
    <form @submit.prevent="sendMessage" class="mt-4">
        <input v-model="name" placeholder="Naam" class="w-full p-2 border mb-2 rounded">
        <input v-model="message" placeholder="Bericht" class="w-full p-2 border mb-2 rounded">
        <button type="submit" class="bg-blue-500 text-white w-full p-2 rounded">Verstuur</button>
    </form>
</div>

<script>
const { createApp } = Vue;

createApp({
    data() {
        return { messages: [], name: '', message: '' };
    },
    mounted() {
        this.fetchMessages();
        setInterval(this.fetchMessages, 3000);
    },
    methods: {
        fetchMessages() {
            axios.get('?action=receive').then(res => this.messages = res.data);
        },
        sendMessage() {
            axios.post('?action=send', { sender_name: this.name, message: this.message })
                .then(() => { this.message = ''; this.fetchMessages(); });
        }
    }
}).mount('#app');
</script>
</body>
</html>